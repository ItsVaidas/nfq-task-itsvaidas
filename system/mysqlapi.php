<?php


class mysqlapi {
  
  private $IP = "localhost";
  private $USER = "nfq";
  private $PASSWORD = "nfq-task";
  private $DATABAZE = "NFQ";
  
  private $connection;
  
  function __construct() {
    $this->connection = mysqli_connect($this->IP, $this->USER, $this->PASSWORD, $this->DATABAZE);
  }
  
  function createNewGroup($name, $groups, $students) {
    mysqli_query($this->connection, "INSERT INTO `project_info`(`name`, `groups`, `students`) VALUES ('$name',$groups,$students)");
  }
  
  function getAllGroups() {
    $result = mysqli_query($this->connection, "SELECT * FROM `project_info`");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
  
  function checkIfProjectExist($id) {
    return mysqli_num_rows(mysqli_query($this->connection, "SELECT * FROM `project_info` WHERE id=$id")) > 0;
  }
  
  function __destruct() {
    mysqli_close($this->connection);
  }
}