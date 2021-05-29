<?php
//index.php
session_start();
if(isset($_SESSION["username"]))
{
 header("location:home.php");
}
?>
<html>
 <head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>SMS login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity>
  <style>
  #box
  {
   width:100%;
   max-width:500px;
   border:1px solid #ccc;
   border-radius:5px;
   margin:0 auto;
   padding:0 20px;
   box-sizing:border-box;
   height:270px;
  }
  </style>
 </head>
 <body>
  <div class="container">
   <h2 align="center">Admin Login</h2><br /><br />
   <div id="box">
    <br />
    <form method="post">
     <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" id="username" class="form-control" />
     </div>
     <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" id="password" class="form-control" />
     </div>
     <div class="form-group">
      <button type="submit" name="login" id="login" class="btn btn-success" value="login">
        <span>Login</span>
      </button>
     </div>
     <div id="error"></div>
    </form>
    <br />
   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 $('#login').on("click",function(){
  var username = $('#username').val();
  var password = $('#password').val();
  if($.trim(username).length > 0 && $.trim(password).length > 0)
  {
   $.ajax({
    url:'http://localhost/sms/login.php',
    method:"POST",
    data:{username:username, password:password},
    cache:false,
    beforeSend:function(){
     $('#login').val("connecting...");
    },
    success:function(data)
    {
     if(data)
     {
      window.location.href="/sms/home.php";
     }
     else
     {
      $('#login').val("Login");
      $('#error').html("<span class='text-danger'>Invalid username or Password</span>");
     }
    }
   });
  }
  else
  {

  }
 });
});
</script>
