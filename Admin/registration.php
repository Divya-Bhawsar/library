<?php
include "connection.php";
include "navbar.php";
if(isset($_POST['submit']))
{
  $full_name =$_POST["full_name"];
  $password=$_POST["password"];
  $conform_password=$_POST["conform_password"];
  $gender=$_POST["gender"];
  $email=$_POST["email"];
  $Phone=$_POST["Phone"];
  $count=0;
  $sql="SELECT full_name from admin;";
  $res=mysqli_query($con,$sql);
  while($row=mysqli_fetch_assoc($res))
  {
     if($row['full_name']==$_POST['full_name'])
    {
        $count=$count+1;
    }
  }
 if($count==0)
 {
  $query="INSERT INTO `admin` (full_name, password, conform_password, gender, email, Phone,image,status)  VALUES ('$full_name','$password','$conform_password','$gender','$email','$Phone','p.jpg','')";
     if(mysqli_query($con,$query))
    {
      ?>
     <script>window.location="admin_login.php";</script>;
     <?php
    }
  }
 else
 {
    echo "error:" .mysqli_error($con);
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>    
   <meta charset="UTF-8">    
   <meta name="viewport" content="width=device-width, initial-scale=1.0">    
   <title>Admin_Registration Page</title>    
   <link rel="stylesheet" href="st.css">
<style>
    .res_img
   {
    height: 800px;
    margin-top: 0px;
    background-image: url("images/res.jpg");
   }
    section
    {
        margin-top:-20px;
    }
    .box{
       height: 750px;
       width: 800px;
       margin-top:-17px;
       opacity: .8;
       background:black;
       margin-left:340px;
       text-align:center;
    }
    .form-control {
      height: 35px;
      width: 600px;
      margin-left:90px;
      padding:10px; 
    }
    .login {
      text-align:center;
    }
</style>
</head>
<body>    
<section>        
<div class="res_img"><br>         
  <div class="box"><br>         
    <h1 style="font-size: 35px; color: aliceblue;"> Library Management System</h1><br><br>         
    <h1 style="font-size: 25px; color:blue;">User Registration Form</h1><br>          
    <form name="registration" action="" method="post">              <br><br>            
      <div class="login">               
         <input class="form-control" type="text" name="full_name" placeholder="Full Name" required=""><br><br>
         <h4  style="margin-right:390px; color:white;"><b style="color:yellow;">Gender :</b><label class="radio-inline"><input  type="radio" name="gender" value="Male" required="">Male</label>
         <label class="radio-inline"><input  type="radio" name="gender" value="Female">Female</label> </h4><br><br>
         <input class="form-control" type="password" name="password" placeholder="Password" required=""><br><br>            
         <input class="form-control" type="text" name="conform_password" placeholder="Conform Your password"  required=""><br><br>            
         <input class="form-control" type="email" name="email" placeholder="Email" required=""><br><br>             
         <input class="form-control" type="number" name="Phone" placeholder="Phone No." required=""><br><br><br>       
         <button class="btn btn-default" type="submit" name="submit" style="color:white; background-color: green; font-size:15px;  text-align:center;">Sign Up</button>          
       </div>                       
     </form>               
  </div>       
</div>
</section>
</body>
 </html>