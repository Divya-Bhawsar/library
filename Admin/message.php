<?php
include "connection.php";
include "navbar.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
<style>

.left_box{
   height: 790px;
   width: 500px;
   float: left;
   background-color:#8ecdd2;
   margin-top:-20px;
}
.left_box2{
   height: 750px;
   width: 400px;
   background-color:black;
   border-radius:20px;
   float: right;
   margin-right:30px;
}
.left_box input{           
   height: 50px;
   width: 200px;
   background:black;
   background:#537890;
   padding:10px;
   border-radius:10px;
}
.list{
   height: 600px;
   width: 400px;
   background:black;
  color:white;
   float: right;
  overflow-y:scroll;
  overflow-x:hidden;
   padding:10px;
   border:none;
}
.right_box{
   height: 800px;
   width: 1100px;
   margin-left:350px;
   background:#8ecdd2;
  margin-top:-30px;
   padding:10px;
}
.right_box2{
   height: 750px;
   width: 800px;
   background:black;
   opacity: .9;
   border-radius:20px;
   float: left;
  margin-top:-20px;
  color:white;
   padding:20px;
}
tr:hover{
   background:#1e3f54;
   cursor: pointer;
}
.form-control{
  height:48px;
  width: 80%
}
.msg{
   height: 600px;
  overflow-y:scroll;
}
.chat{
    display: flex;
    flex-flow:row wrap;
}
.user .chatbox{
  height: 50px;
  background:#423471;
  width: 600px;
  color:white;
  padding:13px 10px;
  border-radius:10px;
}
.Admin .chatbox{
   height: 50px;
   background:#821b69;
   color:white;
   width: 600px;
   padding:13px 10px;
   border-radius:10px;
   order:-1;
   margin-left:100px;
 }
 .scroll{
 width:800px;
  height: 550px;
  overflow:auto;
 }
 table
{
  border:none;
}
  .unread {
      /* Unread message का Red background */
    color: white;
    font-weight: bold;
}

</style>
</head>
<body style="width: 1440px; height: 595px;">
 <?php
    $sql1=mysqli_query($con,"SELECT messages.full_name, MAX(student_registration.image) AS image, MAX(messages.time) AS time FROM student_registration INNER JOIN messages ON student_registration.full_name = messages.full_name GROUP BY messages.full_name ORDER BY  MAX(messages.time) DESC;");
 ?>
<!------------Left box Start------------------->     
<div class="left_box">
  <div class="left_box2">
    <div style="color:white; padding:10px;">
<form method="post" action="" enctype="multipart/form-data">
<input  type="text" name="full_name" id="uname" style="background:white; color:black;" placeholder="Search Username"> 
&nbsp;<button type="submit" name='submit' class="btn btn-default" style="background:green; color:black; border:2px solid black; border-radius:10%;">SHOW</button>
</form>
</div>

<div class="list">
<?php
echo "<table id='table' class='table'>";
function formatMessageTime($datetime) {
  $time = new DateTime($datetime);
  $now = new DateTime();
  $today = $now->format('Y-m-d');
  $yesterday = $now->modify('-1 day')->format('Y-m-d');
  $messageDate = $time->format('Y-m-d');

  if ($messageDate == $today) {
      return $time->format('h:i A'); // e.g., 2:45 PM
  } elseif ($messageDate == $yesterday) {
      return "Yesterday";
  } else {
      return $time->format('d M Y'); // e.g., 25 Apr 2025
  }
}

while($res1=mysqli_fetch_assoc($sql1)){ 
  $userImage = $res1['image'];
$user = $res1['full_name'];
// Count unread messages
$unreadQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM `messages` WHERE full_name='$user' AND status='No' AND sender='student'");
$unreadData = mysqli_fetch_assoc($unreadQuery);
$unreadCount = $unreadData['total'];
echo "<tr class='" . ($unreadCount > 0 ? "unread" : "") . "'>";  // Add unread class if unread messages exist
echo "<td><img class='img-circle profile-img' height=60 width=60 src='../student/images/{$userImage}'></td>";
echo "<td style='padding-top:30px;'>" . $user . "</td>";
echo "<td>" . formatMessageTime($res1['time']) ."</td>";
echo "<td style='padding-top:30px;'>";
// Show the unread count as a badge
if ($unreadCount > 0) {
    echo "<span style='color:black; padding:3px 7px; border-radius:50%; border:2px solid green; background-color:green;'>$unreadCount</span>";
}

echo "</td>";
echo "</tr>";

}
echo "</table>";
?>
</div>
</div>
</div>
<!-------Left Box End----------------->
<!-- ----Right box Start -------------->     
<div class="right_box">
  <div class="right_box2"><br><?php
//-------If submit is pressed------------------

  if (isset($_POST['submit'])) {
    $username = $_POST['full_name'];
    mysqli_query($con, "UPDATE `messages` SET status='yes' WHERE sender='student' AND full_name='$username'");
    // Fetch messages for the selected user
    echo "<script>window.location.href=window.location.href;</script>";
    $res = mysqli_query($con, "SELECT * FROM `messages` WHERE full_name='$username'");
    // Update all unread messages to "read"
    $_SESSION['username'] = $username;
  

   ?>
   <div style="height:70px; width:100%; text-align:center; color:black; background:#2eac8b;">
<h3 style="margin-top:-18px; padding-top:;"><br><?php echo $_SESSION['username']; ?></h3></div>
<!-------Show messsage Start------------------>
<div class="scroll">  
<div class="msg"><br>
    <?php
        while($row=mysqli_fetch_assoc($res)){
            if($row['sender']=='student')
            { ?> <br>
<!-----------Fetch Student Message Start----------------->
<div class="chat user">
  <div  class=""style="float:left; padding-top :5px;">&nbsp;
<?php
echo "<img class='img-circle profile_img'  height=40  width=40 src='images/p.jpg'>";
 ?>&nbsp;
</div>
<div style="float:left;" class="chatbox">
<?php   echo $row['message'];?>
</div></div>
<!-----Fetch Student Message End-----------> 
<br><?php
    } 
    else 
    { ?>
<!---------Fetch Admin Message Start------------>
<br><div class="chat Admin">
<div  class=""style="float:left; padding-top :5px;">&nbsp;
<?php
  echo "<img class='img-circle profile_img'  height=40  width=40 src='images/images.jpeg'>"; ?>&nbsp; </div>
<div style="float:left;" class="chatbox">
<?php echo $row['message']; ?>
</div> </div>
<!---Fetch admin Message End-------------->
 <?php  
}  } ?>
</div>
<!----------Show messsage End------------------>
</div>
<div class="" style="height:50px; padding-top:10px;">
  <form action="" method="post">
<input type="text"  name="message" class="form-control" required="" placeholder="Write Message...." style="float:left">&nbsp;
<button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span> &nbsp; Send</button>
</form></div>
<?php
    }
//-------If submit is not  pressed------------*/
else{
  if($_SESSION['username']==''){
?><img  style="margin:120px 80px; width: 600px; border-radius:50%;" src="images/ms.gif" >  <?php 
 }
else{
    if(isset($_POST['submit1'])) {
      mysqli_query($con, "UPDATE `messages` SET status='yes' WHERE sender='student' AND full_name='$_SESSION[username]'");
 mysqli_query($con,"INSERT INTO `messages`(`full_name`, `message`, `status`, `sender`) VALUES ('$_SESSION[username]','$_POST[message]','No','admin');");
 echo "<script>window.location.href=window.location.href;</script>"; // Refresh the page
 exit;
 
  

}     
else {
$res=mysqli_query($con,"SELECT * FROM `messages` where full_name='$_SESSION[username]';");  
 }  ?>
<div style="height:70px; width:100%; text-align:center; color:black; background:#2eac8b;">
<h3 style="margin-top:-18px; padding-top:;"><br><?php echo $_SESSION['username']; ?></h3></div>
 <!------Show New messsage Start------------>
 <div class="scroll">
    <div class="msg"><br>
    <?php
        while($row=mysqli_fetch_assoc($res)) {

            if($row['sender']=='student'){ 
              ?>
    <br>
<!------Fetch Student Message Start------------>
<div class="chat user">
<div  class=""style="float:left; padding-top :5px;">&nbsp;
<?php
          echo "<img class='img-circle profile_img'  height=40  width=40 src='images/p.jpg'>";
        ?>&nbsp;
      </div>
      <div style="float:left;" class="chatbox">
        <?php
           echo $row['message'];
        ?>
       </div>
    </div>
<!----Fetch Student Message End---------------> 
<br>
<?php
    }
   else
   {
?>
<!------Fetch New Admin Message Start------------->
   <br><div class="chat Admin">
          <div  class=""style="float:left; padding-top :5px;">&nbsp;
          <?php
            echo "<img class='img-circle profile_img'  height=40  width=40 src='images/images.jpeg'>";
          ?>&nbsp;
          </div>
          <div style="float:left;" class="chatbox">
          <?php
            echo $row['message'];
           ?>
          </div>
        </div>
<!-------Fetch New admin Message End------------->
<?php
   }
  } 
?>
</div>
<!-----------Show New messsage End------------->
</div>
  <div class="" style="height:50px; padding-top:12px;">

    <form action="" method="post">
        <input type="text"  name="message" class="form-control" required="" placeholder="Write Message......" style="float:left">&nbsp;
        <button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span> &nbsp; Send</button>
    </form>
  </div>
  <?php
    }
  } 

    ?>
</div></div>
<!-----------Right Box End---------------->
<script>
var table = document.getElementById('table');

for (var i = 0; i < table.rows.length; i++) {
    table.rows[i].onclick = function () {
        var userName = this.cells[1].innerText.trim();  // Get username
        document.getElementById("uname").value = userName;

        // Remove the unread notification count
        var badge = this.cells[2].querySelector("span");
        if (badge) {
            badge.remove();  // Remove red unread count badge
        }

        // Remove unread class to change background
        this.classList.remove("unread");

        // Automatically submit the form when clicking a username
        document.querySelector("form").submit();
    };
}
function updateChatList() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_users.php", true); // Create a separate file for fetching updated users list
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.querySelector(".list").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

// Auto-refresh every 5 seconds
setInterval(updateChatList, 5000);

</script> 

</body>
</html>
      