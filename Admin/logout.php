<?php
session_start();
if(isset($_SESSION['login_user']))
{
   
    unset($_SESSION['login_user']);
    session_destroy();
 // Destroy session on logout or timeout
    

}
header("location:../index.php");
?>