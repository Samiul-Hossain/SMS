<?php

require_once('config/db_connect.php');

$limit = 10;

if(isset($_POST['page_no'])){
  $page_no = $_POST['page_no'];
}else{
  $page_no = 1;
}

$offset = ($page_no-1)*$limit;

$query = "SELECT cl.class_id,c.course_name, s.section_no, t.name
          FROM class cl, section s, course c, teachers t
          WHERE cl.section_id = s.section_id
          AND s.course_id = c.course_id
          AND cl.teacher_id = t.teacher_id
          ORDER BY c.course_name
          LIMIT $offset,$limit";

$result = mysqli_query($conn,$query);

$output = "";

$output.="<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
  <h1 class='h2'>Dashboard</h1>
</div>";

if(mysqli_num_rows($result)>0){
  $output.="<table class='table'>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Course</th>
                  <th>Section</th>
                  <th>Faculty Initials</th>
                  <th>Add Course</th>
                </tr>
              </thead>
            <tbody>";
   while ($row = mysqli_fetch_assoc($result)){

     $output.="<tr>
                  <td id='{$row['class_id']}'>{$row['class_id']}</td>
                  <td id='{$row['course_name']}'>{$row['course_name']}</td>
                  <td>{$row['section_no']}</td>
                  <td>{$row['name']}</td>
                  <td><button type='button' id='course_add' value = {$row['class_id']},{$row['course_name']} class='fas fa-plus' ></button></td>
                </tr>";
   }
   $output.="</tbody>
            </table>";

   $sql = "SELECT * from class";

   $records = mysqli_query($conn,$sql);

   $totalRecords = mysqli_num_rows($records);

   $totalPage = ceil($totalRecords/$limit);

   $output.="<ul class = 'pagination justify-content-center' style='margin:20px 0'>";

   for ($i=1; $i <= $totalPage ; $i++) {
	   if ($i == $page_no) {
		$active = "active";
	   }else{
		$active = "";
	   }

	    $output.="<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
	}

	$output .= "</ul>";

	echo $output;
}

if(isset($_POST['course_add'])){

    // Submitted form data
    $student_id   = $_POST['student_id'];
    $class_id  = $_POST['class_id'];
    $course_name = $_POST['course_name'];
    $sqlcheck = "SELECT sc.student_id, c.course_name
    FROM student_class sc, class cl, section s, course c
    WHERE sc.class_id = cl.class_id
    AND cl.section_id = s.section_id
    AND s.course_id = c.course_id
    AND sc.student_id = $student_id
    AND c.course_name = '$course_name'";

    $dup = mysqli_query($conn,$sqlcheck);
    if(mysqli_num_rows($dup)>0)
    {
      echo "duplicate";
    }
    else{
      $sql = "INSERT INTO student_class(student_id,class_id) VALUES ('$student_id','$class_id')";
      if(mysqli_query($conn,$sql)){
        header('Location: home.php');
      }else{
        echo 'query error: '.mysqli_error($conn);
      }
    }

  }

 ?>
<script type="text/javascript">

$(document).on("click","#course_add",function(e){
  var string = $(this).val();
  var class_details = string.split(',');
  var class_id = class_details[0];
  var course_name = class_details[1];
  // var class_id = document.getElementById(cid).innerText;
  var student_id = JSON.parse(window.localStorage.getItem('student_id'));
  $.ajax({
          type:'POST',
          url:'http://localhost/sms/add_course.php',
          data:'course_add=1&student_id='+student_id+'&class_id='+class_id+'&course_name='+course_name,
          success:function(data){
               $('#table-data').html(data);
               window.localStorage.clear();//https://blog.logrocket.com/localstorage-javascript-complete-guide/
               window.location.href = "/sms/home.php";
          },
          error:function(err){
            alert("lose");
          }

      });
});


</script>
