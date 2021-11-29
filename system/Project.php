<?php


class Project {

  private $name;
  private $groups;
  private $students;

  function __construct($name, $groups, $students) {
    $this->name = $name;
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
  
  
}