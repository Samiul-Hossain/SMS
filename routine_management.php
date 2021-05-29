<?php
  include('config/db_connect.php');

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
             <a class="nav-link" href="#">
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
     </main>
  </div>
  </body>
  <script>
    $(document).ready(function(){
      function loadData(page){
        $.ajax({
          url : 'http://localhost/sms/routine_pagination.php',
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
