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
        <h2>All Registered Users </h2><br/>
    	<?php
            $get_members = "select * from users";
            $run_members = mysqli_query($con,$get_members);
            
            while($row=mysqli_fetch_array($run_members)) {
                $user_id = $row['user_id'];
                $user_fname = $row['user_fname'];
                $user_lname = $row['user_lname'];
                $user_image = $row['user_image'];
                                    
                echo "
                        <a href='user_profile.php?u_id=$user_id' class='card' style='width: 15rem; display: inline-block;'>
                          <img src='user/user_images/$user_image' class='card-img-top' height='200' title='$user_fname $user_lname'/>
                          <div class='card-body'>
                            <p class='card-text text-center'>$user_fname $user_lname</p>
                          </div>
                        </a>";
            }                    
        ?>
    </div>

</div>

</body>
</html>
<?php } ?>