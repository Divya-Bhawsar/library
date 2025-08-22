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
  <title>Books</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    .scroll {
      max-height: 530px;
      overflow-y: auto;
    }
    .search-box {
      margin-top: 15px;
    }
    @media (max-width: 767px) {
      .search-box {
        text-align: center;
        padding-left: 0;
      }
    }
  </style>
</head>
<body>
<div class="container">

  <!-- Search Forms -->
  <div class="row search-box">
    <div class="col-sm-6 col-xs-12">
      <form class="form-inline" method="post">
        <div class="form-group">
          <input class="form-control" type="text" name="search" placeholder="Search books..." required>
        </div>
        <button type="submit" name="submit" class="btn btn-info">
          <span class="glyphicon glyphicon-search"></span>
        </button><br><br>
      </form>
    </div>
  
    <div class="col-sm-6 col-xs-12">
      <form class="form-inline" method="post">
        <div class="form-group">
          <input class="form-control" type="text" name="bid" placeholder="Enter Book ID..." required>
        </div>
        <button type="submit" name="submit2" class="btn btn-info">Request</button>
      </form>
    </div>
  </div>

  <h2 class="text-center" style='margin-top: 20px;'>List Of Books</h2><br>

  <?php
  if (isset($_POST['submit'])) {
    $search = mysqli_real_escape_string($con, $_POST['search']);
    $q = mysqli_query($con, "SELECT * FROM books WHERE name LIKE '%$search%'");
    if (mysqli_num_rows($q) == 0) {
      echo "<p class='text-danger text-center'>Sorry! No book found. Try searching again.</p>";
    } else {
      echo "<div class='table-responsive'>";
      echo "<table class='table table-bordered table-hover'>";
      echo "<thead><tr style='background-color:#6db6b9e6;'>
            <th>ID</th><th>Book-Name</th><th>Authors Name</th><th>Edition</th>
            <th>Status</th><th>Quantity</th><th>Department</th></tr></thead><tbody>";
      while ($row = mysqli_fetch_assoc($q)) {
        echo "<tr>
              <td>{$row['bid']}</td><td>{$row['name']}</td><td>{$row['authors']}</td>
              <td>{$row['edition']}</td><td>{$row['status']}</td>
              <td>{$row['quantity']}</td><td>{$row['department']}</td>
              </tr>";
      }
      echo "</tbody></table></div>";
    }
  } else {
    $res = mysqli_query($con, "SELECT * FROM books;");
    echo "<div class='scroll'>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead><tr style='background-color:#6db6b9e6;'>
          <th>ID</th><th>Book-Name</th><th>Authors Name</th><th>Edition</th>
          <th>Status</th><th>Quantity</th><th>Department</th></tr></thead><tbody>";
    while ($row = mysqli_fetch_assoc($res)) {
      echo "<tr>
            <td>{$row['bid']}</td><td>{$row['name']}</td><td>{$row['authors']}</td>
            <td>{$row['edition']}</td><td>{$row['status']}</td>
            <td>{$row['quantity']}</td><td>{$row['department']}</td>
            </tr>";
    }
    echo "</tbody></table></div></div>";
  }

  if (isset($_POST['submit2'])) {
    if (isset($_SESSION['login_user'])) {
      $bid = mysqli_real_escape_string($con, $_POST['bid']);
      mysqli_query($con, "INSERT INTO issue_book (full_name, bid) VALUES ('$_SESSION[login_user]', '$bid')");
      echo "<script>alert('Book request submitted successfully.');</script>";
    } else {
      echo "<script>alert('You need to login first to request a book.');</script>";
    }
  }
  ?>
</div>
</body>
</html>
