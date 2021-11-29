<?php


class Groups {
  
  private $size;
  private $limit;
  
  private $groups;
  
  function __construct($size, $limit) {
    $this->size = $size;
    $this->limit = $limit;
    $this->groups = array();
  }
  
  function addGroup($group) {
    $this->groups[] = $group;
  }
  
  function addStudentByGroup($id, $student) {
    foreach ($this->getGroups() as $group)
      if ($group->getID() == $id)
        $group->addStudent($student);
  }
  
  function getGroups() {
    return $this->groups;
  }
  
  function getSize() {
    return $this->size;
  }
  
  function getLimit() {
    return $this->limit;
  }
  
}