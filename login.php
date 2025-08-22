<?php
session_start();
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>    
  <meta charset="UTF-8">    
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <title>Login Page Option</title>    
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    section {
      background-image: url("images/lg.jpg");
      background-repeat: no-repeat;
    
      margin-top:-20px;
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .box2 {
      background-color: rgba(0, 0, 0, 0.85);
     border-radius:100%;
      min-height: 40vh;
      padding: 80px;
      max-width: 100%;
      width: 550px;
      text-align: center;
      color: white;
    }

    .box2 p {
      font-size: 30px;
      font-weight: bold;
     
      color: white;
      margin-bottom: 30px;
    }

    label {
      font-size: 25px;
      font-weight: 600;
      color: red;
      margin-left: 10px;
    }

    .radio-group {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 30px;
      margin-bottom: 20px;
  
    }

    button {
      height: 35px;
      width: 80px;
      font-weight: bold;
      background-color: green;
      border: none;
      cursor: pointer;
      color:white;
    }

    button:hover {
      background-color: lightgray;
    }

    @media (max-width: 500px) {
      .box2 {
        padding: 20px;
        min-height: 10vh;

      }

      .box2 p {
        font-size: 20px;
      }

      label {
        font-size: 16px;
      }

      button {
        width: 70px;
        height: 30px;
      }
    }
  </style>
</head>
<body>   
  <section>
    <div class="box2">            
      <form method="post" action="">
        <p>Login For:</p>
        <div class="radio-group">
          <input type="radio" name="user" id="admin" value="admin">
          <label for="admin">Admin</label>

          <input type="radio" name="user" id="student" value="student" checked>
          <label for="student">Student</label>
        </div>
        <button type="submit" name="submit1">OK</button>
      </form>       
    </div>
  </section>
  <?php include "footer.php"; ?>
  <?php
  if (isset($_POST['submit1'])) {
    if ($_POST['user'] == 'admin') {
      echo "<script>window.location='Admin/admin_login.php';</script>";
    } else {
      echo "<script>window.location='Student/login.php';</script>";
    }
  }
  ?>
</body>
</html>
