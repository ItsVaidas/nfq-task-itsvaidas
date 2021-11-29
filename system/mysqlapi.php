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
  
  function getAllGroups() {
    $result = mysqli_query($this->connection, "SELECT * FROM `project_info`");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
  
  function checkIfProjectExist($id) {
    return mysqli_num_rows(mysqli_query($this->connection, "SELECT * FROM `project_info` WHERE id=$id")) > 0;
  }
  
  function getProject($id) {
    if (!$this->checkIfProjectExist($id))
      return null;
    $project_info = mysqli_fetch_all(mysqli_query($this->connection, "SELECT * FROM `project_info` WHERE `id`=$id"), MYSQLI_ASSOC)[0];
    $students_info = mysqli_query($this->connection, "SELECT * FROM `students` WHERE `project`=$id");
    $groups_info = mysqli_query($this->connection, "SELECT * FROM `groups` WHERE `project`=$id");
    
    $groups = new Groups($project_info['groups'], $project_info['students']);
    $students = new Students();
    
    while ($row = mysqli_fetch_assoc($groups_info)) {
      $groups->addGroup(new Group($row['id']));
    }
    
    while ($row = mysqli_fetch_assoc($students_info)) {
      $student = new Student($row['name'], $row['project_group']);
      $students->addStudent($student);
      $groups->addStudentByGroup($row['project_group'], $student);
    }
    
    $project = new Project($project_info['name'], $groups, $students);
    
    return $project;
  }
  
  function __destruct() {
    mysqli_close($this->connection);
  }
}