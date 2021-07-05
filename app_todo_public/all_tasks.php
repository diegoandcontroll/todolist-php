<?php
	$action = 'list';
	require 'taskController.php';
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<script>
			function editTask(id,contentTask){
				let form = document.createElement('form');
				form.action = 'taskController.php?action=update';
				form.method = 'POST';
				form.className = 'row';

				let inputTask = document.createElement('input');
				inputTask.type = 'text';
				inputTask.name = 'task';
				inputTask.value = contentTask;
				inputTask.className = 'col-9 form-control';
				
				let inputId = document.createElement('input');
				inputId.type = 'hidden';
				inputId.name = 'id';
				inputId.value = id;

				let button = document.createElement('button');
				button.type = 'submit';
				button.className = 'btn btn-info col-3';
				button.innerHTML = 'Atualizar';

				form.appendChild(inputTask);
				form.appendChild(inputId);
				form.appendChild(button);
				
				let task = document.getElementById('task_'+id);

				task.innerHTML = '';
				task.insertBefore(form, task[0]);
			}

			function deleteTask(id){
				location.href = 'all_tasks.php?action=delete&id='+id;
			}
			function completeTask(id){
				location.href = 'all_tasks.php?action=completeTask&id='+id;
			}
		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="new_task.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />

								<?php foreach ($taskList as $key => $data) { ?>
									<div class="row mb-3 d-flex align-items-center tarefa">
										<div class="col-sm-9" id="task_<?= $data->id?>"><?= $data->tarefa?> (<?= $data->status?>)</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i class="fas fa-trash-alt fa-lg text-danger" onclick="deleteTask(<?= $data->id?>)"></i>
											<?php if($data->status == 'pendente') {?>
												<i class="fas fa-edit fa-lg text-info" onclick="editTask(<?= $data->id?>,'<?= $data->tarefa?>')"></i>
												<i class="fas fa-check-square fa-lg text-success" onclick="completeTask(<?= $data->id?>)"></i>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>