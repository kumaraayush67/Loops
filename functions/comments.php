<?php 
    echo "<h3>Comments:</h3> ";

    $get_id = $_GET['post_id'];

  	$get_com = "select * from comments where post_id='$get_id' ORDER BY 1 DESC ";

    $run_com = mysqli_query($con,$get_com);

    while($row=mysqli_fetch_array($run_com)) {

    	$com = $row['comment'];
    	$com_name = $row['comment_author'];
    	$date = $row['date'];

    	echo "
            <div class='list-group-item list-group-item-action flex-column align-items-start disable' style='background-color: #E0E0E0;'>
                <div class='d-flex w-100 justify-content-between'>
                  <h5 class='mb-1'>$com_name</h5>
                  <small>$date</small>
                </div>
                <p class='mb-1'>$com</p>
              </div>
    	";

    }
    

?>    