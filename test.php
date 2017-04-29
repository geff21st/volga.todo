<?php

require_once __DIR__ . '/lib/autoload.php';

// auth test
// echo Geffest\Todo\Main::getInstance()->getUserID();

$task = new Geffest\Todo\Task;

// var_export($task->add('qwerty'));


$task->RemoveOldTasks();


