<?php
include "connection.php";
include "navbar.php";
include "sidenav.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired List</title>
    <link rel="stylesheet" href="st.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
body {
  background-image: url("images/issue.jpg");
}
.container{
  height: 800px;
  background:black;
  opacity: .7;
  color:white;
  margin-top:-79px;
  width: 80%;
}
.srch{
    padding-left:70%;
}
.scroll{
    width: 100%;
    height: 480px;
    overflow:auto;
}
</style></head>
<body>
<div class= container>
<form method="post" action="">
<div style="float:left; padding:25px">
<button   name="submit2" type="submit" style="background-color:#06861a; color:yellow;" class="btn btn-default">RETURNED</button>&nbsp; &nbsp; &nbsp; 
<button   name="submit3" type="submit" style="background-color:red; color:yellow;" class="btn btn-default">EXPIRED</button>
</div></form><br>
<div class="srch">
  <form method="post" action="" name="form1">
<input type="text" name="full_name" class="form-control"  placeholder="Username" required=""><br>
<input type="text" name="bid" class="form-control"  placeholder="BID" required=""><br>
<button class="btn btn-default" type="submit" name="submit" style ="margin-left:130px;">Return</button></form></div>
<?php
if(isset($_POST['submit']))
{
$_SESSION['bid']=$_POST['bid'];
 /*--------Fine calculation Start----------------*/
$res= mysqli_query($con,"SELECT * FROM `issue_book` WHERE full_name='$_POST[full_name]' and bid='$_POST[bid]';");
while($row=mysqli_fetch_assoc($res))
{
  $day=0;
  $d= strtotime($row['returns']);
  $c=strtotime(date("Y-m-d"));
  $diff=abs($c-$d);
  if($diff>=0)
  {
    $day=$day+floor($diff/86400);
    $fine= $day*.10;
  }
}
$x=date("Y-m-d");
mysqli_query($con,"INSERT INTO `fine`(`full_name`, `bid`, `returned`, `day`, `fine`, `status`) VALUES ('$_POST[full_name]','$_POST[bid]','$x','$day','$fine','not paid'); ");
/*--------Fine calculation End-------------*/
$var='<p style="color:yellow; background-color:green;">RETURNED</p>';
mysqli_query($con,"UPDATE `issue_book` SET approve='$var' where full_name='$_POST[full_name]' and bid='$_POST[bid]';");
mysqli_query($con,"UPDATE `books` set `status`='Available',`quantity`=quantity+1 WHERE bid='$_SESSION[bid]';");
}
?>
<h3 style ="text-align:center;">Date Expired/Returned List</h3><br>
<?php
if(isset($_SESSION['login_user']))
{
 $exp='<p style="color:yellow; background-color:red;">EXPIRED</p>';
 $ret='<p style="color:yellow; background-color:green;">RETURNED</p>';
 if(isset($_POST['submit2']))
 {
 $sql="SELECT student_registration.full_name,id,books.bid,name,authors,edition,approve,issue,issue_book.returns FROM student_registration inner join issue_book ON student_registration.full_name=issue_book.full_name inner join books ON issue_book.bid=books.bid 
WHERE issue_book.approve='$ret' ORDER BY `issue_book` . `returns` DESC";
  $res=mysqli_query($con,$sql);
 }
 else if(isset($_POST['submit3'])){ 
   $sql="SELECT student_registration.full_name,id,books.bid,name,authors,edition,approve,issue,issue_book.returns FROM student_registration inner join issue_book ON student_registration.full_name=issue_book.full_name inner join books ON issue_book.bid=books.bid 
   WHERE issue_book.approve='$exp'  ORDER BY `issue_book` . `returns` DESC";
   $res=mysqli_query($con,$sql);
 }
 else{
   $sql="SELECT student_registration.full_name,id,books.bid,name,authors,edition,approve,issue,issue_book.returns FROM student_registration inner join issue_book ON student_registration.full_name=issue_book.full_name inner join books ON issue_book.bid=books.bid 
   WHERE issue_book.approve!='' and issue_book.approve!='Yes'  ORDER BY `issue_book` . `returns` DESC";
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
  echo "<th>"; echo"Return Date"; echo"</th>";echo"</tr>";
  while($row=mysqli_fetch_assoc($res)){
     echo "<tr>";  echo "<td>";
     echo $row['id']; echo"</td>";
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
}?>
</div>
</body>
</html>