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
    <title>Approve Book</title>
    <link rel="stylesheet" href="st.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.srch
{
  width:59%;
  text-align:center;
   margin-left:200px;
}
body 
{
  background-image: url("images/request.jpeg");
  width:100%;
  position: fixed;
}
.container
{
  height: 800px;
  background:black;
  opacity: .8;
  color:white;
  margin-top:-79px;
  width: 75%;
}
</style>
</head>
<body>
<div class="container">
<!------------Approve Request Start------------->
<div class="srch">
    <br><h3 style="text-align:center;">Approve Request</h3><br><br>
    <form name="form1" action ="" method="post">
        <input  class="form-control" type="text" name="approve" placeholder="Approve or not" required=""><br>
        <input  class="form-control" type="text" name="issue" placeholder="Issue Date yyyy-mm-dd" required=""><br>
        <input  class="form-control" type="text" name="returns" placeholder="Return Date yyyy-mm-dd" required=""><br>
        <input type="text" name="tm" class="form-control" placeholder="Return Date Nov 30,2023 15:00:00" required=""><br><br>
        <button class="btns btn-default" type="submit" name="submit" style=" background:green; color:black;  border:2px solid green; font-size:18px;">Approve</button>
    </form>
</div>
<?php
if(isset($_POST['submit']))
{
   mysqli_query($con,"INSERT INTO `timer` VALUES('$_SESSION[st_name]','$_SESSION[bid]','$_POST[tm]');");
   mysqli_query($con,"UPDATE `issue_book` SET `approve`='$_POST[approve]',`issue`='$_POST[issue]',`returns`='$_POST[returns]'  where full_name='$_SESSION[st_name]' and bid='$_SESSION[bid]';");
   mysqli_query($con,"UPDATE books SET quantity=quantity-1  where bid='$_SESSION[bid]';");
   $res=mysqli_query($con,"SELECT quantity FROM books where bid='$_SESSION[bid]';");
   while($row=mysqli_fetch_assoc($res))
    {
      if($row['quantity']==0)
      {
        mysqli_query($con,"UPDATE  books SET status='Not-available' where bid='$_SESSION[bid]';");
      }
    }
    ?>
    <script>
        alert("Updated Succesfully.");
        window.location="request.php";
    </script>
    <?php
}
?>
<!--------Approve Request End---------------->
</div>
</body>
</html>