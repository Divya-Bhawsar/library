<?php
   session_start();
   session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Library Management System</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    .wrapper {
      width: 100%;
      margin: 0 auto;
    }

    header {
      background-color: rgb(5, 9, 9);
      padding: 10px 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
    }

    .logo img {
      height: 80px;
      width: auto;
      margin-right: 10px;
    }

    .logo h1 {
      color: aliceblue;
      font-size: 22px;
    }

    nav {
      margin-top: 10px;
    }

    nav ul {
      list-style: none;
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    nav li {
      display: inline;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-size: 16px;
    }

    .sec_img {
      background-image: url("images/lib .jpg"); /* ✅ Make sure file path is correct */
      background-size: cover;
      background-position: center;
      min-height: 80vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .box {
      width: 100%;
      max-width: 500px;
      min-height: 30vh;
      background-color: rgba(0, 0, 0, 0.8);
      color: aliceblue;
      text-align: center;
      padding: 90px 20px;
      border-radius: 10px;
    }

    .box h1 {
      margin: 15px 0;
    }

    /* ✅ Responsive */
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: flex-start;
      }

      .logo {
        flex-direction: column;
        align-items: flex-start;
      }

      .logo h1 {
        font-size: 18px;
        margin-top: 10px;
      }

      nav ul {
        flex-direction: column;
        gap: 10px;
        padding-left: 0;
      }

      nav a {
        font-size: 14px;
      }

      .box h1 {
        font-size: 10px;
      }
      .box
      {
        min-height: 10vh;
      }
      .sec_img {
        padding: 40px 10px;
      }
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <header>
      <div class="logo">
        <img src="images/books.jpg" alt="Library Logo">
        <h1>ONLINE LIBRARY MANAGEMENT SYSTEM</h1>
      </div>
      <nav>
        <ul>
          <li><a href="index.php">HOME</a></li>
          <li><a href="books.php">BOOKS</a></li>
          <li><a href="login.php">LOGIN</a></li>
          <li><a href="feedback.php">FEEDBACK</a></li>
        </ul>
      </nav>
    </header>

    <section>
      <div class="sec_img">
        <div class="box">
          <h1 style="color: green; font-size:40px;"><b>Welcome to Library</b></h1>
          <h1 style="font-family: cursive;font-size:30px;">Opens at: 09:00 AM</h1>
          <h1 style="font-family: cursive;font-size:30px;">Closes at: 06:00 PM</h1>
        </div>
      </div>
    </section>

    <?php include "footer.php"; ?>
  </div>
</body>
</html>
