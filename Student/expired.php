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
    <title>Expired List</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
body 
{
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
  background-image: url("images/issue.jpg");
  background-repeat:none;
  position:fixed;
  width: 100%;
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
  padding-left: 10px;
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
.container
{
  height: 800px;
  background:black;
  opacity: .7;
  color:white;
  margin-top:-63px;
  width: 80%;
}
.scroll
{
    width: 100%;
    height: 600px;
    overflow:auto;
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
         echo " <br><br>";
         echo "Welcome    ".$_SESSION['login_user'];
         } ?>
       </div>
       <br><br>
<div class ="h"><a href="books.php">Books</a></div>
 <div  class="h"> <a href="request.php">Book Request</a></div>
 <div  class="h"> <a href="issue_info.php">Issue Information</a></div>
 <div  class="h"> <a href="expired.php">Expired List</a></div>     
</div>
<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
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
<div class= "container">
  <form method="post" action="">
     <div style="float:left; padding:25px">
     <button name="submit2" type="submit" style="background-color:#06861a; color:yellow;" class="btn btn-default">RETURNED</button>&nbsp; &nbsp; &nbsp; 
     <button name="submit3" type="submit" style="background-color:red; color:yellow;" class="btn btn-default">EXPIRED</button></div></form>
  <div style="float:right; padding-top:20px;">
  <?php
   $var=0;
   $result=mysqli_query($con,"SELECT * FROM `fine` where full_name='$_SESSION[login_user]' and status='not paid';");
   while($row=mysqli_fetch_assoc($result))
   {
     $var =$var+$row['fine'];
   }
  $var2=$var+$_SESSION['fine'];
  ?>
  <h2 style =" font-size:25px; ">Your Fine is:
    <?php
     echo "$" .$var;
    ?>
  </h2>
  </div>
  <br><br><h2 style =" font-size:28px; text-align:center;">Date Expired List</h2><br><br>
  <?php
   if(isset($_SESSION['login_user']))
   {
    $exp='<p style="color:yellow; background-color:red;">EXPIRED</p>';
    $ret='<p style="color:yellow; background-color:green;">RETURNED</p>';
    if(isset($_POST['submit2']))
    {
      $sql="SELECT student_registration.full_name,id,books.bid,name,authors,edition,approve,issue,issue_book.returns FROM student_registration inner join issue_book ON student_registration.full_name=issue_book.full_name inner join books ON issue_book.bid=books.bid 
      WHERE issue_book.approve='$ret' and student_registration.full_name='$_SESSION[login_user]'ORDER BY `issue_book` . `returns` DESC";
      $res=mysqli_query($con,$sql);
    }
    else if(isset($_POST['submit3']))
    { 
      $sql="SELECT student_registration.full_name,id,books.bid,name,authors,edition,approve,issue,issue_book.returns FROM student_registration inner join issue_book ON student_registration.full_name=issue_book.full_name inner join books ON issue_book.bid=books.bid 
      WHERE issue_book.approve='$exp' and student_registration.full_name='$_SESSION[login_user]' ORDER BY `issue_book` . `returns` DESC";
      $res=mysqli_query($con,$sql);
    }
    else
    {
       $var1='<p style="color:yellow; background-color:red;">EXPIRED</p>';
      $sql="SELECT student_registration.full_name,id,books.bid,name,authors,edition,approve,issue,issue_book.returns FROM student_registration inner join issue_book ON student_registration.full_name=issue_book.full_name inner join books ON issue_book.bid=books.bid 
      WHERE issue_book.approve!='' and issue_book.approve!='Yes' and student_registration.full_name='$_SESSION[login_user]' ORDER BY `issue_book` . `returns` DESC";
      $res=mysqli_query($con,$sql);
    }
    echo "<div class='scroll'>";
    echo "<table class='table table-bordered' >";
    echo "<tr style='background-color:#6db6b9e6;'>";
    echo "<th>"; echo"Student ID"; echo"</th>";
    echo "<th>"; echo"Student Name"; echo"</th>";
    echo "<th>"; echo"Book ID"; echo"</th>";
    echo "<th>"; echo"Book Name"; echo"</th>";
    echo "<th>"; echo"Authors Name"; echo"</th>";
    echo "<th>"; echo"Edition"; echo"</th>";
    echo "<th>"; echo"Approve Status"; echo"</th>";
    echo "<th>"; echo"Issue Date"; echo"</th>";
    echo "<th>"; echo"Return Date"; echo"</th>";
    echo"</tr>";
    while($row=mysqli_fetch_assoc($res))
      {
         echo "<tr>";
         echo "<td>"; echo $row['id']; echo"</td>";
         echo "<td>"; echo $row['full_name']; echo"</td>";
         echo "<td>"; echo $row['bid']; echo"</td>";
         echo "<td>"; echo $row['name']; echo"</td>";
         echo "<td>"; echo  $row['authors']; echo"</td>";
         echo "<td>"; echo $row['edition']; echo"</td>";
         echo "<td>"; echo $row['approve']; echo"</td>";
         echo "<td>"; echo $row['issue']; echo"</td>";
         echo "<td>"; echo $row['returns']; echo"</td>";
         echo "</tr>";
      }
      echo "</table>";
      echo "</div>";
                
   }
?>
</div>
</body>
</html>

