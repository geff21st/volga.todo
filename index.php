<?php

require_once __DIR__ . '/lib/autoload.php';
$main = Geffest\Todo\Main::getInstance();

?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>


<div class="wrapper">


<?php
$url = str_replace($_SERVER["DOCUMENT_ROOT"], "", str_replace('\\', '/', __FILE__));
?>

<div class="restore">
	<span>Войти на другом устройстве:</span>
	<input type="text" name="restore" value="<?= $_SERVER["SERVER_NAME"], $url, "?a=", $main->getSessID() ?>">
</div>


	<div class="form">

		<form class="add-form">
			<input type="text" name="name" placeholder="Введите название задачи">
			<input type="submit" name="add-task" value="Добавить">
		</form>

	</div>

	<div class="todo">

		<form class="todo-form todo-load">

			<?php include __DIR__ . "/ajax/tasks.php"; ?>

		</form>

	</div>


</div>



<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>