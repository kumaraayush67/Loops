<div id="user_timeline">
     	    		
	<div id="user_details" class="float-left">

     	<?php
          	$user = $_SESSION['user_email'];
               $get_user = "select * from users where user_email='$user'";
               $run_user = mysqli_query($con,$get_user);
               $row=mysqli_fetch_array($run_user);
               $user_id = $row['user_id'];
               $user_fname = $row['user_fname'];
               $user_lname = $row['user_lname'];
               $user_email = $row['user_email'];
               $user_gender = $row['user_gender'];
               $user_image = $row['user_image'];
               $register_date = $row['register_date'];
               $last_login = $row['last_login'];

               $user_posts = "select * from posts where user_id='$user_id'";
               $run_posts = mysqli_query($con,$user_posts);
               $posts = mysqli_num_rows($run_posts);

               $user_msg = "select * from message where receiver='$user_id' and status='unread'";
               $run_msg = mysqli_query($con,$user_msg);
               $msg = mysqli_num_rows($run_msg);

               echo "
               <div class='card' style='height: 100vh; margin-right: 20px;'>
                    <img src='user/user_images/$user_image' height='180' style='padding: 5px;'/>
                    <div class='card-body'>
                         <h5 class='card-title'>$user_fname  $user_lname</h5>
                         <p class='card-text'><strong>Email : </strong>$user_email</p>
                         <p class='card-text'><strong>Sex : </strong>$user_gender</p>
                         <p class='card-text'><strong>Register Date:</strong>$register_date</p>
                         <p class='card-text'><strong>Last Login : </strong>$last_login</p>
                         <p class='card-text'>
                              <a href='my_messages.php?u_id=$user_id'>Messages
                              <span class='badge badge-primary badge-pill'>$msg</span></a></p>
                         <p class='card-text'><a href='my_posts.php?u_id=$user_id'>Posts
                              <span class='badge badge-primary badge-pill'>$posts</span></a></p>
                         <p class='card-text'><a href='edit_profile.php?u_id=$user_id'>Edit  </a></p>   
                         <p class='card-text'><a href='logout.php?u_id=$user_id'>logout  </a></p>
                         
                    </div>
               </div>";
               /*  ?u_id is a get variable or url variable can be accessed by the page of link */
     	?>

	</div>
</div>
<div class="container">