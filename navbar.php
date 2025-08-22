<!DOCTYPE html>
<html lang="en">
<head>
  <title>Nav bar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Important for responsiveness -->
  <link rel="stylesheet" href="st.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  
    <!-- Mobile toggle button -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
    </div>
<br>
    <!-- Menu items inside collapsible container -->
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">HOME</a></li>
        <li><a href="books.php">BOOKS</a></li>
        <li><a href="feedback.php">FEEDBACK</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li>
        <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> SIGN UP</a></li>
      </ul>
    </div>

  </div>
</nav>
</body>
</html>
