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
    <title>Student Books Request</title>
    <link rel="stylesheet" href="st.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
body 
{
  background-image: url("images/request.jpeg");
  position:fixed;
  width: 100%;
}
.container
{
  height: 800px;
  background:black;
  opacity: .7;
  color:white;
  margin-top:-78px;
  width: 80%;
}
.form-control
{
  width:300px;
  height:40px;
  margin-top:20px;
 display: inline;
padding: 10px;
}
.scroll{
  width: 100%;
  height: 540px;
  overflow:auto;
}
  </style>
</head>
<body>
<div class="container">
  <div class="srch">
    <form method="post" action="" name="form1">
      <input type="text" name="full_name" class="form-control"  placeholder="Username" required="">&nbsp; &nbsp;
      <input type="text" name="bid" class="form-control"  placeholder="BID" required="">
      <button class="btn btn-info btn-lg" name="submit" style="margin-left:20px;  margin-top:20px; background-color:green;">Accept 
        <span class="glyphicon glyphicon-ok"></span> 
       </button>
    </form>
</div>
<h2 style="text-align:center; color:blue">Request of Books</h2>
<h4 style="text-align:center; color:;">----------------*---------*------*--------*--------*---------*----------*--------*----------------</h4><br><br>
<?php
if(isset($_SESSION['login_user']))
 {
     $sql=" SELECT student_registration.full_name,id,books.bid,name,authors,edition,status FROM student_registration inner join issue_book ON student_registration.full_name=issue_book.full_name inner join books ON issue_book.bid=books.bid  WHERE issue_book.approve=''
    ";
    $res=mysqli_query($con,$sql);
     if(mysqli_num_rows($res)==0)
   {
     echo "<div style='margin-top:200px;  background:yellow; width:100%; height:50px; border-radius:50%; text-align:center;'><h3 style='color:red;  margin-top:100px; font-size:large; '>There is no Request for books........</h3></div>";
   }
   else
   {
    echo "<div class='scroll'>";
     echo "<table class='table table-bordered ' >";
     echo "<tr style='background-color:#6db6b9e6;'>";
     echo "<th>"; echo"Student ID"; echo"</th>";
     echo "<th>"; echo"Student Name"; echo"</th>";
     echo "<th>"; echo"Book ID"; echo"</th>";
     echo "<th>"; echo"Book Name"; echo"</th>";
     echo "<th>"; echo"Authors Name"; echo"</th>";
     echo "<th>"; echo"Edition"; echo"</th>";
     echo "<th>"; echo"Status"; echo"</th>";
     echo"</tr>";
     while($row=mysqli_fetch_assoc($res))
     {
       echo "<tr>";
       echo "<td>"; echo $row['full_name']; echo"</td>";
       echo "<td>"; echo $row['id']; echo"</td>";
       echo "<td>"; echo $row['bid']; echo"</td>";
       echo "<td>"; echo $row['name']; echo"</td>";
       echo "<td>"; echo  $row['authors']; echo"</td>";
       echo "<td>"; echo $row['edition']; echo"</td>";
       echo "<td>"; echo $row['status']; echo"</td>";
       echo "</tr>";
     }
     echo "</table>";
     echo "</div>";
   }
 }
 else{
 echo
"<h2 style='color:red; text-align:center;'>--------You need to login first-------</h2>";
 }
 if(isset($_POST['submit'])){
   $_SESSION['st_name']=$_POST['full_name'];
   $_SESSION['bid']=$_POST['bid'];
   ?>
   <script>
     window.location="approve.php";</script>
     <?php
 }
 ?>
</div>
</body>
</html>