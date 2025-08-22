<?php
include "connection.php";
include "navbar.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style> 
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
      margin-left:20px; 
    }
    .h:hover
    {
color:white;
width:300px;
height:50px;
background-color:#00544c;
    }
    .srch
    {
       padding-left:70%;
       margin-top:40px;
    }
    .container
    {
      height: 750px;
      background:white;
      color:white;
      margin-top:-78px;
      width: 100%;
      
    }
    .table-bordered
    {
      color:black;
    }
    .scroll{
      width: 100%;
    height: 500px;
    overflow:auto;
    }
</style>
</head>
<body>
  <!---------------------------------Side-Nav start--------------------------------------->
<div id="mySidenav" class="sidenav">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
     <div style="color:yellow; font-size:18px; margin-left:50px; font-size:25px; padding:10px;">
        <?php
         if(isset($_SESSION['login_user']))
        { echo "<img class='img-circle profile_img'  height=150  width=150 src='images/".$_SESSION['image']."'>";
         echo " <br><br>";
         echo "Welcome    ".$_SESSION['login_user'];
         } ?>
       </div>
       <br><br>
     <div  class="h"> <a href="books.php"> Books</a></div>
     <div  class="h"> <a href="request.php">Book Requests</a></div>
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
<div class="container">
  <div class="srch">
    <!-- Search by Book Name -->
    <form class="navbar-form" method="post" name="form1">
       <input class="form-control" type="text" name="search" placeholder="Search books.... " required="" >
        <button style="background-color:#6db6b9e6;" type="submit" name="submit"  class="btn btn-default">
           <span class="glyphicon glyphicon-search"></span>
        </button>
    </form>
    
    <!-- Search by Department -->
    <form class="navbar-form" method="post" name="form2">
       <select class="form-control" name="department_search" required="">
           <option value="EEE">Select Department</option>
           <option value="CS">Computer Science</option>
           <option value="EEE">Electronics</option>
           <option value="MD">Mechanical</option>
           <option value="CSD">Civil</option>
           <!-- Add more departments as needed -->
       </select>
       <button style="background-color:#6db6b9e6;" type="submit" name="submit_department"  class="btn btn-default">
          Search by Department
       </button>
    </form>
    
    <!-- Request Book by ID -->
    <form class="navbar-form" method="post" name="form1">
       <input class="form-control" type="text" name="bid" placeholder="Enter Book ID.... " required="" >
       <button style="background-color:#6db6b9e6;" type="submit" name="submit2"  class="btn btn-default">Request</button>
    </form>
  </div>

  <h1 style='font-family: "Lato", sans-serif; color:black; font-size:30px;'>List Of Books</h1><br>

  <?php
      // Search by Book Name
      if (isset($_POST['submit'])) {
        $q = mysqli_query($con, "SELECT * FROM `books` WHERE name = '$_POST[search]';");
        if (mysqli_num_rows($q) == 0) {
          echo "Sorry! No Book Found. Try searching again.";
        } else {
           echo "<table class='table table-bordered'>";
           echo "<tr style='background-color:#6db6b9e6;'>";
           echo "<th>ID</th>";
           echo "<th>Book-Name</th>";
           echo "<th>Authors Name</th>";
           echo "<th>Edition</th>";
           echo "<th>Status</th>";
           echo "<th>Quantity</th>";
           echo "<th>Department</th>";
           echo "</tr>";
           while ($row = mysqli_fetch_assoc($q)) {
               echo "<tr>";
               echo "<td>" . $row['bid'] . "</td>";
               echo "<td>" . $row['name'] . "</td>";
               echo "<td>" . $row['authors'] . "</td>";
               echo "<td>" . $row['edition'] . "</td>";
               echo "<td>" . $row['status'] . "</td>";
               echo "<td>" . $row['quantity'] . "</td>";
               echo "<td>" . $row['department'] . "</td>";
               echo "</tr>";
           }
           echo "</table>";
        }
      }
      // Search by Department
      else if (isset($_POST['submit_department'])) {
        $department = $_POST['department_search'];
        $q = mysqli_query($con, "SELECT * FROM `books` WHERE `department` = '$department';");
        if (mysqli_num_rows($q) == 0) {
          echo "No books found in this department.";
        } else {
           echo "<table class='table table-bordered'>";
           echo "<tr style='background-color:#6db6b9e6;'>";
           echo "<th>ID</th>";
           echo "<th>Book-Name</th>";
           echo "<th>Authors Name</th>";
           echo "<th>Edition</th>";
           echo "<th>Status</th>";
           echo "<th>Quantity</th>";
           echo "<th>Department</th>";
           echo "</tr>";
           while ($row = mysqli_fetch_assoc($q)) {
               echo "<tr>";
               echo "<td>" . $row['bid'] . "</td>";
               echo "<td>" . $row['name'] . "</td>";
               echo "<td>" . $row['authors'] . "</td>";
               echo "<td>" . $row['edition'] . "</td>";
               echo "<td>" . $row['status'] . "</td>";
               echo "<td>" . $row['quantity'] . "</td>";
               echo "<td>" . $row['department'] . "</td>";
               echo "</tr>";
           }
           echo "</table>";
        }
      }
      // Show All Books by Default
      else {
            echo "<div class='scroll'>";
            $res = mysqli_query($con, "SELECT * FROM `books`;");
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color:#6db6b9e6;'>";
            echo "<th>ID</th>";
            echo "<th>Book-Name</th>";
            echo "<th>Authors Name</th>";
            echo "<th>Edition</th>";
            echo "<th>Status</th>";
            echo "<th>Quantity</th>";
            echo "<th>Department</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td>" . $row['bid'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['authors'] . "</td>";
                echo "<td>" . $row['edition'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['department'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
      }

      // Handle Book Request
      if (isset($_POST['submit2'])) {
        if (isset($_SESSION['login_user'])) {
            mysqli_query($con, "INSERT INTO `issue_book` VALUES ('$_SESSION[login_user]', '$_POST[bid]', ' ', ' ', ' ');");
          ?>
          <script>
            window.location="request.php";
          </script>
          <?php
        } else {
          ?>
            <script>
              alert("You need to login first to request book.");
            </script>
          <?php
        }
      }
  ?>
</div>

</div>
</body>
</html>