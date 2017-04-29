window.$doc = window.$doc || $(document);

function hostReachable() {
	// Handle IE and more capable browsers
	var xhr = new ( window.ActiveXObject || XMLHttpRequest )( "Microsoft.XMLHTTP" );
	var status;

	// Open new request as a HEAD to the root hostname with a random param to bust the cache
	xhr.open( "HEAD", "//" + window.location.hostname + "/?rand=" + Math.floor((1 + Math.random()) * 0x10000), false );

	// Issue request and handle response
	try {
		xhr.send();
		return ( xhr.status >= 200 && (xhr.status < 300 || xhr.status === 304) );
	} catch (error) {
		return false;
	}
}

// Каждые десять секунд проверяется наличие сети и запускаются неотправленные запросы
var waitNetwork = function() {
	if(window.networkTimer) return;

	var func = function() {
		if (!hostReachable()) {
			// если интернета все еще нет, продолжаем ждать
			return;
		} else {
			// send

			var queries = window.localStorage.getItem('todo-backup').split(';');

			$.each(queries, function(key, value) {
				value = value.split('|');
				$.post(value[0], value[1]);
			});

			clearInterval(window.networkTimer);
			window.networkTimer = false;
		}
	};

	window.networkTimer = setInterval(func, 10000);
};

window.config = {
	editUrl: './ajax/task.edit.php',
	listUrl: './ajax/tasks.php',
	removeOldUrl: './ajax/remove.old.php',
};


var sendData = function(url, data) {

	data = data || '';

	if (hostReachable()) {
		$.post(url, data, function(res1, res2) {
			// console.log(res1, res2)
			$todoContainer.load(config.listUrl);
		});
	} else {
		// console.log('интернета нет')
		backData = window.localStorage.getItem('todo-backup') || '';
		backData = url + '|' + data + ';' + backData;
		window.localStorage.setItem('todo-backup', backData);
		waitNetwork();
	}

};


var addTask = function() {
	var FORM = 'form.add-form';
	var INPUT = 'input[name=name]';
	$doc.on('submit', FORM, function(e) {
		e.preventDefault();
		var $this = $(this);
		var data = $this.serialize();

		sendData(config.editUrl, data);

		$(INPUT).val('');
	});
};

var updateTask = function() {
	var SAVE_BTN = '.task:not(.disabled) .btn.save';

	$doc.on('click', SAVE_BTN, function(e) {
		e.preventDefault();
		var $this = $(this);
		var $task = $this.closest('.task');
		var data =
			'id=' + $task.attr('data-id') + '&' +
			'name=' + $task.find('.caption').val();

		sendData(config.editUrl, data);
	});
};

var removeTask = function() {
	var DEL_BTN = '.btn.remove';

	$doc.on('click', DEL_BTN, function(e) {
		e.preventDefault();

		if (!window.confirm('Вы действительно хотите удалить эту задачу?')) return;
		var $this = $(this);
		var $task = $this.closest('.task');
		var data =
			'id=' + $task.attr('data-id') + '&' +
			'del=true';

		sendData(config.editUrl, data);
	});
};

var finishTask = function() {
	var DEL_BTN = '.task:not(.disabled) input[type=checkbox]';

	$doc.on('change', DEL_BTN, function(e) {
		e.preventDefault();

		// if (!window.confirm()) return;
		var $this = $(this);
		var $task = $this.closest('.task');
		var data =
			'id=' + $task.attr('data-id') + '&' +
			'finished=true';

		sendData(config.editUrl, data);
	});
};

// Каждые десять минут запускается удаление старых задач
var removeOld = function() {
	var func = function() {
		$.post(config.removeOldUrl, function() {
			$todoContainer.load(config.listUrl);
		});
	};
	setInterval(func, 600000);
};

$(function(){
	window.$todoContainer = $('.todo-load');
	addTask();
	updateTask();
	removeTask();
	finishTask();
	removeOld();
});