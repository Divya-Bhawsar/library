<?php
session_start();
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    .navbar-right img {
      border-radius: 50%;
    }
    #demo {
      color: #ff1503;
      font-size: 16px;
    }
  </style>
</head>
<body>

<?php
if (isset($_SESSION['login_user'])) {
  // Get unread messages count
  $r = mysqli_query($con, "SELECT COUNT(status) as total FROM `messages` WHERE status='No' AND sender='admin' AND full_name='$_SESSION[login_user]'");
  $c = mysqli_fetch_assoc($r);

  // Get issue book data
  $b = mysqli_query($con, "SELECT * FROM `issue_book` WHERE full_name='$_SESSION[login_user]' AND approve='yes' ORDER BY `returns` ASC LIMIT 1");
  $var1 = mysqli_num_rows($b);
  $bid = mysqli_fetch_assoc($b);

  // Get timer
  $t = mysqli_query($con, "SELECT * FROM `timer` WHERE name='$_SESSION[login_user]' AND bid='{$bid['bid']}'");
  $res = mysqli_fetch_assoc($t);
}
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>  
        <span class="icon-bar"></span>  
        <span class="icon-bar"></span>  
      </button>
      <a class="navbar-brand" href="#">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
    </div>
<br>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="../index.php">HOME</a></li>
        <li><a href="books.php">BOOKS</a></li>
        <li><a href="feedback.php">FEEDBACK</a></li>

        <?php if (isset($_SESSION['login_user'])): ?>
          <li><a href="profile.php">PROFILE</a></li>
          <li><a href="fine.php">FINE</a></li>
          <li><a href="card.php">CARD</a></li>
        <?php endif; ?>
      </ul>

      <?php if (isset($_SESSION['login_user'])): ?>
        <ul class="nav navbar-nav navbar-right">
          <?php if ($var1 == 1): ?>
            <li><a><p id="demo">Loading...</p></a></li>
            <script>
              var countDownDate = new Date("<?php echo $res['tm']; ?>").getTime();
              var x = setInterval(function () {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("demo").innerHTML =
                  days + "d " + hours + "h " + minutes + "m " + seconds + "s";

                if (distance < 0) {
                  clearInterval(x);
                  document.getElementById("demo").innerHTML = "EXPIRED";
                }
              }, 1000);
            </script>
          <?php endif; ?>

          <li>
            <a href="meesage.php">
              <span class="glyphicon glyphicon-envelope"></span>
              <span class="badge"><?php echo $c['total']; ?></span>
            </a>
          </li>

          <li>
            <a href="#">
              <img src="images/<?php echo $_SESSION['image']; ?>" height="30" width="30" alt="Profile Image">
              <?php echo $_SESSION['login_user']; ?>
            </a>
          </li>

          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>
        </ul>

        <?php
        // Fine calculation for expired books
        $day = 0;
        $exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
        $sql = "SELECT `returns` FROM `issue_book` WHERE full_name='$_SESSION[login_user]' AND approve='$exp'";
        $res = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
          $d = strtotime($row['returns']);
          $c = strtotime(date("Y-m-d"));
          $diff = abs($c - $d);
          if ($diff >= 0) {
            $day += floor($diff / 86400);
          }
        }
        $_SESSION['fine'] = $day * 0.10;
        ?>
      <?php endif; ?>
    </div>
  </div>
</nav>

</body>
</html>
