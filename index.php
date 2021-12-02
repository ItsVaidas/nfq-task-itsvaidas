<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "./system/Project.php";
include "./system/Groups.php";
include "./system/Student.php";
include "./system/Group.php";
include "./system/Students.php";
include "./system/mysqlapi.php";

$mysqlapi = new mysqlapi();

$req_uri = $_SERVER['REQUEST_URI'];
if (isset($req_uri))
  $id = explode("/", $req_uri)[1];

if (isset($_POST['create-project'])) {
  $project_name = trim($_POST['project_name']);
  $number_of_groups = trim($_POST['number_of_groups']);
  $number_of_members = trim($_POST['number_of_members']);
  
  $mysqlapi->createNewProject($project_name, $number_of_groups, $number_of_members);
}

if (isset($id) && $id != "") {
  if (!$mysqlapi->checkIfProjectExist($id)) {
    header("Location: /");
    die();
  }
  $project = new Project($id);
}

if (isset($_POST['add-student'])) {
  $student_name = trim($_POST['student_name']);
  $project->addStudent($student_name);
}
if (isset(explode("/", $req_uri)[2]) && explode("/", $req_uri)[2] == "del") {
  $student_name = str_replace("%20", " ", explode("/", $req_uri)[3]);
  $project->removeStudent($student_name);
  header("Location: /$id");
}
?>
<head>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<?php 
if (!isset($id) || $id == "") {
?>

<div class="simple-box">
  <h3>Create a new project</h3>
  <form action="#" method="POST">
    <input type="text" name="project_name" placeholder="Project name" required/>
    <input type="number" name="number_of_groups" placeholder="Number of groups" required/>
    <input type="number" name="number_of_members" placeholder="Number of members in a group" required/>
    <br>
    <input type="submit" name="create-project" value="Create project" />
  </form>
</div>

<div class="simple-box">
  <h3>Currently active projects</h3>
  
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Project</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($mysqlapi->getAllGroups() as $row) {
            echo "<tr><td>{$row['id']}</td><td><a href='/{$row['id']}'>{$row['name']}</a></td></tr>";
          }
        ?>
      </tbody>
    </table>
</div>

<?php
die();
}
?>

<div class="simple-box">
  <h3>Project status</h3>
  <div class="simple-box-text">
    <h5>Name: <b><?php echo $project->getName(); ?></b></h5>
    <h5>Number of groups: <b><?php echo $project->getNumberOfGroups(); ?></b></h5>
    <h5>Students per group: <b><?php echo $project->getStudentsPerGroup(); ?></b></h5>
  </div>
</div>


<div class="simple-box">
  <h3>Students</h3>
  <div class="simple-box-text">
    <table>
      <thead>
        <tr>
          <th>Student</th>
          <th>Group</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach($project->getAllStudents() as $student) {
          echo "<tr>
                  <td>{$student->getName()}</td>
                  <td>".($student->getGroupID() == "" ? "..." : "Group #".$student->getGroupID())."</td>
                  <td><a href='/$id/del/{$student->getName()}'>delete</a></td>
                </tr>";
        }
      ?>
      </tbody>
    </table>
    <input id="myBtn" type="submit" name="add_student" value="Add new Student"/>
  </div>
</div>


<div class="big-box">
  <h3>Project groups</h3>
  <div class="simple-box-text">
    <?php
    foreach ($project->getAllGroups() as $group) {
    ?>
    <table>
      <thead>
        <tr>
          <th>Group #<?php echo $group->getID(); ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <select name="assign-student">
              <option selected disabled>Assign student</option>
              <option value="student1">Student1</option>
              <option value="student2">Student2</option>
              <option value="student2">Student2</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <select name="assign-student">
              <option selected disabled>Assign student</option>
              <option value="student1">Student1</option>
              <option value="student2">Student2</option>
              <option value="student2">Student2</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <select name="assign-student">
              <option selected disabled>Assign student</option>
              <option value="student1">Student1</option>
              <option value="student2">Student2</option>
              <option value="student2">Student2</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
    
    <?php
    }
    ?>
  </div>
</div>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="big-box">
      <h3>Add new Student</h3>
      <form action="#" method="POST">
        <input type="text" name="student_name" placeholder="Full name" required/>
        <br>
        <input type="submit" name="add-student" value="Add student" />
      </form>
    </div>
  </div>

</div>
<script src="./assets/js/modal.js"></script>