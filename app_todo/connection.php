<?php
  class Connection {
    private $host = 'localhost';
    private $dbname = 'pdo';
    private $user = 'root';
    private $password = '';
    public function connectdb(){
      try {
        $connection = new PDO(
          "mysql:host=$this->host;dbname=$this->dbname",
          "$this->user",
          "$this->password"
        );
        return $connection;
      }catch(PDOException $error){
        echo '<p>'.$error->getMessage().'</p>';
      }
    }
    
  }
?>