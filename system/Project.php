<?php


class Project {

  private $id;
  private $name;
  private $groups;
  private $students;
  
  private $mysqli;

  function __construct($id) {
    $this->mysqli = new mysqlapi();
    
    $project_info = $this->mysqli->getProjectInfo($id);
    $students_info = $this->mysqli->getStudentsInfo($id);
    $groups_info = $this->mysqli->getGroupsInfo($id);
    
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
    
    $this->id = $id;
    $this->name = $project_info['name'];
    $this->groups = $groups;
    $this->students = $students;
  }
  
  function getName() {
    return $this->name;
  }
  
  function getNumberOfGroups() {
    return $this->groups->getSize();
  }
  
  function getStudentsPerGroup() {
    return $this->groups->getLimit();
  }
  
  function getAllStudents() {
    return $this->students->getAll();
  }
  
  function getAllGroups() {
    return $this->groups->getGroups();
  }
  
  function addStudent($student_name) {
    $this->mysqli->addNewStudent($this->id, $student_name);
    
    $student = new Student($student_name, null);
    $this->students->addStudent($student);
  }
  
  function removeStudent($student_name) {
    $this->mysqli->removeStudent($this->id, $student_name);
    
    $this->students->removeStudent($student_name);
    $this->groups->removeStudent($student_name);
  }
  
  
}