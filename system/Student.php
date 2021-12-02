<?php

class Student {
  
  private $name;
  private $group;
  
  function __construct($name, $group) {
    $this->name = $name;
    $this->group = $group;
  }
  
  function getName() {
    return $this->name;
  }
  
  function getGroupID() {
    return $this->group;
  }
  
  function setGroup($id) {
    $this->group = $id;
  }
  
}