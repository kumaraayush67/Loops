<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");

if(!isset($_SESSION['user_email'])) {

     header("location: index.php");
}
else {
    include("includes/top.php");
?>
     	
<div class="content">

	<?php include("includes/user_timeline.php");?>
	
	<div id="content_timeline">

        <?php

            if(isset($_GET['u_id'])) {
                
                $u_id = $_GET['u_id'];
                $sel = "select * from users where user_id='$u_id'";
                $run = mysqli_query($con,$sel);
                $row = mysqli_fetch_array($run);
                $u_fname = $row['user_fname'];
                $u_lname = $row['user_lname'];
                $u_image = $row['user_image'];
            }

        ?>


        <div class="card" style="width: 20rem;">
            <img class="card-img-top" src="user/user_images/<?php echo $u_image; ?>"/>
          <div class="card-body">
            <h5 class="card-title">To <?php echo $u_fname." ". $u_lname; ?>,</h5>
            <form action="message.php?u_id=<?php echo $u_id ?>" method="post" id="f1">
                <p class="card-text"><div class="form-group">
                    <input class="form-control" id="exampleFormControlTextarea1" type="text" name="msg_title" placeholder="Message Subject..."/></div><div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="msg" placeholder="Message..."></textarea>
                </div></p>
                <button class="btn btn-primary" name="message">Send Message</button>
          </div>
        </div>

        <?php
            if(isset($_POST['message'])) {

                $msg_title = $_POST['msg_title'];
                $msg = $_POST['msg'];

                $insert = "insert into message (sender,receiver,msg_sub,msg_topic,reply,status,msg_date) values('$user_id','$u_id','$msg_title','$msg','no_reply','unread',NOW())";
                $run_insert = mysqli_query($con,$insert);

                if($run_insert) {
                    echo "<script>alert('Message was sent to '.$user_fname.' successfully!!')</script>";
                }
                else {
                    echo "<script>alert('Message was not sent!!!')</script>";
                }                          
            }
        ?>	    	
    </div>         

</div>
</body>
</html>
<?php } ?>