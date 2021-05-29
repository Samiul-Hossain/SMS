<?php
  include('config/db_connect.php');

  if(isset($_POST['cfs']) ){
    // Submitted form data
    $name   = $_POST['name'];
    $mobile  = $_POST['mobile'];
    $date_of_birth = $_POST['date'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO teachers(name,gender,date_of_birth,mobile) VALUES ('$name','$gender','$date_of_birth','$mobile')";
    if(mysqli_query($conn,$sql)){
      header('Location: index.php');
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
   <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fas fa-arrow-left" href="home.php" id="hm" ></a>
   <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <ul class="navbar-nav px-3">
     <li class="nav-item text-nowrap">
       <a class="nav-link" href="logout.php">Sign out</a>
     </li>
   </ul>
 </header>
 <div class="container-fluid">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
       <div class="position-sticky pt-3">
         <ul class="nav flex-column">
           <li class="nav-item">
             <a class="nav-link" href="student_management.php" id="sm">
               <span data-feather="home"></span>
               Student Management
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="teacher_management.php" id="tm">
               <span data-feather="file"></span>
               Teacher Management
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="course_management.php" id="cm">
               <span data-feather="shopping-cart"></span>
               Course Management
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="routine_management.php">
               <span data-feather="users"></span>
               Routine Management
             </a>
           </li>
         </ul>
       </div>
     </nav>
     <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

       <div class="container-fluid" id="stud" >
         <div class="row">
           <div class="col-md-12">
             <div id="table-data">

             </div>
           </div>
         </div>
       </div>
       </form>
       <div class="d-flex justify-content-center">
           <div class="">
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">Add Teacher</button>
           </div>
           <div class="modal fade" id="modalForm" role="dialog">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <h4 class="modal-title" id="myModalLabel">Add Teacher</h4>
                   <button type="button" class="close" data-dismiss="modal">
                     <span aria-hidden="true">x</span>
                     <span class="sr-only">Close</span>
                   </button>

                 </div>

                 <div class="modal-body">
                   <p class="statusMsg"></p>
                   <form role="form">
                     <div class="form-group">
                       <label for="name">Name:</label>
                       <input type="text" name="" value="" class="form-control" id="name" placeholder="Enter your name">
                     </div>
                     <div class="form-group">
                       <label for="">Gender:</label>
                       <p>
                         <label>
                           <input name="group1" type="radio" id="male" value="male"/>
                           <span>Male</span>
                         </label>
                       </p>
                       <p>
                         <label>
                           <input name="group1" type="radio" id="female" value = "female"/>
                           <span>Female</span>
                         </label>
                       </p>
                     </div>
                     <div class="form-group">
                       <label for="name">Date of Birth:</label>
                       <input class="form-control" name="date_of_birth" type="date" value="" id="date">
                     </div>
                     <div class="form-group">
                       <label for="address">Mobile:</label>
                       <input type="text" name="" value="" class="form-control" id="mobile" placeholder="Enter your mobile number">
                     </div>
                   </form>
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-primary submitBtn" onclick="scf()" id="mail-submit">SUBMIT</button>
                 </div>
                 <p class="form-message"></p>
               </div>

             </div>
           </div>
       </div>
     </main>
  </div>
  </body>
  <script>
  //ADD STUDENT
    function scf(){
      var name = $('#name').val();
      var mobile = $('#mobile').val();
      var date = $('#date').val();
      var gender = $('input[name=group1]:checked').val();
      if(name.trim() == ''){
        alert('PLease enter your name.');
        $('#name').focus();
        return false;
      }else if(mobile.trim() == ''){
        alert('Please enter your email');
        $('#email').focus();
        return false;
      }else{
        $.ajax({
            type:'POST',
            url:'http://localhost/sms/teacher_management.php',
            data:'cfs=1&name='+name+'&date='+date+'&mobile='+mobile+'&gender='+gender,
            success:function(data){
                 location.reload();
            },
            error:function(err){
              alert("lose");
            }

        });
        }
      }
  </script>

  <script>
    $(document).ready(function(){
      function loadData(page){
        $.ajax({
          url : 'http://localhost/sms/teacher_pagination.php',
          type : "POST",
          cache : false,
          data : {page_no:page},
          success:function(response){
            $('#table-data').html(response);
          }
        });
      }
      loadData();

      //pagination code
      $(document).on("click",".pagination li a", function(e){
        e.preventDefault();
        var pageId = $(this).attr("id");
        loadData(pageId);
      });
    });
  </script>
</html>
