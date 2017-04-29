<?php

require_once __DIR__ . '/../lib/autoload.php';

$task = new Geffest\Todo\Task;

$arTasks = $task->get();

?>

<?php if (empty($arTasks)): ?>

	У вас пока нет задач

<?php else: ?>

	<?php foreach ($arTasks as $task): ?>

		<div class="task <?= $task["finished"] ? "disabled" : ""?>" data-id="<?= $task["id"] ?>">
			<label>
				<input type="checkbox" name="check[<?= $task["id"] ?>]"
					<?= $task["finished"] ? "disabled checked" : ""?>
					/>
				<input class="caption" value="<?= $task["name"] ?>" <?= $task["finished"] ? "disabled" : ""?> />
			</label>
			<button type="button" class="btn save">
				Сохранить
			</button>
			<button type="button" class="btn remove">
				Удалить
			</button>
		</div>

	<?php endforeach; ?>

<?php endif; ?>