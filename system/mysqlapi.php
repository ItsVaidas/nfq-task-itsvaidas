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
  
  function createNewProject($name, $groups, $students) {
    mysqli_query($this->connection, "INSERT INTO `project_info`(`name`, `groups`, `students`) VALUES ('$name',$groups,$students)");
    $last_id = mysqli_insert_id($this->connection);
    for ($i = 0; $i < $groups; $i++) {
      mysqli_query($this->connection, "INSERT INTO `groups`(`project`) VALUES ($last_id)");
    }
  }
  
  function addNewStudent($id, $name) {
    mysqli_query($this->connection, "INSERT INTO `students`(`name`, `project`) VALUES ('$name',$id)");
  }
  
  function removeStudent($id, $name) {
    mysqli_query($this->connection, "DELETE FROM `students` WHERE `name`='$name'");
  }
  
  function getAllGroups() {
    $result = mysqli_query($this->connection, "SELECT * FROM `project_info`");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
  
  function checkIfProjectExist($id) {
    return mysqli_num_rows(mysqli_query($this->connection, "SELECT * FROM `project_info` WHERE id=$id")) > 0;
  }
  
  function getProjectInfo($id) {
    return mysqli_fetch_all(mysqli_query($this->connection, "SELECT * FROM `project_info` WHERE `id`=$id"), MYSQLI_ASSOC)[0];
  }
  
  function getStudentsInfo($id) {
    return mysqli_query($this->connection, "SELECT * FROM `students` WHERE `project`=$id");
  }
  
  function getGroupsInfo($id) {
    return mysqli_query($this->connection, "SELECT * FROM `groups` WHERE `project`=$id");
  }
  
  function __destruct() {
    mysqli_close($this->connection);
  }
}