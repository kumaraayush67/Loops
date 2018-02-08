<?php
include("includes/connection.php");
if(isset($_POST['sign_up'])){
       /*mysqli_real_escape_string is func. to prevent user from inputing malicious code*/ 
      $fname = mysqli_real_escape_string($con,$_POST['fname']);
  		$lname = mysqli_real_escape_string($con,$_POST['lname']);
  		$email = mysqli_real_escape_string($con,$_POST['email']);
  		$pass = mysqli_real_escape_string($con,$_POST['pass']);
  		$gender = mysqli_real_escape_string($con,$_POST['gender']);
  		$b_day = mysqli_real_escape_string($con,$_POST['b_day']);
  		$about = "Not Available :( ";
  		$posts = "No";

  		$get_email = "select * from users where user_email='$email'";
  		$run_email = mysqli_query($con,$get_email);
  		$check = mysqli_num_rows($run_email);
  		if($check==1) {
  			echo "<script>alert('Email is already Registered, Plz try again!!')</script>";
  			exit();
  		}
  		if(strlen($pass)<8) {
  			echo "<script>alert('Password should be minimum 8 characters')</script>";
  			exit();
  		}
  		else {
  			$insert = "insert into users (user_fname,user_lname,user_email,user_pass,user_gender,user_b_day,user_image,register_date,last_login,posts) values('$fname','$lname','$email','$pass','$gender','$b_day','default.jpg',NOW(),NOW(),'$posts')";
  			/*NOW() func that takes the date from our computer*/
  			$run_insert = mysqli_query($con,$insert);

  			    if($run_insert) {
              $_SESSION['user_email']=$email;
  			    	echo "<script>alert('Registration Successful!')</script>";
  			    	echo "<script>window.open('home.php','self')</script>";
  			    }
  		}
  	}
?>    