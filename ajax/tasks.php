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
			<div style="text-align: right; font-size: 12px;">
				<br><em>Дата создания: <?= $task['added_at'] ?></em>
				<?php if (!empty($task['finished_at'])): ?>
					<br><em>Дата завершения: <?= $task['finished_at'] ?></em>
				<?php endif; ?>
			</div>
		</div>

	<?php endforeach; ?>

<?php endif; ?>