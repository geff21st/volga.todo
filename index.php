<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>


<div class="wrapper">
	
	<div class="form">
		
		<form class="add-form">
			<input type="text" name="task-name" placeholder="Введите название задачи">
			<input type="submit" name="add-task" value="Добавить">
		</form>

	</div>

	<div class="todo">
		
		<form>
			
			<div class="task">
				<label>
					<input type="checkbox" name="">
					<span class="caption">
						Название задачи 1				
					</span>
				</label>
				<button type="button" class="btn save">
					Сохранить
				</button>
				<button type="button" class="btn remove">
					Удалить
				</button>
			</div>

			
			<div class="task">
				<label>
					<input type="checkbox" name="">
					<span class="caption">
						Название задачи 2				
					</span>
				</label>
				<button type="button" class="btn save">
					Сохранить
				</button>
				<button type="button" class="btn remove">
					Удалить
				</button>
			</div>


		</form>
	
	</div>

</div>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>