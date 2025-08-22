<?php
include "connection.php";
include "navbar.php";
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit</title><style>
 .form-control{ width:350px;
     height:38px;}
 form{ padding-left:550px;
     color:black; }
</style></head>
<body style="background-color:#004528;"><?php
$sql="SELECT * FROM `admin` WHERE full_name='$_SESSION[login_user]';";
  $res=mysqli_query($con,$sql);
  while($row=mysqli_fetch_assoc($res)){
     $full_name=$row['full_name'];
     $password=$row['password'];
     $conform_password=$row['conform_password'];
     $email=$row['email'];
     $Phone=$row['Phone'];  }?>
<h2 style="text-align:center; color:white;">Edit Information</h2>
<div class="profile-info" style="text-align:center;"><br>
<h4 style ="color:red;"><?php echo $_SESSION['login_user']; ?></h4> </div><br><br>
<form action="" method="post" enctype="multipart/form-data">
 <input  class="form-control"  type="file"  name="upfile" >
 <label class="lebel"><h4><b>Full Name:</b></h4></label>
 <input class="form-control"  type="text" name="full_name" value="<?php echo $full_name; ?>"><br>
 <label  class="lebel"><h4><b>Password:</b></h4></label>
 <input  class="form-control" type="password" name="password" value="<?php echo $password; ?>"><br>
<label  class="lebel"><h4><b>Conform Your Password:</b></h4></label>
<input  class="form-control" type="text" name="conform_password" value="<?php echo $conform_password; ?>"><br>
<label class="lebel"><h4><b>Email:</b></h4></label>
<input  class="form-control" type="email" name="email" value="<?php echo $email; ?>"><br>
<label  class="lebel"><h4><b>Contact No:</b></h4></label>
<input  class="form-control" type="number" name="Phone" value="<?php echo $Phone; ?>"><br> 
<div style="padding-left:150px;"><button class="btn btn-default" type="submit" name="submit">Save</button></div>
</form>
<?php
if(isset($_POST['submit'])){
  move_uploaded_file($_FILES['upfile']['tmp_name'], "/Applications/XAMPP/xamppfiles/htdocs/library/Admin/images".$_FILES['upfile']['name']);
  $filename=$_FILES['upfile']['name'];
$sql1="UPDATE `admin`  SET  `image` ='$filename' ,`full_name`='$_POST[full_name]',`password`='$_POST[password]',`email`='$_POST[email]',`Phone`='$_POST[Phone]' where  full_name='$_SESSION[login_user]';";
if(mysqli_query($con,$sql1)) {
?><script>window.location="profile.php";</script>
<?php
}
} ?>
</body>
</html>