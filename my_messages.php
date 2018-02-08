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

    <table class="table table-hover" style="display: inline-block; clear: both; width: auto; margin: 25px">
      <thead>
        <tr>
            <th scope="col">Sender</th>
            <th scope="col">Subject</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
            <th scope="col">Reply</th>
        </tr>
      </thead>
      <tbody>
        <?php 
            $sel_msg = "select * from message where receiver='$user_id' ";
            $run_msg = mysqli_query($con,$sel_msg);

            $count_msg = mysqli_num_rows($run_msg);

            while($row_msg=mysqli_fetch_array($run_msg))
            {
                $msg_id = $row_msg['msg_id'];
                $msg_receiver = $row_msg['receiver'];
                $msg_sender = $row_msg['sender'];
                $msg_sub = $row_msg['msg_sub'];
                $msg_topic = $row_msg['msg_topic'];
                $msg_date = $row_msg['msg_date'];
                $msg_status = $row_msg['status'];

            $get_sender = "select * from users where user_id='$msg_sender'";
            $run_sender = mysqli_query($con,$get_sender);
            $row= mysqli_fetch_array($run_sender);

            $sender_fname = $row['user_fname'];
            $sender_lname = $row['user_lname'];
        ?>
        <tr>
          <td><a href="user_profile.php?u_id=<?php echo $msg_sender; ?>" target="_self"><?php echo $sender_fname." ".$sender_lname; ?></a></th>
          <td><a href="single_msg.php?msg_id=<?php echo $msg_id; ?>"><?php echo $msg_sub; ?></a></td>
          <td><?php echo $msg_date; ?></td>
          <td><?php echo $msg_status; ?></td>
          <td><a href="message.php?u_id=<?php echo $msg_sender ?>">Reply</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
	
	
</div>
</body>
</html>
<?php } ?>