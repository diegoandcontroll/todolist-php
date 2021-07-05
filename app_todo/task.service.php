<?php
  class TaskService {
    private $connection;
    private $task;
    public function __construct(Connection $connection,Task $task){
      $this->connection = $connection->connectdb();
      $this->task = $task;
    }
    public function addTask(){
      $query = 'insert into tb_tarefas(tarefa) values(:task)';
      $stmt = $this->connection->prepare($query);
      $stmt->bindValue(':task',$this->task->__get('task'));
      $stmt->execute();
    }

    public function listTask(){
      $query = '
        select
          t.id, s.status, t.tarefa 
        from 
          tb_tarefas as t
          left join tb_status as s on(t.id_status = s.id)
      ';
      $stmt = $this->connection->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateTask(){
      $query = " update tb_tarefas set tarefa = :task where id = :id";
      $stmt = $this->connection->prepare($query);
      $stmt->bindValue(':task', $this->task->__get('task'));
      $stmt->bindValue(':id', $this->task->__get('id'));
      return $stmt->execute();
    }

    public function deleteTask(){
      $query = 'delete from tb_tarefas where id = :id';
      $stmt = $this->connection->prepare($query);
      $stmt->bindValue(':id', $this->task->__get('id'));
      return $stmt->execute();
    }

    public function completeTask(){
      $query = " update tb_tarefas set id_status = :id_status where id = :id";
      $stmt = $this->connection->prepare($query);
      $stmt->bindValue(':id_status', $this->task->__get('id_status'));
      $stmt->bindValue(':id', $this->task->__get('id'));
      return $stmt->execute();
    }

    public function fetchPeding(){
      $query = '
        select
          t.id, s.status, t.tarefa 
        from 
          tb_tarefas as t
          left join tb_status as s on(t.id_status = s.id)
        where
          t.id_status = :id_status
      ';
      $stmt = $this->connection->prepare($query);
      $stmt->bindValue(':id_status', $this->task->__get('id_status'));
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
  }
?>