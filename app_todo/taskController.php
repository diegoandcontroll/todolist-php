<?php
  require "../../app_todo/task.model.php";
  require "../../app_todo/task.service.php";
  require "../../app_todo/connection.php";
  $action = isset($_GET['action']) ? $_GET['action'] : $action;
  if($action == 'insert'){
    $task = new Task();
    $task->__set('task', $_POST['task']);
    $connection = new Connection();
    $taskService = new TaskService($connection, $task);
    $taskService->addTask();

    header('Location: new_task.php?inclusion=1');
  }else if($action == 'list'){
    $task = new Task();
    $connection = new Connection();
    $taskService = new TaskService($connection, $task);
    $taskList = $taskService->listTask();
  }else if($action == 'update'){
    $task = new Task();
    $task->__set('id', $_POST['id']);
    $task->__set('task', $_POST['task']);
    $connection = new Connection();
    $taskService = new TaskService($connection, $task);
    if($taskService->updateTask()){
      if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
        header('Location: index.php');
      }else{
        header('Location: all_tasks.php');
      }
      
    }
  }else if($action == 'delete'){
    $task = new Task();
    $task->__set('id', $_GET['id']);
    $connection = new Connection();
    $taskService = new TaskService($connection, $task);
    if($taskService->deleteTask()){
      if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
        header('Location: index.php');
      }else{
        header('Location: all_tasks.php');
      }
    }
  }else if($action == 'completeTask'){
    $task = new Task();
    $task->__set('id', $_GET['id']);
    $task->__set('id_status', 2);
    $connection = new Connection();
    $taskService = new TaskService($connection, $task);
    $taskService->completeTask();
    if(isset($_GET['pag']) && $_GET['pag'] == 'index'){
      header('Location: index.php');
    }else{
      header('Location: all_tasks.php');
    }
  }else if($action == 'FetchPedingTask'){
    $task = new Task();
    $task->__set('id_status',1);
    $connection = new Connection();
    $taskService = new TaskService($connection, $task);
    $taskList = $taskService->fetchPeding();
  }

?>