<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sise Navbar</title>
<link rel="stylesheet" href="st.css">
<style>
  body {
   font-family: "Lato", sans-serif;
   transition: background-color .5s;
   background:fixed;
  }
 .sidenav {
   height: 100%;
   margin-top:50px;
   width: 0;
   position: fixed;
   z-index: 1;
   top: 0;
   left: 0;
   background-color: #222;
   overflow-x: hidden;
   transition: 0.5s;
   padding-top: 60px;
 }
 .sidenav a {
   padding: 8px 8px 8px 32px;
   text-decoration: none;
   font-size: 25px;
   color: #818181;
   display: block;
   transition: 0.3s;
 }
 .sidenav a:hover {
  color: #f1f1f1;
 }
 .sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
  text-decoration:none;
 }
 #main {
  transition: margin-left .5s;
  padding: 16px;
  color:black;
 }
 @media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
 }
 .img-circle{
   margin-left:50px; 
 }
 .h .side{
text-decoration:none;
 }
 .h:hover{
   color:white;
   width:300px;
   height:50px;
   background-color:#00544c;
 }
</style></head>
<body>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div style="color:yellow; font-size:18px; margin-left:30px; font-size:25px; padding:10px;">
 <?php
  if(isset($_SESSION['login_user']))
 { echo "<img class='img-circle profile_img'  height=150  width=150 src='images/".$_SESSION['image']."'>";
  echo " <br><br>";
  echo "Welcome    ".$_SESSION['login_user'];
  } ?>
 </div><br><br>
  <div class="h">  <a  class="side" href="profile.php">Profile</a></div>
  <div class ="h"><a  class="side" href="add.php">Add Books</a></div>
  <div  class="h"> <a  class="side" href="request.php">Book Request</a></div>
  <div  class="h"> <a  class="side" href="issue.php">Issue Information</a></div>
  <div  class="h"> <a  class="side" href="expired.php">Expired List</a></div>   </div>
<div id="main">
<span style="font-size:30px;cursor:pointer color:red; opicity:.9;" onclick="openNav()">&#9776; open</span>
<script>
function openNav() 
{
  document.getElementById("mySidenav").style.width = "400px";
  document.getElementById("main").style.marginLeft = "400px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}
function closeNav() 
{
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>
</body>
</html>