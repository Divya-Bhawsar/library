<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>update Page</title>
<style>
 body{
     background-image: url("images/update.png");
 }
 .wrapper{
   width:500px;
   height: 500px;
   margin:100px auto;
   background:black;
   opacity: .6;
   text-align:center;
 }
 .input-group{
   width:80%;
   margin-left:50px;
}
</style></head>
<body>
<div class="wrapper"><br>
<h1 style="font-size: 35px; color:white; "> Library Management System</h1><br>
<h2 style="font-size: 25px;color:white;">Change Your Password</h2><br>
<form name="Login" action="" method="post"><br>
<div class="form-group">
  <div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input type="name" class="form-control" name="full_name" placeholder="Username"></div><br>
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input type="email" class="form-control" name="email" placeholder="Email"></div><br>
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
<input id="password" type="password" class="form-control" name="password" placeholder="New Password" required="">
</div><br><br>
<input type="submit" name="update" value="Update" style="color:black; background-color: aqua; height:30px; width:100px; border:10px black; font-size:15px; border-radius:10px"></div>  </div>
<?php
if(isset($_POST['update'])){
if(mysqli_query($con,"UPDATE `student_registration` set password='$_POST[password]' where full_name='$_POST[full_name]' AND email='$_POST[email]';")){
  ?>
<script> alert("The Password Updated Succesfully")</script>
<?php  }  } ?>
</body>
</html>