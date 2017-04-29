window.$doc = window.$doc || $(document);

window.config = {
	editUrl: './ajax/task.edit.php',
	listUrl: './ajax/tasks.php',
	removeOldUrl: './ajax/remove.old.php',
};

var loadTasks = function() {

};

var addTask = function() {
	var FORM = 'form.add-form';
	var INPUT = 'input[name=name]';
	$doc.on('submit', FORM, function(e) {
		e.preventDefault();
		var $this = $(this);
		var data = $this.serialize();
		$.post(config.editUrl, data, function() {
			$todoContainer.load(config.listUrl);
		});
		$(INPUT).val('');
	});
};

var updateTask = function() {
	var SAVE_BTN = '.task:not(.disabled) .btn.save';

	$doc.on('click', SAVE_BTN, function(e) {
		e.preventDefault();
		var $this = $(this);
		var $task = $this.closest('.task');
		var data = {
			id: $task.attr('data-id'),
			name: $task.find('.caption').val()
		};
		$.post(config.editUrl, data, function() {
			$todoContainer.load(config.listUrl);
		});
	});
};

var removeTask = function() {
	var DEL_BTN = '.btn.remove';

	$doc.on('click', DEL_BTN, function(e) {
		e.preventDefault();

		if (!window.confirm('Вы действительно хотите удалить эту задачу?')) return;
		var $this = $(this);
		var $task = $this.closest('.task');
		var data = {
			id: $task.attr('data-id'),
			del: true
		};
		$.post(config.editUrl, data, function() {
			$todoContainer.load(config.listUrl);
		});
	});
};

var finishTask = function() {
	var DEL_BTN = '.task:not(.disabled) input[type=checkbox]';

	$doc.on('change', DEL_BTN, function(e) {
		e.preventDefault();

		// if (!window.confirm()) return;
		var $this = $(this);
		var $task = $this.closest('.task');
		var data = {
			id: $task.attr('data-id'),
			finished: true
		};
		$.post(config.editUrl, data, function() {
			$todoContainer.load(config.listUrl);
		});
	});
};

// Каждые десять минут запускается удаление старых задач
var removeOld = function() {
	var func = function() {
		$.post(config.removeOldUrl, function() {
			$todoContainer.load(config.listUrl);
		});
	};
	func();
	setInterval(func, 10000);
};

$(function(){
	window.$todoContainer = $('.todo-load');
	addTask();
	updateTask();
	removeTask();
	finishTask();
	removeOld();
});