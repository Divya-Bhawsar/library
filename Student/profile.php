<?php
session_start();
include "connection.php";
include "navbar.php";

// Redirect to edit page
if (isset($_POST['submit1'])) {
    header("Location: edit.php");
    exit();
}

// Fetch user data
$q = mysqli_query($con, "SELECT * FROM `student_registration` WHERE full_name='$_SESSION[login_user]';");
$row = mysqli_fetch_assoc($q);
$image = isset($_SESSION['image']) ? $_SESSION['image'] : 'default.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    
    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .wrapper {
            background: black;
            color: white;
            padding: 20px;
            border-radius: 10px;
            min-height: 400px;
        }
        .table-scripted {
            width: 100%;
            background: white;
            color: black;
        }
        footer {
            width: 100%;
            background-color: rgb(1, 4, 4);
            color: white;
            padding: 20px;
            margin-top: 30px;
        }
        .fa {
            margin: 0px 10px;
            padding: 3px;
            font-size: 23px;
            width: 40px;
            height: 40px;
            text-align: center;
            border-radius: 50%;
        }
        .fa-facebook { background: #3B5998; color: white; }
        .fa-twitter { background: #55ACEE; color: white; }
        .fa-google { background: #dd4b39; color: white; }
        .fa-instagram {
            background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
            color: white;
        }
        .fa-linkedin { background: #0077B5; color: white; }
    </style>
</head>
<body style="background-color:white;">

<div class="container">
    <form method="post" style="margin-top: 20px;">
        <button class="btn btn-primary pull-right" name="submit1" type="submit">Edit</button><br>
    </form>
    <div class="row" style="margin-top: 60px;">
        <div class="col-sm-4">
            <div class="wrapper text-center">
                <h2 style="font-size: 30px;">My Profile</h2>
                <img class='img-circle' height="200" width="200" src='images/<?php echo $image; ?>'>
                <h3 style="margin-top: 20px; color: purple;"><?php echo "Welcome " . $_SESSION['login_user']; ?></h3>
            </div>
        </div>

        <div class="col-sm-8">
            <h2 style="font-weight: bold;">Account Details</h2>
            <hr style="border: 2px solid black;">
            <div style="font-size: 20px;">
                <table class="table table-scripted">
                    <tr><td><b>User Name:</b></td><td><?php echo $row['full_name']; ?></td></tr>
                    <tr><td><b>Gender:</b></td><td><?php echo $row['gender']; ?></td></tr>
                    <tr><td><b>Email:</b></td><td><?php echo $row['email']; ?></td></tr>
                    <tr><td><b>Contact No:</b></td><td><?php echo $row['Phone']; ?></td></tr>
                    <tr><td><b>Password:</b></td><td>**********</td></tr>
                </table>
            </div>
        </div>
    </div>

    <footer class="text-center">
        <div>
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-linkedin"></a>
        </div>
        <h4 style="margin-top: 20px;">
            Email: Online.library@gmail.com <br><br>
            Mobile: +91-8880101****
        </h4>
    </footer>
</div>

</body>
</html>
