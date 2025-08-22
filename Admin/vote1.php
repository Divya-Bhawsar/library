<?php
include 'connection.php';
session_start();

$user = $_SESSION['login_user'];
$comment_id = $_POST['comment_id'];
$action = $_POST['action'];  // 'like' or 'dislike'

// Check if the user has already voted on this comment
$check_vote = mysqli_query($con, "SELECT action FROM comment_votes WHERE user='$user' AND comment_id=$comment_id");

if (mysqli_num_rows($check_vote) > 0) {
    // User has already voted
    $existing_vote = mysqli_fetch_assoc($check_vote)['action'];

    if ($existing_vote === $action) {
        // User clicked the same vote again, so do nothing or notify them
        echo json_encode(["status" => "already_voted", "message" => "You already voted this way."]);
    } else {
        // User changed their vote, so update the vote
        // Decrease the count of the previous vote (like/dislike)
        if ($existing_vote === 'like') {
            mysqli_query($con, "UPDATE comments SET like_count = like_count - 1 WHERE id = $comment_id");
        } else {
            mysqli_query($con, "UPDATE comments SET dislike_count = dislike_count - 1 WHERE id = $comment_id");
        }

        // Update the vote in the database
        mysqli_query($con, "UPDATE comment_votes SET action='$action' WHERE user='$user' AND comment_id=$comment_id");

        // Increase the count of the new vote (like/dislike)
        if ($action === 'like') {
            mysqli_query($con, "UPDATE comments SET like_count = like_count + 1 WHERE id = $comment_id");
        } else {
            mysqli_query($con, "UPDATE comments SET dislike_count = dislike_count + 1 WHERE id = $comment_id");
        }

        echo json_encode(["status" => "success", "message" => "Your vote has been updated."]);
    }
} else {
    // User has not voted yet, so insert a new vote
    mysqli_query($con, "INSERT INTO comment_votes (user, comment_id, action) VALUES ('$user', $comment_id, '$action')");

    // Update the like/dislike count in the comments table
    if ($action === 'like') {
        mysqli_query($con, "UPDATE comments SET like_count = like_count + 1 WHERE id = $comment_id");
    } else {
        mysqli_query($con, "UPDATE comments SET dislike_count = dislike_count + 1 WHERE id = $comment_id");
    }

    echo json_encode(["status" => "success", "message" => "Your vote has been registered."]);
}
?>
