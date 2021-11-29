<?php


class Students {
  
  private $students;
  
  function __construct() {
    $this->students = array();
  }
  
  function addStudent($student) {
    $this->students[] = $student;
  }
  
  function getAll() {
    return $this->students;
  }
  
  function removeStudent($name) {
    foreach ($this->students as $student) {
      if ($student->getName() == $name)
        $this->students[$student] = null;
    }
  }
}