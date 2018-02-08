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
		<?php single_post(); ?>
     </div>
    
</body>
</html>
<?php } ?>