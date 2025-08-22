<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
include "connection.php";
include "navbar.php";

// Check if user is logged in
$isLoggedIn = isset($_SESSION['login_user']);
$user = $isLoggedIn ? $_SESSION['login_user'] : ''; // Only set if logged in

// Handle like/dislike action
if (isset($_POST['like']) || isset($_POST['dislike'])) {
    $id = $_POST['comment_id'];
    $user = $isLoggedIn ? $_SESSION['login_user'] : 'guest';  // If logged in, use their session, otherwise use 'guest'
    $action = isset($_POST['like']) ? 'like' : 'dislike';

    // Check if user already voted
    $check = mysqli_query($con, "SELECT * FROM comment_votes WHERE user='$user' AND comment_id=$id");

    if (mysqli_num_rows($check) == 0) {
        // Insert into votes table
        mysqli_query($con, "INSERT INTO comment_votes (user, comment_id, action) VALUES ('$user', $id, '$action')");

        // Update like or dislike count
        if ($action == 'like') {
            mysqli_query($con, "UPDATE comments SET like_count = like_count + 1 WHERE id = $id");
        } else {
            mysqli_query($con, "UPDATE comments SET dislike_count = dislike_count + 1 WHERE id = $id");
        }
    }
}

// Handle new comment (only for logged-in users)
if ($isLoggedIn && isset($_POST['submit'])) {
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    $com = $_POST['com'];
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT INTO comments (`full-name`, com, reply_to, like_count, dislike_count, timer) 
            VALUES ('$user', '$com', NULL, 0, 0, '$now')";
    if (mysqli_query($con, $sql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Handle reply
if (isset($_POST['reply_submit'])) {
    $reply = $_POST['reply'];
    $reply_to = $_POST['reply_to'];
    $now = date("Y-m-d H:i:s");
    mysqli_query($con, "INSERT INTO comments (`full-name`, com, reply_to, like_count, dislike_count, timer) 
                        VALUES ('$user', '$reply', '$reply_to', 0, 0, '$now')");
}

// Time ago function
function time_elapsed_string($datetime) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y'=>'year','m'=>'month','w'=>'week','d'=>'day','h'=>'hour','i'=>'minute','s'=>'second');
    foreach ($string as $k=>&$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else unset($string[$k]);
    }
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comment System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <script src="assets/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .comment { width: 900px; margin: auto; background: #f0f0f0; padding: 20px; border-radius: 10px; }
        .reply { margin-left: 50px; background: #e8e8e8; padding: 10px; border-radius: 5px; }
        .btn-vote.clicked { color: white !important; background: blue; }
        .like-btn, .dislike-btn {
            border: none;
            background-color: transparent;
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
        }

        .like-btn.active {
            background-color: #4CAF50;
            color: white;
        }

        .dislike-btn.active {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>

<div class="comment">
    <h3>Leave a comment:</h3>
    <?php if ($isLoggedIn) { ?>
        <form method="post">
            <textarea name="com" style="width:100%; height:60px;"></textarea><br>
            <button type="submit" name="submit" class="btn btn-success">Comment</button>
        </form>
    <?php } else { ?>
        <p>You must be logged in to leave a comment. <a href="login.php">Login here</a></p>
    <?php } ?>
    <hr>
    <?php
    // Fetch and display comments
    $res = mysqli_query($con, "SELECT * FROM comments WHERE reply_to IS NULL ORDER BY timer DESC");
    while ($row = mysqli_fetch_assoc($res)) {
        $cid = $row['id'];
        $liked = false;
        $disliked = false;
        $vote_res = mysqli_query($con, "SELECT action FROM comment_votes WHERE user='$user' AND comment_id=$cid");
        $voted = mysqli_fetch_assoc($vote_res);
        if ($voted) {
            $liked = $voted['action'] === 'like';
            $disliked = $voted['action'] === 'dislike';
        }
        echo "<div style='padding:10px; background:#fff; margin-bottom:10px; border-radius:5px'>";
        echo "<b>".$row['full-name']."</b> - <small>".time_elapsed_string($row['timer'])."</small><br>";
        echo "<p>".$row['com']."</p>";
        echo "<button class='like-btn' data-id='" . $row['id'] . "' style='background:" . ($liked ? "#4CAF50" : "none") . ";'>
                <span class='glyphicon glyphicon-thumbs-up'></span> <span class='like-count'>" . $row['like_count'] . "</span>
            </button>";
        echo "<button class='dislike-btn' data-id='" . $row['id'] . "' style='background:" . ($disliked ? "#f44336" : "none") . ";'>
                <span class='glyphicon glyphicon-thumbs-down'></span> <span class='dislike-count'>" . $row['dislike_count'] . "</span>
            </button>";

        // Reply form (only for logged-in users)
        if ($isLoggedIn) {
            echo "<form method='post' style='margin-top:10px'>
                    <input type='hidden' name='reply_to' value='".$cid."'>
                    <input type='text' name='reply' placeholder='Reply...' style='width:70%' />
                    <button name='reply_submit' class='btn btn-primary btn-sm'>Reply</button>
                  </form>";
        }

        // Show replies
        $reps = mysqli_query($con, "SELECT * FROM comments WHERE reply_to=$cid ORDER BY timer ASC");
        while ($rep = mysqli_fetch_assoc($reps)) {
            echo "<div class='reply'><b>".$rep['full-name']."</b> - <small>".time_elapsed_string($rep['timer'])."</small><br>";
            echo $rep['com']."</div>";
        }

        echo "</div>";
    }
    ?>
</div>

<script>

</script>

</body>
</html>
