<?php
require_once('init-front.php');

$email 		= $customFunction->inputvalid($_POST['email']);
$password 	= $customFunction->inputvalid($_POST['password']);
$hashPass 	= hash('sha256', $password);
$errors 	= array();

$check	= mysqli_query($connection, "SELECT email, pass, u_id FROM user WHERE email = '$email' AND pass = '$hashPass' ");
$foundRow = mysqli_num_rows($check);

if( isset($email, $password ) ) {
	
	if( empty($email) ) {
		$errors[] = 'Enter your email address';
	} elseif( $foundRow == 0 ) {
		$errors[] = 'Email or password is incorrect';
	}
	if( empty($password) ) {
		$errors[] = 'Enter your password';
	} 

	if( !empty($errors) ) {
		echo "<div class='alert alert-danger'>";
		foreach ($errors as $error) {
			echo $error;
			echo '<br/>';
		}
		echo '</div>';
	} else {
		
		echo "<div class='alert alert-success'>";
		echo '<a href="#" id="modal" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		echo "Successfully Logged";	
		$row = mysqli_fetch_array($check);
		$u_id = (int) $row['u_id'];
		$_SESSION['logged_user'] = $u_id;			
		?>
		<script type="text/javascript">
			setTimeout(function () {
				window.location.href = "signup.php";
			}, 3000);
		</script>
		<?php	
		echo "</div>";		
		
	}
}