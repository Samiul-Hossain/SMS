<?php
  include('config/db_connect.php');
?>
<html>
 <head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>SMS Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="dashboard.css" rel="stylesheet">
 </head>
 <body>
   <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="home.php" id="hm" >Home</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
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
    </main>
 </div>
 </body>
 <script type="text/javascript">
   $(document).ready(function(){

     //course managmement
     $('#cm').click(function(){
       function loadData(page){
         $.ajax({
           url : 'http://localhost/sms/course_pagination.php',
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

   });
 </script>
</html>
