<?php
include "connection.php";
include "navbar.php";
include "sidenav.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Books</title>
<link rel="stylesheet" href="st.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
  body{
background:fixed;
  }
  .srch{
       padding-left:70%;
       margin-top:40px;
    }
  .container{
    height: 850px;
    background:white;
    color:black;
    margin-top:-78px;
    width: 100%;
  }
  .table-bordered{
      color:black;
      font-size:18px;
    }
   .scroll{
    width: 100%;
    height: 520px;
    overflow:auto;
   }
  </style></head>
<body>
<div class="container">
  <div class="srch">
<form class="navbar-form" method="post" name="form1">
<input class="form-control" type="text" name="search" placeholder="Search books.... " require="" >
<button style="background-color:#6db6b9e6;" type="submit" name="submit"  class="btn btn-default">
<span class="glyphicon glyphicon-search"></span></button>
</form>
<form class="navbar-form" method="post" name="form1"> 
<input class="form-control" type="text" name="bid" placeholder="Enter Book ID.... " require="" >
<button style="background-color:#6db6b9e6;" type="submit" name="submit1"  class="btn btn-default">Delete</button>
</form></div>    
<h2  style="font-family:'Times New Roman', Times, serif;">List Of Books</h2><br> 
<?php    
if(isset($_POST['submit']))    {    
 $q=mysqli_query($con,"SELECT * FROM `books` where name = '$_POST[search]' ;");
 if(mysqli_num_rows($q)==0){
      echo "Sorry! NO Book Found. Try searching again.";
  }
else{
echo "<table class='table table-bordered table-hover' >";
echo "<tr style='background-color:#6db6b9e6; font-size:20px;color:black;'>";
echo "<th>"; echo"ID"; echo"</th>";
echo "<th>"; echo"Book-Name"; echo"</th>";
echo "<th>"; echo"Authors Name"; echo"</th>";   
echo "<th>"; echo"Edition"; echo"</th>";
echo "<th>"; echo"Status"; echo"</th>";
echo "<th>"; echo"Quantity"; echo"</th>";
echo "<th>"; echo"Department"; echo"</th>";
echo"</tr>";  
while($row=mysqli_fetch_assoc($q))   
{
echo "<tr>"; 
echo "<td>"; echo $row['bid']; echo"</td>"; 
echo "<td>"; echo  $row['name']; echo"</td>";  
echo "<td>"; echo  $row['authors']; echo"</td>";  
echo "<td>"; echo  $row['edition']; echo"</td>";  
echo "<td>"; echo $row['status']; echo"</td>";
echo "<td>"; echo  $row['quantity']; echo"</td>";     
echo "<td>"; echo $row['department']; echo"</td>";    
echo "</tr>";    
 }
    echo "</table>";
    }
}
else
{
$res=mysqli_query($con,"SELECT * FROM `books`;");
echo "<div class='scroll'>";
echo "<table class='table table-bordered table-hover' >";
echo "<tr style='background-color:#6db6b9e6; font-size:20px;color:black;'>"; 
echo "<th>"; echo"ID"; echo"</th>";
echo "<th>"; echo"Book-Name"; echo"</th>";
echo "<th>"; echo"Authors Name"; echo"</th>";
echo "<th>"; echo"Edition"; echo"</th>";
echo "<th>"; echo"Status"; echo"</th>";
echo "<th>"; echo"Quantity"; echo"</th>";
echo "<th>"; echo"Department"; echo"</th>";
echo"</tr>";
    while($row=mysqli_fetch_assoc($res))
       {
         echo "<tr>";
         echo "<td>"; echo $row['bid']; echo"</td>";
         echo "<td>"; echo  $row['name']; echo"</td>";
         echo "<td>"; echo  $row['authors']; echo"</td>";
         echo "<td>"; echo  $row['edition']; echo"</td>";
         echo "<td>"; echo $row['status']; echo"</td>";
         echo "<td>"; echo  $row['quantity']; echo"</td>";
         echo "<td>"; echo $row['department']; echo"</td>";
         echo "</tr>";
     }
    echo "</table>";    
    echo "</div>";
}
if(isset($_POST['submit1']))
{
  if(isset($_SESSION['login_user'])){
        mysqli_query($con,"DELETE FROM `books` where bid='$_POST[bid]';");   
        ?><script>alert("Delete Successsful.");</script>
       <?php }
    else {
       ?><script>alert("Please Login first.");</script>
       <?php }
}
?>
</div>
</body>
</html>