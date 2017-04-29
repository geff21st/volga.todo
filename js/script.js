window.$doc = window.$doc || $(document);

var loadTasks = function() {
	
};

var addTask = function() {
	var FORM = 'form.add-form';
	var INPUT = 'input.task-name';

	console.log(55);

	$doc.on('submit', FORM, function(e) {
		e.preventDefault();

		var $this = $(this);
		console.log($this.serialize());
	});
};

$(function(){
	addTask();
})