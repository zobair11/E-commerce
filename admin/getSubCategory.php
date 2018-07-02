<?php
require_once('includes/init.php');
$customFunction = new CustomFunction;
$connection  = $database->connect;

$cat_id = (int) $_POST['cat_id'];
$allData = mysqli_query($connection, "SELECT * FROM sub_cat WHERE cat_id = '$cat_id' ");
echo "<select name='p_sub' id='p_sub' class='form-control'>";
	if( mysqli_num_rows($allData) == 0 ) {
		echo "<option value=''>No Data Available</option>";
	} else {
		
		while ( $row =  mysqli_fetch_array($allData) ) {
			$sub_id = (int) $row['sub_id'];
			$sub_name = $row['sub_name'];
			echo "<option value='$sub_id'>$sub_name</option>";
		}
		
	}
echo "</select>";	


?>