<?php
require_once('init-front.php');


$name 		= $customFunction->inputvalid($_POST['name']);
$email 		= $customFunction->inputvalid($_POST['email']);
$password 	= $customFunction->inputvalid($_POST['password']);
$hashPass 	= hash('sha256', $password);
$errors 	= array();

$check	= mysqli_query($connection, "SELECT email FROM user WHERE email = '$email' ");
$foundRow = mysqli_num_rows($check);

if( isset($name, $email, $password ) ) {
	if( empty($name) ) {
		$errors[] = 'Enter your name';
	}
	if( empty($email) ) {
		$errors[] = 'Enter your email address';
	} elseif( $foundRow > 0 ) {
		$errors[] = 'Email address already exist';
	}
	if( empty($password) ) {
		$errors[] = 'Enter your password';
	} elseif( strlen($password) < 6 ) {
		$errors[] = 'Password must be at least 6 characters long';
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
		$column_name = array('name', 'email', 'pass', 'dated', 'is_active');
        $column_values = array($name, $email, $hashPass, $date, 1 );
        $query = $customFunction->insert_data('user', $column_name, $column_values);
        if( $query ) {
			echo "<div class='alert alert-success'>";
			echo '<a href="#" id="modal" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			echo "Congratulation, Successfully registered";			
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