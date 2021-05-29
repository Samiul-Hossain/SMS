<?php
//login.php
session_start();
$connect = mysqli_connect('localhost','samiul','*9D7ahMV$FV@4Cx','sms');
if(isset($_POST["username"]) && isset($_POST["password"]))
{
 $username = mysqli_real_escape_string($connect, $_POST["username"]);
 $password = mysqli_real_escape_string($connect, $_POST["password"]);
 $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
 $result = mysqli_query($connect, $sql);
 $num_row = mysqli_num_rows($result);
 if($num_row > 0)
 {
  $data = mysqli_fetch_array($result);
  $_SESSION["username"] = $data["username"];
  echo $data["username"];
 }
}
?>
