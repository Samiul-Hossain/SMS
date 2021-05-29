<?php

require_once('config/db_connect.php');

$limit = 10;

if(isset($_POST['page_no'])){
  $page_no = $_POST['page_no'];
}else{
  $page_no = 1;
}

$offset = ($page_no-1)*$limit;

$query = "SELECT c.course_name, s.section_no, t.name
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
                  <th>Course</th>
                  <th>Section</th>
                  <th>Faculty Initials</th>
                </tr>
              </thead>
            <tbody>";
   while ($row = mysqli_fetch_assoc($result)){

     $output.="<tr>
                  <td>{$row['course_name']}</td>
                  <td>{$row['section_no']}</td>
                  <td>{$row['name']}</td>
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

 ?>
