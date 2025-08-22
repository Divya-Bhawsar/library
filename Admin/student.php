<?php
include "connection.php";
include "navbar.php";
include "sidenav.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Student Information</title>
    <link rel="stylesheet" href="st.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>  

.srch{
  padding-left:70%;
  margin-top:40px;
 }
.containar{
  height: 700px;
  padding:10px;
  color:black;
  border-radius:2%;
  margin-left:0px;
  margin-top:-60px;
  width: 100%;
}
.table-bordered{
  font-size:18px;
  color:black;
}
.scroll{
    width: 100%;
    height: 530px;
    overflow:auto;
}
</style>
</head>
<body>
<div class="containar">
<div class="srch">
<form class="navbar-form"method="post" name="form1">
<input class="form-control" type="text" name="search" placeholder="Search a Student.... " require="" >
<button style="background-color:#6db6b9e6;" type="submit" name="submit"  class="btn btn-default">
<span class="glyphicon glyphicon-search"></span>
   </button> </form> </div>
<h2 style=" color:black; font-family:Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif';">List Of Students..........</h2>
<hr style="border:2px solid black;"><br>
<?php
if(isset($_POST['submit']))
{
   $q=mysqli_query($con," SELECT `id`, `full_name`, `gender`, `email`, `Phone` FROM `student_registration` where full_name='$_POST[search]';");
   if(mysqli_num_rows($q)==0){ ?>
    <script>alert("The Name and Password Not match");</script><?php
   }
   else{
     echo "<div class='scroll'>";
     echo "<table class='table table-striped' >";
     echo "<tr style='background-color:yellow;'>";
     echo "<th>"; echo"Id"; echo"</th>";
     echo "<th>"; echo"User Name"; echo"</th>";
     echo "<th>"; echo"Gender"; echo"</th>";
     echo "<th>"; echo"Emali"; echo"</th>";
     echo "<th>"; echo"Contact NO"; echo"</th>";
     echo"</tr>";
     while($row=mysqli_fetch_assoc($q)){
      echo "<tr>";
      echo "<td>"; echo $row['id']; echo"</td>";
      echo "<td>"; echo  $row['full_name']; echo"</td>";
      echo "<td>"; echo  $row['gender']; echo"</td>";
      echo "<td>"; echo  $row['email']; echo"</td>";
      echo "<td>"; echo $row['Phone']; echo"</td>";
      echo "</tr>";
    }
   echo "</table>";  echo "</div>";
  }
}
else{          
  echo "<div class='scroll'>";
  $res=mysqli_query($con,"SELECT `id`, `full_name`, `gender`, `email`, `Phone` FROM `student_registration`;");
  echo "<table class='table table-bordered' >";
  echo "<tr style='background-color:yellow;'>";
  echo "<th>"; echo"Id"; echo"</th>";
  echo "<th>"; echo"User Name"; echo"</th>";
  echo "<th>"; echo"Gender"; echo"</th>";
  echo "<th>"; echo"Emali"; echo"</th>";
  echo "<th>"; echo"Contact NO"; echo"</th>";
  echo"</tr>";
  while($row=mysqli_fetch_assoc($res)){
    echo "<tr>";
    echo "<td>"; echo $row['id']; echo"</td>";
    echo "<td>"; echo  $row['full_name']; echo"</td>";
    echo "<td>"; echo  $row['gender']; echo"</td>";
    echo "<td>"; echo  $row['email']; echo"</td>";
    echo "<td>"; echo $row['Phone']; echo"</td>";
    echo "</tr>";          
  }
 echo "</table>";  echo "</div>";
}
?>
</div> 
</body>
</html>