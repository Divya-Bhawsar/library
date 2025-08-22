<?php
include "connection.php";
include "navbar.php";

if (isset($_POST['submit'])) {
    // Insert the message into the database
    mysqli_query($con, "INSERT INTO messages(full_name, message, status, sender) VALUES ('$_SESSION[login_user]', '$_POST[message]', 'No', 'student');");

    // Redirect to avoid resubmitting the form on page refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$res = mysqli_query($con, "SELECT * FROM messages WHERE full_name='$_SESSION[login_user]';");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <style>
        body {
            background-image: url("images/message.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }

    .wrapper {
        background: rgba(0, 0, 0, 0.9);
        color: white;
        margin: 20px auto;
        max-width: 100%;
        width: 95%;
        max-width: 480px;
        padding: 10px;
        border-radius: 10px;
        box-sizing: border-box;
    }

    .form-control {
        height: 45px;
        width: 70%;
        padding: 5px 10px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        outline: none;
    }

    .msg {
        height: 500px;
        overflow-y: auto;
        padding: 10px;
        box-sizing: border-box;
    }

    .chat {
        display: flex;
        margin-bottom: 10px;
        align-items: flex-start;
    }

    .user {
        flex-direction: row-reverse;
    }

    .chatbox {
        background: #423471;
        color: white;
        padding: 10px;
        border-radius: 10px;
        max-width: 100%;
        word-wrap: break-word;
        font-size: 15px;
    }

    .user .chatbox {
        background: #821b69;
    }

    .chat img {
        border-radius: 50%;
        margin: 0 10px;
        height: 40px;
        width: 40px;
    }

    .header {
        background: #2eac8b;
        height: 70px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .send-box {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        gap: 10px;
    }

    .send-box button {
        flex: 1;
        min-width: 100px;
        height: 45px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
    }

    @media (max-width: 480px) {
        .chatbox {
            max-width: 80%;
            font-size: 20px;
        }

        .form-control {
            width: 60%;
            
        }

        .send-box {
            flex-direction: column;
            align-items: stretch;
        }

        .send-box button {
            width: 20%;
        }
    }
    </style>
</head>
<body>

<div class="wrapper">
    <div style="background: #2eac8b; height: 70px; width: 100%; text-align: center; color: white;">
        <h3 style="padding-top: 10px; margin-top: -5px;">Admin</h3>
    </div>

    <div class="msg">
        <br>
        <?php
        function formatMessageTime($datetime) {
            $time = new DateTime($datetime);
            $now = new DateTime();
            $today = $now->format('Y-m-d');
            $yesterday = $now->modify('-1 day')->format('Y-m-d');
            $messageDate = $time->format('Y-m-d');
          
            if ($messageDate == $today) {
                return $time->format('h:i A'); // e.g., 2:45 PM
            } 
            else {
                return $time->format('h:i A'); // e.g., 25 Apr 2025
            }
          }
          
        while ($row = mysqli_fetch_assoc($res)) {

            // 'created_at' या 'timer' column name
            $image = isset($_SESSION['image']) ? $_SESSION['image'] : 'default.jpg';
            if ($row['sender'] == 'student') {
        ?>
                <br>
                <div class="chat user">
                    <div class="" style="float:right;">
                   <?php echo  "<img class='img-circle profile-img' height=60 width=60 src='images/{$image}'>";?>
                    </div>
                    <div style="float:right;" class="chatbox">
                        <?php echo $row['message']; ?>
                        &nbsp;&nbsp;  <b style="font-size: 12px; color: #ccc; margin-top: 5px;"><?php echo "<td>" . formatMessageTime($row['time']) ."</td>"; ?></b>
                    </div>
                </div>
        <?php
            } else {
        ?>
                <br>
                <div class="chat Admin">
                    <div class="" style="float:left;">
                        &nbsp;<?php echo "<img class='img-circle profile_img' height=40 width=40 src='images/images.jpeg" . $_SESSION['pic'] . "'>"; ?>&nbsp;
                    </div>
                    <div style="float:left;" class="chatbox">
                        <?php echo $row['message']; ?>
                        &nbsp;&nbsp;<b style="font-size: 12px; color: #ccc; margin-top: 5px;"><?php echo "<td>" . formatMessageTime($row['time']) ."</td>"; ?></b>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>

    <div class="" style="height: 100px; ">
        <form action="" method="post">
            <input type="text" name="message" class="form-control" required="" placeholder="Write Message......" style="float:left">
            <button class="btn btn-info btn-lg" type="submit" name="submit" style="float:right">
                <span class="glyphicon glyphicon-send"></span> &nbsp; Send
            </button>
        </form>
    </div>
</div>

</body>
</html>