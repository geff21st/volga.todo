<?php

require_once __DIR__ . '/../lib/autoload.php';

$res = [];
$task = new Geffest\Todo\Task;

if (empty($_REQUEST["name"])) {
	$res["success"] = false;
	$res["msg"] = "Название задачи не может быть пустым.";
	Geffest\Todo\Main::printJsonResult($res);
}

$name = htmlspecialchars($_REQUEST["name"]);

if (!empty($_REQUEST["id"])) {

	// TODO: update task

} else {

	$res["success"] = $task->add($name);

}

Geffest\Todo\Main::printJsonResult($res);