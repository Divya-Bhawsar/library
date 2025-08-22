<?php
include "connection.php";
include "navbar.php";
include "sidenav.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device
    -width, initial-scale=1.0">
    <title>Fine calculation</title>
    <link rel="stylesheet" href="st.css">
<link rel="stylesheet" href="https://maxcdn.bootstr
apcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/lib
s/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/boots
trap/3.4.1/js/bootstrap.min.js"></script>
<style>
.table {
  font-size:18px;
 }
.table td{
  background:white;
}
.container {
    height: 750px;
    background:white;
    color:black;
    margin-top:-78px;
    width: 100%;
  }
.srch{
       padding-left:70%;
       margin-top:40px;
  }
  .scroll{
    width: 100%;
    height: 500px;
    overflow:auto;
   }
</style></head>
<body>

<div class="container">
<div class="srch">
  <form class="navbar-form" method="post" name="form1">
      <input class="form-control" type="text" name="search" placeholder="Search a Student.... " require="" >
      <button style="background-color:#6db6b9e6;" type="submit" name="submit"  class="btn btn-default">
      <span class="glyphicon glyphicon-search"></span>
      </button>
    </form>
</div>
<br><h2 style="margin-left:0px;">Fine List of Students</h2>
<hr style="border:2px solid black;">
<br>
<?php
if(isset($_POST['submit']))
{
    $q=mysqli_query($con,"SELECT `full_name`, `bid`, `returned`, `day`, `fine`, `status` FROM `fine` where  `full_name`='$_POST[search]' ;");
   
    echo "<table class='table table-bordered table-hover' >";
    echo "<tr style='background-color:black; color:white;'>";
echo "<th>"; echo"User Name"; echo"</th>";
echo "<th>"; echo"Book Id";  echo"</th>";
echo "<th>"; echo"Returened Date"; echo"</th>";
echo "<th>"; echo"Days"; echo"</th>";
echo "<th>"; echo"Fine in $"; echo"</th>";
echo "<th>"; echo"Status"; echo"</th>";
echo"</tr>";

while($row=mysqli_fetch_assoc($q))
{
  echo "<div class='scroll'>";
 echo "<tr>";
 echo "<td>"; echo  $row['full_name']; echo"</td>";
 echo "<td>"; echo $row['bid']; echo"</td>";
 echo "<td>"; echo  $row['returned']; echo"</td>";
 echo "<td>"; echo  $row['day']; echo"</td>";
 echo "<td>"; echo $row['fine']; echo"</td>";
 echo "<td>"; echo $row['status']; echo"</td>";
 echo "</tr>";
 echo "</div>";
}
echo "</table>";

}
else{
$re=mysqli_query($con,"SELECT `full_name`, `bid`, `returned`, `day`, `fine`, `status` FROM `fine` ;");
echo "<div class='scroll'>";
echo "<table class='table table-bordered' >";
echo "<tr style='background-color:black; color:white;'>";
echo "<th>"; echo"User Name"; echo"</th>";
echo "<th>"; echo"Book Id";  echo"</th>";
echo "<th>"; echo"Returened Date"; echo"</th>";
echo "<th>"; echo"Days"; echo"</th>";
echo "<th>"; echo"Fine in $"; echo"</th>";
echo "<th>"; echo"Status"; echo"</th>";
echo"</tr>";
 while($row=mysqli_fetch_assoc($re))
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
 echo "</div>";
} ?>
</div> 
</body>
</html>