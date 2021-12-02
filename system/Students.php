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
  
  function removeStudent($student_name) {
    foreach ($this->students as $student) {
      if ($student->getName() == $student_name)
        $this->students[$student] = null;
    }
  }
}