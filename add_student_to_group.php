<?php

include "./system/Project.php";
include "./system/Groups.php";
include "./system/Student.php";
include "./system/Group.php";
include "./system/Students.php";
include "./system/mysqlapi.php";

$project = new Project($_GET['project_id']);
$project->addToGroup($_GET['id'], $_GET['name']);