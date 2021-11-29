<?php


class Group {
  
  private $id;
  private $students;
  
  function __construct($id) {
    $this->id = $id;
    $this->students = new Students();
  }
  
  function addStudent($student) {
    $this->students->addStudent($student);
  }
  
  function getID() {
    return $this->id;
  }
  
  
}