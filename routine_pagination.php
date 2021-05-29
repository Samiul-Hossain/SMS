<?php

require_once('config/db_connect.php');

$limit = 5;

if(isset($_POST['page_no'])){
  $page_no = $_POST['page_no'];
}else{
  $page_no = 1;
}

$offset = ($page_no-1)*$limit;

$query = "SELECT r.routine_id,c.course_name,s.section_no,r.day,r.time_start,r.time_end,t.name
          FROM routine r, course c, section s, class cl, teachers t
          WHERE r.section_id = s.section_id
          AND s.course_id = c.course_id
          AND s.section_id = cl.section_id
          AND cl.teacher_id = t.teacher_id
          ORDER BY r.routine_id
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
                  <th>Faculty</th>
                  <th>Day</th>
                  <th>Timing</th>
                </tr>
              </thead>
            <tbody>";
   while ($row = mysqli_fetch_assoc($result)){

     $output.="<tr>
                  <td>{$row['routine_id']}</td>
                  <td>{$row['course_name']}</td>
                  <td>{$row['section_no']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['day']}</td>
                  <td>{$row['time_start']}-{$row['time_end']}</td>
                </tr>";
   }
   $output.="</tbody>
            </table>";

   $sql = "SELECT r.routine_id,c.course_name,s.section_no,r.day,r.time_start,r.time_end,t.name
             FROM routine r, course c, section s, class cl, teachers t
             WHERE r.section_id = s.section_id
             AND s.course_id = c.course_id
             AND s.section_id = cl.section_id
             AND cl.teacher_id = t.teacher_id
             ORDER BY r.routine_id";

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
