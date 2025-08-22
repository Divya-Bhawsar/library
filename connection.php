<!-------------connection.php--------------------------->
<?php
$servername="localhost";
$username="root";
$password="";
$database="library";
$con=mysqli_connect($servername,$username,$password,$database);  
if(!$con)
{
    die("connection failed" . mysqli_error($con));
}
// echo "Connected succesfully";
?>