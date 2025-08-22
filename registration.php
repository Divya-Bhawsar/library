<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>    
  <meta charset="UTF-8">    
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <title>Registration Page Option</title>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">        
  <style>
    body, html {
      height: 100%;
      margin: 0;
    }
    section {
      margin-top:-20px;
      background-image: url("images/sign.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      height: 70%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .box {
      margin-top:-50px;
      background: rgba(0, 0, 0, 0.8);
      color: white;
      padding: 60px;
      border-radius: 10px;
      max-width: 550px;
      width: 100%;
      text-align: center;
    }
    label {
      padding:40px;
      font-size: 25px;
      font-weight: 600;
      color: red;
    }
    .radio-group {
      margin: 20px 0;
    }
    @media (max-width: 590px) {
      label {
        font-size: 20px;
        padding:10px;
      }
    }
  </style>
</head>
<body>    
  <section>
    <div class="box">            
      <form name="sign_up" method="post" action="">
        <p style="font-size: 24px; font-weight: 700;">Sign Up as:</p>
        <div class="radio-group">
          <label>
            <input type="radio" name="user" value="admin"> Admin
          </label>
          &nbsp;&nbsp;
          <label>
            <input type="radio" name="user" value="student" checked> Student
          </label>
        </div>
        <button class="btn btn-info" type="submit" name="submit1" style="width:80px;">OK</button>
      </form> 
    </div>
  </section>
  <?php include "footer.php"; ?>
<?php
if (isset($_POST['submit1'])) {
  if ($_POST['user'] == 'admin') {
    echo "<script>window.location='Admin/registration.php';</script>";
  } else {
    echo "<script>window.location='Student/registration.php';</script>";
  }
}
?>
</body>
</html>
