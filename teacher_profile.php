<?php
  include('config/db_connect.php');
  $name=$date_of_birth=$mobile=$gender=$teacher_id=0;

  if(isset($_GET['edit'])){
  $teacher_id = $_GET['edit'];
  $sql = "SELECT * FROM teachers WHERE teacher_id=$teacher_id";
  $resultE = mysqli_query($conn, $sql);
  $row=$resultE->fetch_array();
  if(count($row)){
    $name=$row['name'];
    $date_of_birth=$row['date_of_birth'];
    $mobile=$row['mobile'];
    $gender=$row['gender'];
  }

$csql = "SELECT c.course_name,s.section_no,r.day,r.time_start,r.time_end
          FROM class cl, section s, course c, routine r, teachers t
          WHERE cl.teacher_id = $teacher_id
          AND cl.teacher_id = t.teacher_id
          AND cl.section_id = s.section_id
          AND s.section_id = r.section_id
          AND s.course_id = c.course_id";

  $result = mysqli_query($conn,$csql);
  $courses = mysqli_fetch_all($result,MYSQLI_ASSOC);

}

if(isset($_POST['update'])){
  $id=$_POST['teacher_id'];
  $name=$_POST['name'];
  $date_of_birth=$_POST['date_of_birth'];
  $mobile=$_POST['mobile'];
  $gender=$_POST['group1'];

  $sql="UPDATE teachers SET name='$name', date_of_birth='$date_of_birth', mobile='$mobile', gender='$gender' WHERE teacher_id=$id";

  if(mysqli_query($conn,$sql)){
    header('Location: home.php');
  }else{
    echo 'query error: '.mysqli_error($conn);
  }

}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>SMS Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link href="dashboard.css" rel="stylesheet">
    <!-- <link href="profile.css" rel="stylesheet"> -->
  </head>
  <body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
   <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="home.php" id="hm" >Home</a>
   <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <ul class="navbar-nav px-3">
     <li class="nav-item text-nowrap">
       <a class="nav-link" href="logout.php">Sign out</a>
     </li>
   </ul>
 </header>
 <div class="container-fluid form-group row">
   <form action="profile.php" method="post" class="reg-form">
     <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">
   <div class="col">
     <div class="card mb-3">
       <div class="card-body">
         <div class="row">
           <div class="col-sm-3">
             <h6 class="mb-0">Name</h6>
           </div>
           <div class="col-sm-9 text-secondary">
             <input class="form-control" name="name" type="text" value="<?php echo $name ?>" id="name-input">
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <h6 class="mb-0">Gender</h6>
           </div>
           <div class="col-sm-9 text-secondary">
             <p>
               <label>
                 <input name="group1" type="radio" id="male" value="male" <?php echo ($gender== 'male') ?  "checked" : "" ;  ?> />
                 <span>Male</span>
               </label>
             </p>
             <p>
               <label>
                 <input name="group1" type="radio" id="female" value="female" <?php echo ($gender== 'female') ?  "checked" : "" ;  ?> />
                 <span>Female</span>
               </label>
             </p>
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <h6 class="mb-0">Date of Birth</h6>
           </div>
           <div class="col-sm-9 text-secondary">
             <input class="form-control" name="date_of_birth" type="date" value="<?php echo $date_of_birth ?>" id="date-input">
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <h6 class="mb-0">Mobile</h6>
           </div>
           <div class="col-sm-9 text-secondary">
             <input class="form-control" name="mobile" type="text" value="<?php echo $mobile ?>" id="mobile-input">
           </div>
         </div>
         <hr>
         <div class="row">
           <div class="col-sm-3">
             <h6 class="mb-0">Courses</h6>
           </div>
           <div class="col-sm-9 text-secondary">
             <ul>
               <?php foreach ($courses as $course){?>
               <li><?php echo $course['course_name']?> <?php echo $course['section_no']?> <?php echo $course['day']?> <?php echo $course['time_start']?>-<?php echo $course['time_end']?></li>
             <?php } ?>
             </ul>
           </div>
         </div>
         <hr>
         <input type="submit" name="update" value="update" class="btn btn-lg btn-info">
       </div>
     </div>
 </div>
</form>
</div>
  </body>
</html>
