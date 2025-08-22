<?php
session_start();
include "connection.php";
include "navbar.php";
?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="st.css">  
<style>
    .log_img
   {
    height: 800px;
    background-image: url("images/login_img.jpeg");
   }
  .login
  {
    margin:10px;
  }
  input 
  {
    height: 25px;
    width: 700px;
  }
  section
  {
    margin-top:-20px;
  }
    .box
  {
    height: 600px;
    width: 550px;
    background-color:black;
    margin:30px auto;
    opacity: .9;
    color: aliceblue;
  }
  .input-group
 {
   width: 500px;
   margin-left:60px;
 }
 input[type="submit"] {
      margin-left:200px;
    }
 @media (max-width: 500px) {
    .box{
    
          width:300px;
          height:500px;
          opacity: .9;
          text-align:center;
          margin-left:40px;

    }
   .log_img
   {
        width:370px;
   }
    h1 {
      font-size: 22px;
    }

    .input-group {
     
      width:330px;
      margin-left:0px;
    }
    input[type="submit"] {
      margin-left:0px;
    }

  }
 
</style>
</head>
<body>
<section>
<div class="log_img"><br>
<div class="box"><br><br><br>
<h1 style="color:white;text-align:center; font-family:'Times New Roman', Times, serif;"> Library Management System</h1><br><br><br>
<h2 style="font-size: 25px; color:yellow;text-align:center;font-family: cursive;">----Admin Login Form---</h2><br><br><br>
<form name="Login" action="" method="post"><br>
<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input type="name" style="width:80%;" class="form-control" name="full_name" placeholder="Username">
</div><br><br>
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
<input id="password"  style="width:80%;" type="password" class="form-control" name="password" placeholder="Password">
</div><br><br><br>
<input type="submit" name="login" value="Login" style="color:white; background-color: green; height:30px; width:100px; border:10px black; font-size:15px; border-radius:10px;"><br><br>             
<p style="color: aliceblue; padding: 15px text-align:center;"><br>
 <a  style="color:aliceblue; text-decoration:none;  font-size:15px; margin-left:80px;" href="update.php" text-decoration:none;>Forgot password?</a>&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; New to this website?<a style="color: aliceblue; text-decoration:none; font-size:15px;" href="registration.php">&nbsp; Sign Up</a></p>
</form>
</div>
</div>
</section>
 <?php
if(isset($_POST['login']))
{
$count=0;
$res=mysqli_query($con,"SELECT * FROM `admin` WHERE full_name ='$_POST[full_name]' && password='$_POST[password]' and status='yes';");
$row=mysqli_fetch_assoc($res);
$count=mysqli_num_rows($res);
if($count==0)
 {?>
 <script>alert("The username and password doesn't match");</script><?php      
     }
     else{
        $_SESSION['login_user']=$_POST['full_name'];
        $_SESSION['image']=$row['image'];
        $_SESSION['username']='';
      ?>
      <script> window.location="./profile.php"; </script>
      <?php
     }
 }
?>
</body>
</html>