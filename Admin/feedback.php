<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
include "connection.php";
include "navbar.php";

 // hardcoded for testing, replace with real login system

$user = $_SESSION['login_user'];
if (isset($_POST['like']) || isset($_POST['dislike'])) {
    $id = $_POST['comment_id'];
    $user = $_SESSION['login_user'];
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

// Like/dislike via AJAX

if (isset($_POST['vote']) && isset($_POST['comment_id'])) {
    $comment_id = (int)$_POST['comment_id'];
    $action = $_POST['vote'];
    $check = mysqli_query($con, "SELECT * FROM comment_votes WHERE user='$user' AND comment_id=$comment_id");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($con, "INSERT INTO comment_votes (user, comment_id, action) VALUES ('$user', $comment_id, '$action')");
        $col = $action == 'like' ? 'like_count' : 'dislike_count';
        mysqli_query($con, "UPDATE comments SET $col = $col + 1 WHERE id = $comment_id");
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "already_voted"]);
    }
    exit;
}

// Handle new comment

if (isset($_POST['submit'])) {
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    $com = $_POST['com'];
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT INTO comments (`full-name`, com, reply_to, like_count, dislike_count, timer) 
            VALUES ('$user', '$com', NULL, 0, 0, '$now')";
     if (mysqli_query($con, $sql)) {
          //  echo "Comment Added Successfully<br>";
          header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        //echo "Comment Error: " . mysqli_error($con) . "<br>";
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
    <form method="post">
        <textarea name="com" style="width:100%; height:60px;"></textarea><br>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit" name="submit" class="btn btn-success">Comment</button>
    </form>
    <hr>
    <?php
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
        echo "<button class='like-btn' data-id='" . $row['id'] . "' style='background:" . ($liked ? "#4CAF50" : "none") . "; border: none;'>
        <span class='glyphicon glyphicon-thumbs-up'></span> <span class='like-count'>" . $row['like_count'] . "</span>
    </button>";
    echo "<button class='dislike-btn' data-id='" . $row['id'] . "' style='background:" . ($disliked ? "#f44336" : "none") . "; border: none;'>
    <span class='glyphicon glyphicon-thumbs-down'></span> <span class='dislike-count'>" . $row['dislike_count'] . "</span>
    </button>";



        //echo "<button class='btn btn-vote like-btn ".($liked ? "clicked" : "")."' data-id='$cid'>👍 ".$row['like_count']."</button>";
        //echo " <button class='btn btn-vote dislike-btn ".($disliked ? "clicked" : "")."' data-id='$cid'>👎 ".$row['dislike_count']."</button>";

        // Reply form
        echo "<form method='post' style='margin-top:10px'>
                <input type='hidden' name='reply_to' value='".$cid."'>
                <input type='text' name='reply' placeholder='Reply...' style='width:70%' />
                <button name='reply_submit' class='btn btn-primary btn-sm'>Reply</button>
              </form>";

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
</body>
<script>
$(document).ready(function(){
    $('.like-btn, .dislike-btn').click(function(f){
       // Prevent page reload
     //  f.preventDefault(); 
        var btn = $(this);
        var commentId = btn.data('id');
        var action = btn.hasClass('like-btn') ? 'like' : 'dislike';

        $.ajax({
            url: 'vote1.php',
            type: 'POST',
            data: { comment_id: commentId, action: action },
            success: function(response) {
                var data = JSON.parse(response);

                // If user has already voted the same way, show a message and return
                if (data.status === "already_voted") {
                    alert(data.message);  // Notify user if they already voted this way
                    return;
                }

                // Reset other buttons (for the same comment)
                $(".like-btn[data-id='" + commentId + "']").removeClass("active").css('background-color', '');
                $(".dislike-btn[data-id='" + commentId + "']").removeClass("active").css('background-color', '');

                // Highlight the clicked button and update the count accordingly
                if (action === 'like') {
                    btn.addClass("active");
                    btn.css('background-color', '#4CAF50');
                    var likeCountSpan = btn.find('.like-count');
                    var currentLikeCount = parseInt(likeCountSpan.text());
                    likeCountSpan.text(currentLikeCount + 1);

                    // Only decrease dislike count if it was already greater than 0
                    var dislikeCountSpan = $(".dislike-btn[data-id='" + commentId + "']").find('.dislike-count');
                    var currentDislikeCount = parseInt(dislikeCountSpan.text());
                    if (currentDislikeCount > 0) {
                        dislikeCountSpan.text(currentDislikeCount - 1);
                    }
                } else {
                    btn.addClass("active");
                    btn.css('background-color', '#f44336');
                    var dislikeCountSpan = btn.find('.dislike-count');
                    var currentDislikeCount = parseInt(dislikeCountSpan.text());
                    dislikeCountSpan.text(currentDislikeCount + 1);

                    // Only decrease like count if it was already greater than 0
                    var likeCountSpan = $(".like-btn[data-id='" + commentId + "']").find('.like-count');
                    var currentLikeCount = parseInt(likeCountSpan.text());
                    if (currentLikeCount > 0) {
                        likeCountSpan.text(currentLikeCount - 1);
                    }
                }
              
             //   alert(data.message);  // Notify user of success or update
            }
        });
       location.reload()
    });
});


</script>
</html>