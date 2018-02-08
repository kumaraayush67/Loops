<?php

  $con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

   //function for getting the topics
    

    //function to insert a post
    function insertPost() {

    	if(isset($_POST['sub'])) {
    		global $con;
    		global $user_id;
    		$title = addslashes($_POST['title']);
    		$content = addslashes($_POST['content']);
    		

    		if ($content=="") {
    			echo "<h2>Please enter topic description</h2>";
    			exit();
    		}

    		$insert = "insert into posts (user_id,post_title,post_content,post_date) value('$user_id','$title','$content',NOW())";

    		$run = mysqli_query($con,$insert);
    		     if($run) {
    		     	echo "<h3>Posted to timeline!!</h3>";

    		     	$update = "update users set posts='yes' where user_id='$user_id'";
    		     	$run_update = mysqli_query($con,$update);
    		     }
    	}
    }

    //function for displaying post
    function get_posts() {
    	global $con;
    	$per_page=4;
        
        if (isset($_GET['page'])) {
        	$page = $_GET['page'];
        } 
        else {
        	$page=1;
        }
        $start_from = ($page-1) * $per_page;
        $get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";
        $run_posts = mysqli_query($con,$get_posts);
        while($row_posts=mysqli_fetch_array($run_posts)) {
        	$post_id = $row_posts['post_id'];
        	$user_id = $row_posts['user_id'];
        	$post_title = $row_posts['post_title'];
        	$content = $row_posts['post_content'];
        	$post_date = $row_posts['post_date'];

        	//getting the user who has posted the thread
        	$user = "select * from users where user_id='$user_id' AND posts='yes'";
        	$run_user = mysqli_query($con,$user);
        	$row_user= mysqli_fetch_array($run_user);
        	$user_fname = $row_user['user_fname'];
        	$user_lname = $row_user['user_lname'];
        	$user_image = $row_user['user_image'];

        	//now diaplaying all at once
        	echo "
              <a href='single.php?post_id=$post_id' class='list-group-item list-group-item-action flex-column align-items-start'>
                <div class='d-flex w-100 justify-content-between'>
                  <small><img src='user/user_images/$user_image' width='30' height='30' style='border-radius: 50%;'>  $user_fname $user_lname</small>
                </div>
                <div class='d-flex w-100 justify-content-between'>
                  <h5 class='mb-1'>$post_title</h5>
                  <small>$post_date</small>
                </div>
                <p class='mb-1'>$content</p>
                <small>See Reply or reply to this</small>
              </a>";

        }
        include("pagination.php"); 
    }

    function single_post() {

    	if(isset($_GET['post_id'])) {
    	
    	global $con;

    	$get_id = $_GET['post_id'];

    	$get_posts = "select * from posts where post_id='$get_id'";
        $run_posts = mysqli_query($con,$get_posts);
        $row_posts=mysqli_fetch_array($run_posts);
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $post_title = $row_posts['post_title'];
        $content = $row_posts['post_content'];
        $post_date = $row_posts['post_date'];

        	//getting the user who has posted the thread
        	$user = "select * from users where user_id='$user_id' AND posts='yes'";
        	$run_user = mysqli_query($con,$user);
        	$row_user= mysqli_fetch_array($run_user);
        	$user_fname = $row_user['user_fname'];
        	$user_lname = $row_user['user_lname'];
        	$user_image = $row_user['user_image'];

        	//getting user under session
        	$user_com = $_SESSION['user_email'];
            $get_com = "select * from users where user_email='$user_com'";
            $run_com = mysqli_query($con,$get_com);
            $row_com=mysqli_fetch_array($run_com);
            $user_com_id = $row_com['user_id'];
            $user_com_fname = $row_com['user_fname'];

        	//now diaplaying all at once
        	echo "<div class='list-group'>
              <div class='list-group-item list-group-item-action flex-column align-items-start disabled' style='margin-top: 25px;'>
                <div class='d-flex w-100 justify-content-between'>
                  <small><img src='user/user_images/$user_image' width='30' height='30' style='border-radius: 50%;'>  $user_fname $user_lname</small>
                </div>
                <div class='d-flex w-100 justify-content-between'>
                  <h5 class='mb-1'>$post_title</h5>
                  <small>$post_date</small>
                </div>
                <p class='mb-1'>$content</p>
                <small>See Reply or reply to this</small>
              </div></div>
              <div class='list-group'>";
             include("comments.php");
           	echo "</div>
            <div class='list-group'>
           	</form>
            <form action='' method='post' id='f'>
            <div class='form-group'>
            <textarea class='form-control' id='exampleFormControlTextarea1' rows='3' placeholder='Write Something !!'></textarea>
            </div>
            <button name='reply' class='btn btn-primary justify-content-end'> Reply </button>
            </form>

           	";

           	if(isset($_POST['reply'])) {

           		$comment = $_POST['comment'];

           		$insert = "insert into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_com_id','$comment','$user_com_fname',NOW())";

           		$run = mysqli_query($con,$insert);
           		echo "<script>window.open('single.php?post_id=$get_id','_self')</script>";

           	}
    	}
    } 
    //function for getting topics

    function single_msg() {

        if(isset($_GET['msg_id'])) {
        
        global $con;

        $msg_id = $_GET['msg_id'];

        $get_msg = "select * from message where msg_id='$msg_id'";
        $run_msg = mysqli_query($con,$get_msg);
        $row_msg = mysqli_fetch_array($run_msg);
        $id = $row_msg['msg_id'];
        $sender = $row_msg['sender'];
        $receiver = $row_msg['receiver'];
        $msg_sub = $row_msg['msg_sub'];
        $msg = $row_msg['msg_topic'];
        $status = $row_msg['status'];
        $msg_date = $row_msg['msg_date'];

            
            $user = "select * from users where user_id='$sender'";
            $run_user = mysqli_query($con,$user);
            $row_user = mysqli_fetch_array($run_user);
            $sen_fname = $row_user['user_fname'];
            $sen_lname = $row_user['user_lname'];
            $sen_image = $row_user['user_image'];

            $update_status = "update message set status='read' where msg_id='$id'";
            $run_update = mysqli_query($con,$update_status);            
            

            //now diaplaying all at once
            echo "
            <div class='list-group'>
            <div class='list-group-item list-group-item-action flex-column align-items-start disabled'>
                <div class='d-flex w-100 justify-content-between'>
                  <small><img src='user/user_images/$sen_image' width='30' height='30' style='border-radius: 50%;'>  $sen_fname $sen_lname</small>
                </div>
                <div class='d-flex w-100 justify-content-between'>
                  <h5 class='mb-1'>$msg_sub</h5>
                  <small>$msg_date</small>
                </div>
                <p class='mb-1'>$msg</p>
                <div class='d-flex w-100 justify-content-end'><a href='message.php?u_id=$sender' class='btn btn-primary'>Reply</a></div>
            </div></div>";
            
            
        }
    }

    function get_Cats() {
    	global $con;
    	$per_page=5;
        
        if (isset($_GET['page'])) {
        	$page = $_GET['page'];
        } 
        else {
        	$page=1;
        }
        $start_from = ($page-1) * $per_page;

        if(isset($_GET['topic'])) {
        	$topic_id = $_GET['topic'];
        }
        $get_posts = "select * from posts where topic_id='$topic_id' ORDER by 1 DESC LIMIT $start_from, $per_page";
        $run_posts = mysqli_query($con,$get_posts);
        echo "<div class='list-group'>";
        while($row_posts=mysqli_fetch_array($run_posts)) {
        	$post_id = $row_posts['post_id'];
        	$user_id = $row_posts['user_id'];
        	$post_title = $row_posts['post_title'];
        	$content = $row_posts['post_content'];
        	$post_date = $row_posts['post_date'];

        	//getting the user who has posted the thread
        	$user = "select * from users where user_id='$user_id' AND posts='yes'";
        	$run_user = mysqli_query($con,$user);
        	$row_user= mysqli_fetch_array($run_user);
        	$user_fname = $row_user['user_fname'];
        	$user_lname = $row_user['user_lname'];
        	$user_image = $row_user['user_image'];

        	//now diaplaying all at once
        	echo "
                
                <a href='single.php?post_id=$post_id' class='list-group-item list-group-item-action flex-column align-items-start'>
                <div class='d-flex w-100 justify-content-between'>
                  <small><img src='user/user_images/$user_image' width='30' height='30' style='border-radius: 50%;'>  $user_fname $user_lname</small>
                </div>
                <div class='d-flex w-100 justify-content-between'>
                  <h5 class='mb-1'>$post_title</h5>
                  <small>$post_date</small>
                </div>
                <p class='mb-1'>$content</p>
                <small>See Reply or reply to this</small>
              </a>";

        }
        echo "</div>";
        include("pagination.php"); 
    }


      //function for getting seareched research

    function GetResults() {
    	global $con;
    	
        if(isset($_GET['user_query'])) {
        	$search_term = $_GET['user_query'];
        }

        $get_posts = "select * from posts where post_title like '%$search_term%' ORDER by 1 DESC LIMIT 5";

        $run_posts = mysqli_query($con,$get_posts);
        $count_result = mysqli_num_rows($run_posts);

        if($count_result==0) {
        	echo "<h4>SORRY! No Result Found</h4>";
        	exit();
        }
        else {
        	echo "<h4>Your Result is here!!</h4>";
        }
        while($row_posts=mysqli_fetch_array($run_posts)) {
        	$post_id = $row_posts['post_id'];
        	$user_id = $row_posts['user_id'];
        	$post_title = $row_posts['post_title'];
        	$content = $row_posts['post_content'];
        	$post_date = $row_posts['post_date'];

        	//getting the user who has posted the thread
        	$user = "select * from users where user_id='$user_id' AND posts='yes'";
        	$run_user = mysqli_query($con,$user);
        	$row_user= mysqli_fetch_array($run_user);
        	$user_fname = $row_user['user_fname'];
        	$user_lname = $row_user['user_lname'];
        	$user_image = $row_user['user_image'];

        	//now diaplaying all at once
        	echo "
            
            <a href='single.php?post_id=$post_id' class='list-group-item list-group-item-action flex-column align-items-start'>
                <div class='d-flex w-100 justify-content-between'>
                  <small><img src='user/user_images/$user_image' width='30' height='30' style='border-radius: 50%;'>  $user_fname $user_lname</small>
                </div>
                <div class='d-flex w-100 justify-content-between'>
                  <h5 class='mb-1'>$post_title</h5>
                  <small>$post_date</small>
                </div>
                <p class='mb-1'>$content</p>
                <small>See Reply or reply to this</small>
              </a>";

        }
         
    }
    //function for displaying user post
    function user_posts() {
        global $con;
        if(isset($_GET['u_id'])) {
            $u_id = $_GET['u_id'];
        }
        $get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5";
        $run_posts = mysqli_query($con,$get_posts);
        while($row_posts=mysqli_fetch_array($run_posts)) {
            $post_id = $row_posts['post_id'];
            $user_id = $row_posts['user_id'];
            $post_title = $row_posts['post_title'];
            $content = $row_posts['post_content'];
            $post_date = $row_posts['post_date'];

            //getting the user who has posted the thread
            $user = "select * from users where user_id='$user_id' AND posts='yes'";
            $run_user = mysqli_query($con,$user);
            $row_user= mysqli_fetch_array($run_user);
            $user_fname = $row_user['user_fname'];
            $user_lname = $row_user['user_lname'];
            $user_image = $row_user['user_image'];

            //now diaplaying all at once
            echo "
            <div class='list-group-item list-group-item-action flex-column align-items-start disabled'>
                <div class='d-flex w-100 justify-content-between'>
                  <small><img src='user/user_images/$user_image' width='30' height='30' style='border-radius: 50%;'>  $user_fname $user_lname</small>
                </div>
                <div class='d-flex w-100 justify-content-between'>
                  <h5 class='mb-1'>$post_title</h5>
                  <small>$post_date</small>
                </div>
                <p class='mb-1'>$content</p>
                <div class='d-flex w-100 justify-content-end'>
                    <div class='btn-group' role='group' aria-label='Basic example'>
                    <a href='single.php?post_id=$post_id'><button type='button' class='btn btn-secondary'>View</button></a>
                    <a href='edit_post.php?post_id=$post_id'><button type='button' class='btn btn-secondary'>Edit</button></a>
                    <a href='functions/delete_post.php?post_id=$post_id'><button type='button' class='btn btn-secondary'>Delete</button></a>
                </div></div>
              </div>";
            include("delete_post.php");

        }
       
    } 
    function user_profile() {
        

        if(isset($_GET['u_id'])) {
            global $con;
            
            $user_id = $_GET['u_id'];
        
            $select = "select * from users where user_id='$user_id'";
            $run = mysqli_query($con,$select);
            $row=mysqli_fetch_array($run) ;

            $image = $row['user_image'];
            $fname = $row['user_fname'];
            $lname = $row['user_lname'];
            $email = $row['user_email'];
            $gender = $row['user_gender'];
            $register_date = $row['register_date'];
            $last_login = $row['last_login'];
            
            if($gender=='Male') {
                $msg="Send him a message.";
            }
            else {
                $msg="Send her a message.";
            }

            echo " 
                    <div class='list-group'>
                    <div class='list-group-item list-group-item-action flex-column align-items-start disabled'>
                        <div class='d-flex w-100 justify-content-between'>
                          <div class='mb-1'><br>
                            <p><strong>Name : </strong>$fname  $lname</p>
                            <p><strong>Email : </strong>$email</p>
                            <p><strong>Sex : </strong>$gender</p>
                            <p><strong>Member Since:</strong>$register_date</p>
                            <p><strong>Last Seen : </strong>$last_login</p><br>
                            <a href='message.php?u_id=$user_id' class='btn btn-primary'>$msg</a>
                          </div>
                          <div><img src='user/user_images/$image' width='300' height='300' style='border-radius: 50%;'></div>
                        </div>
                        <div class='d-flex w-100 justify-content-end'>
                            
                        </div>
                    </div></div>";  
        }
        new_member();
        
    }
    function new_member() {

        global $con;
        $user = "select * from users LIMIT 0,20 ";

        $run_user = mysqli_query($con,$user);

        echo "<br/><h4>New members on this site:</h4>";
        while ($row_user=mysqli_fetch_array($run_user)) {
            $user_id = $row_user['user_id'];
            $user_fname = $row_user['user_fname'];
            $user_lname = $row_user['user_lname'];
            $user_image = $row_user['user_image'];

        echo "
            <a href='user_profile.php?u_id=$user_id' class='card' style='width: 15rem; display: inline-block;'>
              <img src='user/user_images/$user_image' class='card-img-top' height='200' title='$user_fname $user_lname'/>
              <div class='card-body'>
                <p class='card-text text-center'>$user_fname $user_lname</p>
              </div>
            </a>
        ";
        } 

    }


?>





