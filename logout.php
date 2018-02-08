<?php
 session_start();
 include("includes/connection.php");

 
 $user_id = $_GET['u_id'];
 
 $update = "update users set last_login=NOW() where user_id='$user_id'";
 $run = mysqli_query($con,$update);
 
 session_destroy();
 header("location: index.php");
 
?>