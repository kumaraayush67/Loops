<?php
$query = "select * from posts";
$result = mysqli_query($con,$query);
// COUNT the total posts
$total_posts =mysqli_num_rows($result);
//Ceil func. to divide total records on per page ,roundup the records
$total_page = ceil($total_posts / $per_page);
//Going to first page
echo "
<center>
<div id ='pagination'>";

for($i=1; $i<=$total_page; $i++) {
	echo "<a href='home.php?page=$i'>$i</a>";
}
//Going to last page
echo "</center></div>";

?>