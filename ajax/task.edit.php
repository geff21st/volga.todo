<?php

require_once __DIR__ . '/../lib/autoload.php';

$res = [];
$task = new Geffest\Todo\Task;


// TODO: сделать тут что-то приличное
if (empty($_REQUEST["del"]) && empty($_REQUEST["finished"])) {
	if (empty($_REQUEST["name"])) {
		$res["success"] = false;
		$res["msg"] = "Название задачи не может быть пустым.";
		Geffest\Todo\Main::printJsonResult($res);
	} else {
		$name = htmlspecialchars($_REQUEST["name"]);
	}
}


if (!empty($_REQUEST["id"]) && ($id = intval($_REQUEST["id"]))) {

	if (!empty($_REQUEST["del"])) {
		$res["success"] = $task->remove($id);
	} elseif (!empty($_REQUEST["finished"])) {
		$res["success"] = $task->finish($id);
	} else {
		$res["success"] = $task->edit($id, $name);
	}

} else {

	$res["success"] = $task->add($name);

}

Geffest\Todo\Main::printJsonResult($res);