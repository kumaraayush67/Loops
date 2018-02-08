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
    	<?php
          include("includes/user_timeline.php")
     ?>
    	<!--user_timeline ends-->
    	<!--content_timeline starts-->
    	
    	<div id="content_timeline">
          <?php
               if(isset($_GET['post_id'])) {

                    $get_id = $_GET['post_id'];

                    $get_post = "select * from posts where post_id='$get_id'";
                    $run_post = mysqli_query($con,$get_post);
                    $row = mysqli_fetch_array($run_post);

                    $post_title =$row['post_title'];
                    $post_con =$row['post_content'];
               }
          ?>

          <form action="" method="post" id="f">
            <h4>Edit your post:</h4>
            <div class="form-group">
            <input type="text" name="title" value="<?php echo $post_title;?>" required="required" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" ><?php echo $post_con; ?></textarea>
            </div>
            <button name="sub" class="btn btn-primary"> Update </button>
        </form>
          <?php 
               if(isset($_POST['update'])){
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    
                    $update_post = "update posts set post_title='$title', post_content='$content' where post_id='$get_id'";
                    $run_update = mysqli_query($con,$update_post);
                    if($run_update){
                         echo "<script>alert('Your post is updated!!')</script>";
                         echo "<script>window.open('home.php','_self')</script>";
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