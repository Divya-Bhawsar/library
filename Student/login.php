<?php
include "connection.php";
session_start();
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Login Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
  }

  .log_img {
    min-height: 100vh;
    background-image: url("images/login_img.jpeg");
    background-size: cover;
    background-position: center;
    padding-top: 40px;
    margin-top:-30px;
  }

  section {
    margin-top:50px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .box1 {
    max-width: 500px;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    padding: 60px 50px;
    color: aliceblue;
    border-radius: 10px;
    margin: auto;
  }

  h1 {
    text-align: center;

  }

  .input-group {
    display: flex;
    align-items: center;
    background: white;
    color:black;
    border-radius: 5px;
    margin: 15px 0;
    padding: 5px 10px;
  }

  .input-group i {
    margin-right: 10px;
    color: black;
  }

  input[type="text"],
  input[type="password"] {
    border: none;
    outline: none;
    flex: 1;
    font-size: 16px;
  }

  input[type="submit"] {
    display: block;
    margin: 20px auto;
    background-color: blue;
    color: black;
    border: none;
    padding: 10px 30px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: darkblue;
  }

  label {
    font-size: 18px;
    font-weight: bold;
    color: red;
  }

  .links {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
  }

  .links a {
    color: #ccc;
    text-decoration: none;
    margin: 0 10px;
  }

  .links a:hover {
    text-decoration: underline;
  }

  @media (max-width: 500px) {
    h1 {
      font-size: 20px;
    }

    .input-group {
      padding: 5px;
    }

    input[type="submit"] {
      width: 100%;
    }
  }
</style>
</head>
<body>
  <div class="log_img">
    <section>
      <div class="box1">
        <h1>Library Management System</h1>
        <h1 style="font-size: 20px; color: yellow; font-family: cursive;">-----Student Login Form-----</h1><br>
        <form name="Login" method="post">
          <div class="input-group">
            <i class="glyphicon glyphicon-user"></i>
            <input type="text" name="full_name" placeholder="Username" required>
          </div>
          <div class="input-group">
            <i class="glyphicon glyphicon-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
          </div>
          <input type="submit" name="login" value="Login">
        </form>
        <div class="links">
          <a href="update.php">Forgot password?</a> |
          <a href="registration.php">Sign Up</a>
        </div>
      </div>
    </section>
  </div>

<?php
if(isset($_POST['login']))
{
  $res = mysqli_query($con, "SELECT * FROM `student_registration` WHERE full_name ='$_POST[full_name]' && password='$_POST[password]';");
  $row = mysqli_fetch_assoc($res);
  $count = mysqli_num_rows($res);
  if($count == 0)
  {
    echo "<script>alert(\"The username and password doesn't match\");</script>";
  }
  else
  {
    $_SESSION['login_user'] = $_POST['full_name'];
    $_SESSION['image'] = $row['image'];
    echo "<script>window.location='profile.php';</script>";
  }
}
?>
</body>
</html>
