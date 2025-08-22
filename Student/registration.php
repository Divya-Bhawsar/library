<?php
include "connection.php";
include "navbar.php";

if (isset($_POST['submit'])) {
  $full_name = $_POST["full_name"];
  $password = $_POST["password"];
  $conform_password = $_POST["conform_password"];
  $gender = $_POST["gender"];
  $email = $_POST["email"];
  $Phone = $_POST["Phone"];

  $count = 0;
  $res = mysqli_query($con, "SELECT `full_name` FROM `student_registration`;");
  while ($row = mysqli_fetch_assoc($res)) {
    if ($row['full_name'] == $full_name) {
      $count++;
    }
  }

  if ($count == 0) {
    $query = "INSERT INTO `student_registration` (`full_name`, `password`, `conform_password`, `gender`, `email`, `Phone`, `image`, `card`) 
              VALUES ('$full_name', '$password', '$conform_password', '$gender', '$email', '$Phone', 'p.jpg', 101)";
    if (mysqli_query($con, $query)) {
      echo "<script>window.location='login.php';</script>";
    }
  } else {
    echo "<script>alert('User already exists');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>    
  <meta charset="UTF-8">    
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <title>Student Registration</title>    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    body, html {
      height: 100%;
      margin: 0;
    }
    .res_img {
      margin-top:-20px;
      background-image: url("images/res.jpg");
      background-size: cover;
      background-position: center;
      height: 90%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .box {
      background: rgba(0, 0, 0, 0.75);
      padding: 60px;
      border-radius: 10px;
      width: 100%;
      max-width: 800px;
      color: white;
    }
    .box h1 {
      text-align: center;
      color: #fff;
    }
    .form-control {
      margin-bottom: 15px;
    }
    .gender-group {
      margin-left: 5px;
      color: #fff;
    }
    .gender-group label {
      margin-right: 20px;
      font-size: 16px;
    }
    @media (max-width: 576px) {
      .box h1 {
        font-size: 20px;
      }
      .box h3
      {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>    
  <section class="res_img">
    <div class="box">
      <h1>Library Management System</h1>
      <h3 style="color: #00ccff; text-align:center;">Student Registration Form</h3><br>
      <form method="post">
        <input class="form-control" type="text" name="full_name" placeholder="Full Name" required>

        <div class="gender-group">
          <strong style="color:yellow;">Gender:</strong>
          <label><input type="radio" name="gender" value="Male" required> Male</label>
          <label><input type="radio" name="gender" value="Female"> Female</label>
        </div>
<br>
        <input class="form-control" type="password" name="password" placeholder="Password" required><br>
        <input class="form-control" type="text" name="conform_password" placeholder="Confirm Password" required><br>
        <input class="form-control" type="email" name="email" placeholder="Email" required><br>
        <input class="form-control" type="number" name="Phone" placeholder="Phone Number" required><br>
<br>
        <button class="btn btn-success btn-block" type="submit" name="submit">Sign Up</button>
      </form>
    </div>
  </section>

</body>
</html>
