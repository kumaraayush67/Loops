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
	<?php
          include("includes/user_timeline.php");
     ?>
	
	<div id="content_timeline">
		

        <form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f">
            <h4>Write a Post!</h4>
            <div class="form-group">
            <input type="text" name="title" placeholder="title" required="required" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write Something !!"></textarea>
            </div>
            <button name="sub" class="btn btn-primary"> Post!! </button>
        </form>
     
          <?php insertPost(); ?>
        <div class="list-group">
            <?php get_posts(); ?>
        </div>
     </div>
	
</div>

</body>
</html>
<?php } ?>