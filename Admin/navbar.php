<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width initial-scale=1.0">
<title>Navbar</title>
<link rel="stylesheet" href="st.css">
<link rel="stylesheet" href="https://maxcdn.boo
tstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqu
ery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap
/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
 $r=mysqli_query($con,"SELECT COUNT(status) as total FROM `messages` WHERE status='No'  and sender='student';");
$c= mysqli_fetch_assoc($r);
 $sql_app=mysqli_query($con,"SELECT COUNT(status) as total FROM `admin` WHERE status='';");
 $a=mysqli_fetch_assoc($sql_app);
?>
<nav class="navbar navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<a class="navbar-brand">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
</div>
<ul class="nav navbar-nav">
<li ><a href="../index.php">HOME</a> </li>
<li><a href="books.php">BOOKS</a> </li>
<li><a href="feedback.php">FEEDBACK</a></li>
</ul>
<?php
 if(isset($_SESSION['login_user']))
  {
?>
      <ul class="nav navbar-nav">
  <li><a href="student.php">STUDENT-INFORMATION</a></li>
  <li><a href="fine.php">FINE</a></li>
   <li ><a href="profile.php">PROFILE</a> </li></ul>
  <ul class="nav navbar-nav navbar-right">
<li><a href="admin_approve.php"><span class="glyphicon glyphicon-user"></span>
<span class="badge bg-green">
<?php echo $a['total']; ?> </span> </a>
<li><a href="message.php"><span class="glyphicon glyphicon-envelope"></span>
 <span class="badge bg-green"><?php echo $c['total']; ?> </span></a></li>
<li><a href="">
 <div style="color:yellow; font-size:18px;">
<?php
  echo "<img class='img-circle profile_img'  height=30  width=30  src='images/".$_SESSION['image']."'>";
  echo "   ".$_SESSION['login_user']; ?>
 </div></a></li>
<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li></li></ul>
<?php
  }
?>
</div></nav>
</body>
</html>