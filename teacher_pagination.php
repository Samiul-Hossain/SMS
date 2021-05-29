<?php

require_once('config/db_connect.php');

$limit = 5;

if(isset($_POST['page_no'])){
  $page_no = $_POST['page_no'];
}else{
  $page_no = 1;
}

$offset = ($page_no-1)*$limit;

$query = "SELECT * FROM teachers LIMIT $offset,$limit";

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
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Date of Birth</th>
                  <th>Mobile</th>
                  <th>Profile</th>
                </tr>
              </thead>
            <tbody>";
   while ($row = mysqli_fetch_assoc($result)){

     $output.="<tr>
                  <td id='{$row['teacher_id']}'>{$row['teacher_id']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['gender']}</td>
                  <td>{$row['date_of_birth']}</td>
                  <td>{$row['mobile']}</td>
                  <td><a href='teacher_profile.php?edit={$row['teacher_id']}' class='fas fa-eye' value={$row['teacher_id']} name='id_to_edit'></a></td>
                </tr>";
   }
   $output.="</tbody>
            </table>";

   $sql = "SELECT * from teachers";

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
