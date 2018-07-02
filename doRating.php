<?php
require_once('init-front.php');

$p_id 	= (int) $_POST['p_id'];
$name 	= $customFunction->inputvalid($_POST['name']);
$email 	= $customFunction->inputvalid($_POST['email']);
$review = $customFunction->inputvalid($_POST['review']);
$rating = $customFunction->inputvalid($_POST['rating']);
$errors =  array();

$check	= mysqli_query($connection, "SELECT name, p_id FROM rating WHERE p_id = '$p_id' AND name = '$name' ");
$foundRow = mysqli_num_rows($check);

if( isset($p_id, $name, $email, $review, $rating ) ) {
	if( empty($name) ) {
		$errors[] = 'Enter your name';
	}
	if( empty($email) ) {
		$errors[] = 'Enter your email address';
	}
	if( empty($review) ) {
		$errors[] = 'Enter your review';
	}
	if( empty($rating) ) {
		$errors[] = 'Select your rating';
	}
	if($foundRow > 0){
		$errors[] = 'You already submitted your review for this product';
	}

	if( !empty($errors) ) {
		echo "<div class='alert alert-danger'>";
		foreach ($errors as $error) {
			echo $error;
			echo '<br/>';
		}
		echo '</div>';
	} else {

		$date = date("Y-m-d h:i:s");
		$column_name = array('p_id', 'name', 'email', 'review', 'rating', 'dated');
        $column_values = array($p_id, $name, $email, $review, $rating, $date );
        $query = $customFunction->insert_data('rating', $column_name, $column_values);
        if( $query ) {
			echo "<div class='alert alert-success'>";
			echo '<a href="#" id="modal" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			echo "Thanks, Your Review has been submitted.";
			echo $foundRow;
			echo "</div>";
			?>
			<script>
			setTimeout(function(){
				jQuery(function(){
				   jQuery('#modal').click();
				});
			}, 3000);			
			</script>
			<?php
		} else {
			echo "<div class='alert alert-success'>";
				echo mysqli_error($connection);
			echo "</div>";
		}
	}
}