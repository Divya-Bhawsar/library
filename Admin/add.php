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
    <title>Add Books</title>
    <link rel="stylesheet" href="st.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.srch
{
  padding-left:1000px;
}
 body 
{
  background:#024629;
  text-decoration:none;
}
.book
{
  width:400px;
   margin:0px auto;
}
.form-control
{
  background:black;
  color:white;
}
 </style>
</head>
<body>
<div class="container" style="text-align:center;" >
  <h2 style ="color:white; font-family: Lucida Console; text-align:center;">Add New Books</h2><br>
<form class="book" action="" method="post">
<input type="text"  name="bid" class="form-control" placeholder="Book id" required=""><br>       
    <input type="text"  name="name"  class="form-control" placeholder="Book Name" required=""><br>
    <input type="text"  name="authors"  class="form-control" placeholder="Authors Name" required=""><br>
    <input type="text"  name="edition"  class="form-control" placeholder="Edition" required=""><br>
    <input type="text"  name="status"  class="form-control" placeholder="Status" required=""><br>
    <input type="text"  name="quantity"  class="form-control" placeholder="Quantity" required=""><br>
    <input type="text"  name="department"  class="form-control" placeholder="Department Name" required=""><br>
    <button style="text-align:center;" class="btn btn-default" type="submit" name="submit">ADD</button>
  </form>
</div>
<?php
 if(isset($_POST['submit']))
  {
    if(isset($_SESSION['login_user'])){
      mysqli_query($con,"INSERT INTO books VALUES('$_POST[bid]','$_POST[name]','$_POST[authors]',
      '$_POST[edition]','$_POST[status]','$_POST[quantity]','$_POST[department]');"); ?>
      <script>
          alert("Books Added Succesfully.");
      </script>
      <?php
    }
    else
    {
      ?><script>alert("You need to login first.");
      </script>
      <?php
    }
  }
 ?>
</body>
</html>