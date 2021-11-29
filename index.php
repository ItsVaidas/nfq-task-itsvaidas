<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "./system/mysqlapi.php";
$mysqlapi = new mysqlapi();

$req_uri = $_SERVER['REQUEST_URI'];
if (isset($req_uri))
  $page = explode("/", $req_uri)[1];

if (isset($_POST['create-project'])) {
  $project_name = trim($_POST['project_name']);
  $number_of_groups = trim($_POST['number_of_groups']);
  $number_of_members = trim($_POST['number_of_members']);
  
  $mysqlapi->createNewGroup($project_name, $number_of_groups, $number_of_members);
}

if (isset($page) && $page != "") {
  $project = $mysqlapi->getProject($id);
  if ($project == null) {
    header("Location: /");
    die();
  }
}
?>
<head>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<?php 
if (!isset($page) || $page == "") {
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
    <h5>Name: <b>TEST</b></h5>
    <h5>Number of groups: <b>TEST</b></h5>
    <h5>Students per group: <b>TEST</b></h5>
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
        <tr>
          <td>Student1</td>
          <td>Group1</td>
          <td>delete</td>
        </tr>
        <tr>
          <td>Student1</td>
          <td>Group1</td>
          <td>delete</td>
        </tr>
        <tr>
          <td>Student</td>
          <td>Group</td>
          <td>delete</td>
        </tr>
      </tbody>
    </table>
    <input type="submit" name="add_student" value="Add new Student"/>
  </div>
</div>


<div class="big-box">
  <h3>Project groups</h3>
  <div class="simple-box-text">
    <table>
      <thead>
        <tr>
          <th>Group #1</th>
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
    
    
  </div>
</div>