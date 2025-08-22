<?php
session_start();
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin Profile</title>
<style>
  footer
{
 height: 230px;
 width: 900px;
 background-color: rgb(1, 4, 4);
}
.fa{
margin:0px 9px;
padding: 5px;
font-size:23px;
width:40px;
height: 40px;
text-align:center;
text-decoration:none;
border-radius:30%;
word-spacing:10px;
}
.fa-hover{
opacity: .6;
}
.fa-facebook{
    background:#3B5998;
    color:white;
}
.fa-twitter{
    background:#55ACEE;
    color:white;
}
.fa-google{
background:Linear-gradient(-120DEG,#4285F4,#34A853,#FBBC05,#EA4335);
color:white;
}
.fa-instagram{
    background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
    background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
    background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );
    color:white;
}
.fa-linkedin{
    background:blue;
    color:white;
}
   .wrapper
   {
      width:450px;
      color:white;
    background:black;
    height:700px;
    }
    .a{
    
     padding:10px;

  
    }
    .table-scripted
    {
       width:90%;
       background:white;
       color:black;
    
    }
</style>
</head>
<body style="background-color:white;">
 <form action="" method="post">
   <button class="btn btn-primary" style="float:right;  width:80px; margin-right:20px; font-size:20px;" name="submit1" type="submit">Edit</button>
 </form>
 <div class="col-sm-4">
 <div class="wrapper">
    <?php
     if(isset($_POST['submit1']))
     {
        ?><script> window.location="edit.php";</script>
        <?php
     }
  $q=mysqli_query($con,"SELECT * FROM `admin` WHERE full_name='$_SESSION[login_user]';");
    ?>
  <br><b><h2 style="text-align:center; color:white; font-size:35px;">My Profile</b></h2><br><br><br>
  <?php
    $row=mysqli_fetch_assoc($q);
    echo "<div style='text-align:center;'><img class='img-circle profile-img' height=250  width=250 src='images/".$_SESSION['image']."'></div>";
  ?>
  <br><br><br>
  <h2 style=" font-size:30px;  color:red; text-align:center;">
  <?php
    echo "Welcome  ".$_SESSION['login_user'] ;   ?> </h2>
</div>
    </div>
    <div class="col-sm-8">
    <h2 style="font-weight:bold;">Account Details</h2><hr style="color:black;font-weight:bold;">
 <div class="a" style="font-size:30px; font-family:cursive;">
    <?php
      echo "<table class='table table-scripted'>";
      echo "<tr>";
        echo "<td>";
           echo "<b>User Name:</b>";
        echo "</td>";
        echo "<td>";
          echo $row['full_name'];
        echo "</td>";
       echo "</tr>";
       echo "<tr>";
        echo "<td>";
          echo "<b>Password:</b>";
        echo "</td>";
        echo "<td>";
           echo $row['password'];
        echo "</td>";
       echo "</tr>";
       echo "<tr>";
        echo "<td>";
          echo "<b>Gender:</b>";
        echo "</td>";
        echo "<td>";
          echo $row['gender'];
        echo "</td>";
       echo "</tr>";
       echo "<tr>";
         echo "<td>";
           echo "<b>Email:</b>";
          echo "</td>";
          echo "<td>";
             echo $row['email'];
          echo "</td>";
       echo "</tr>";
       echo "<tr>";
        echo "<td>";
           echo "<b>Contact No:</b>";
        echo "</td>";
        echo "<td>";
            echo $row['Phone'];
        echo "</td>";
       echo "</tr>";
      echo "</table>";
    ?>
 </div>
 <footer>
<br>
<div  style="margin-left:300px; padding:10px;">
<a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-google"></a>
<a href="#" class="fa fa-instagram"></a>
<a href="#" class="fa fa-linkedin"></a>
</div>
<h3 style="color: aliceblue; text-align: center;   font-family:'Times New Roman', Times, serif;">
Email:&nbsp;Online.library@gmail.com<br><br>
Mobile:&nbsp;&nbsp;+8880101*********</h3>
</footer>
    </div>
</body>
</html>