<?php
include "connection.php";
include "navbar.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fine calculation</title>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.table 
{
    border:3px solid black; 
}
.table td
{
    background:white;
}
.container
{
  height: 850px;
    background:white;
    color:black;
    margin-top:-78px;
    width: 100%;
}
body 
{
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}
.sidenav 
{
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
.sidenav a
 {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}
.sidenav a:hover 
{
  color: #f1f1f1;
}
.sidenav .closebtn 
{
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}
#main 
{
  transition: margin-left .5s;
  padding: 16px;
}
@media screen and (max-height: 450px) 
{
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.img-circle
{
  margin-left:50px; 
}
.h:hover
{
  color:white;
  width:300px;
  height:50px;
  background-color:#00544c;
}
</style>
</head>
<body>
  <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div style="color:yellow; font-size:18px; margin-left:30px; font-size:25px; padding:10px;">
        <?php
         if(isset($_SESSION['login_user']))
        { echo "<img class='img-circle profile_img'  height=150  width=150 src='images/".$_SESSION['image']."'>";
         echo " <br>";
         echo "Welcome    ".$_SESSION['login_user'];
         } ?>
       </div>
       <br><br>
       <div  class="h"> <a href="books.php"> Books</a></div>
 <div  class="h"> <a href="request.php">Book Request</a></div>
 <div  class="h"> <a href="issue_info.php">Issue Information</a></div>
 <div  class="h"> <a href="expired.php">Expired List</a></div>
</div>
<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "400px";
  document.getElementById("main").style.marginLeft = "400px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>
<div class="container">
  <br><h2 style="margin-left:0px; font-size:30px; text-align:center; font-family:cursive; color:red;">------------------My Fine -------------</h2><br><br>
      <?php
              $res=mysqli_query($con,"SELECT * FROM `fine` where full_name='$_SESSION[login_user]';");
              echo "<table class='table table-bordered' >";
              echo "<tr style='background-color:black; color:white;' >";
              echo "<th>"; echo"User Name"; echo"</th>";
              echo "<th>"; echo"Book Id";  echo"</th>";
              echo "<th>"; echo"Returened Date"; echo"</th>";
              echo "<th>"; echo"Days"; echo"</th>";
              echo "<th>"; echo"Fine in $"; echo"</th>";
              echo "<th>"; echo"Status"; echo"</th>";
              echo"</tr>";
              while($row=mysqli_fetch_assoc($res))
              {
                echo "<tr>";
                echo "<td>"; echo  $row['full_name']; echo"</td>";
                echo "<td>"; echo $row['bid']; echo"</td>";
                echo "<td>"; echo  $row['returned']; echo"</td>";
                echo "<td>"; echo  $row['day']; echo"</td>";
                echo "<td>"; echo $row['fine']; echo"</td>";
                echo "<td>"; echo $row['status']; echo"</td>";
                echo "</tr>";
                
              }
              echo "</table>"; 
        ?>
</div>
</body>
</html>