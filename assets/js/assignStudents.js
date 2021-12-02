function assignStudent(project_id, id, i) {
  var student_name = document.getElementById(id + '-' + i).value;
  document.getElementById(id + '-' + i + '-replace').innerHTML = student_name;
  document.getElementById('replace-' + student_name).innerHTML = 'Group #' + id;
  
  var httpc = new XMLHttpRequest();
  var url = "add_student_to_group.php?id=" + id + "&name=" + student_name + "&project_id=" + project_id;
  httpc.open("POST", url, true);
  httpc.send();
  
  var elements = document.getElementsByClassName("remove-option");
  for(var i = elements.length - 1; i >= 0; i--) {
    if (elements[i].value == student_name)
      elements[i].remove();
  }
}