<?php
include "connection.php";
include "navbar.php";
include "sidenav.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approve Page</title>
    <link rel="stylesheet" href="st.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .containar {
            height: 700px;
            padding: 10px;
            color: black;
            border-radius: 2%;
            margin-left: 0px;
            width: 100%;
        }

        .table-bordered {
            font-size: 18px;
            color: black;
        }
    </style>
</head>
<body>
  <br>
  <br>
<div class="containar">
  <h2>Approve User To Work ...</h2>
  <hr style="border:2px solid black;">
    <br>

    <?php
    // Fetch users that are pending approval (status is empty)
    $res = mysqli_query($con, "SELECT `id`, `full_name`, `gender`, `email`, `Phone`, `status` FROM `admin` WHERE `status` = ''");
    if ($res && mysqli_num_rows($res) > 0) {
        echo "<table class='table table-bordered'>";
        echo "<tr style='background-color:aqua;'>";
        echo "<th>User Name</th>";
        echo "<th>Gender</th>";
        echo "<th>Email</th>";
        echo "<th>Contact NO</th>";
        echo "<th>Action</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($res)) {
            // Display user data
            echo "<tr>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['Phone'] . "</td>";
            echo "<td>
                    <form action='' method='post'>
                        <input type='hidden' name='user_id' value='" . $row['id'] . "' />
                        <button type='submit' name='submit1' style='background-color:red; color:white; font-weight:700; font-size:18px;' class='btn btn-default'>
                            <span class='glyphicon glyphicon-remove-sign'></span>&nbsp; Remove
                        </button>
                        <button type='submit' name='submit2' style='background-color:green; color:white; font-weight:700; font-size:18px;' class='btn btn-default'>
                            <span class='glyphicon glyphicon-ok-sign'></span>Approve
                        </button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No users pending approval</p>";
    }

    // Handle approval action
    if (isset($_POST['submit2'])) {
        $user_id = $_POST['user_id'];
        $update_query = "UPDATE `admin` SET `status` = 'yes' WHERE `id` = ?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
        
        } else {
            echo "<script>alert('Error approving user.');</script>";
        }
        $stmt->close();
    }

    // Handle remove action
    if (isset($_POST['submit1'])) {
        $user_id = $_POST['user_id'];
        $delete_query = "DELETE FROM `admin` WHERE `id` = ?";
        $stmt = $con->prepare($delete_query);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
          //  echo "<script>alert('User removed successfully!');</script>";
          
        } else {
            echo "<script>alert('Error removing user.');</script>";
        }
       
        
    }
    ?>
</div>
</body>
</html>
