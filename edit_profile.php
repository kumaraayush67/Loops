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

     	<!--Content starts-->
     	    <div class="content">
     	    <!--user_timeline starts-->
     	    	<?php include("includes/user_timeline.php");?>
     	    	<!--user_timeline ends-->
     	    	<!--content_timeline starts-->
     	    	
     	    	<div id="content_timeline">



                    <div style="display: inline-block; clear: both; margin: 25px;">
                        <h4>Edit Details</h4>
                        <form action="" method="post" style="display: block;" class="form-main" enctype="multipart/form-data">
                            <div class="form-group">
                                <i style="padding: 0 1rem; font-size: 1.2rem; color: #2196F3;" class="far fa-user"></i>
                                <input type="text" name="u_fname" value="<?php echo $user_fname ?>" required="required">
                                <input type="text" name="u_lname" value="<?php echo $user_lname ?>" required="required"><br/>
                                <i style="padding: 0 1rem; font-size: 1.2rem; color: #2196F3;" class="far fa-envelope"></i>
                                <input type="email" name="u_email" value="<?php echo $user_email ?>" required="required"><br/>
                                <i style="padding: 0 1rem; font-size: 1.2rem; color: #2196F3;" class="fas fa-key"></i>
                                <input type="password" name="u_pass" value="<?php echo $user_pass ?>" required="required"><br/>
                                <i style="padding: 0 1rem; font-size: 1.2rem; color: #2196F3;" class="fas fa-genderless"></i>
                                <select name="u_gender" disabled="disabled">
                                    <option><?php echo $user_gender ?></option>
                                </select><br/>
                                <i style="padding: 0 1rem; font-size: 1.2rem; color: #2196F3;" class="fas fa-image"></i>
                                <input type="file" name="u_image"><br/>
                                <br/>
                                <br/>
                                <button class="btn btn-primary" name="update">Update & Logout</button><br/><br/>
                                <h6>* For Sucessfull Update of Profile, Logout is required*</h6>
                           </div>
                        </form>
                    </div>
     	    		
               
          </form>
<?php
     if (isset($_POST['update'])) {
             $u_fname = $_POST['u_fname'];
             $u_lname = $_POST['u_lname'];
             $u_email = $_POST['u_email'];
             $u_pass = $_POST['u_pass'];
             $u_image = $_FILES['u_image']['name'];
             $image_tmp = $_FILES['u_image']['tmp_name'];

             move_uploaded_file($image_tmp,"user/user_images/$u_image");

             if (strlen($u_image)==0) {
             $update = "update users set user_fname='$u_fname', user_lname='$u_lname', user_email='$u_email', user_pass='$u_pass' where user_id='$user_id'"; }
             else { 
             $update = "update users set user_fname='$u_fname', user_lname='$u_lname', user_email='$u_email', user_pass='$u_pass', user_image='$u_image' where user_id='$user_id'"; }
             
             $run = mysqli_query($con,$update);
             
             if($run) {
               echo "<script>alert('Your profile is updated!!')</script>";
               echo "<script>window.open('logout.php?u_id=$user_id','_self')</script>";
             }
        

        }   


 ?>

     	    		
                </div>
     	    	<!--content_timeline ends-->
            <!--content ends-->

     </div>
    <!--Container ends-->


</body>
</html>
<?php } ?>