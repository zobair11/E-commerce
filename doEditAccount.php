<?php
require_once('init-front.php');

$sessionId 	= (int) $_SESSION['logged_user'];
$name 		= $customFunction->inputvalid($_POST['name']);
$email 		= $customFunction->inputvalid($_POST['email']);
$password 	= $customFunction->inputvalid($_POST['pass']);
$hashPass 	= hash('sha256', $password);
$errors 	= array();

$checkEmail = mysqli_query($connection, "SELECT email FROM user WHERE email = '$email' AND u_id != '$sessionId'  ");

if( isset($name, $email, $password ) ) {
	
	if( empty($name) ) {
		$errors[] = 'Enter your name';
	}

	if( empty($email) ) {
		$errors[] = 'Enter your email address';
	} elseif( mysqli_num_rows($checkEmail) == 1 ) {
		$errors[] = 'Email address already exist';
	}

	if( !empty($password) ) {
		if( strlen($password) < 6 ) {
			$errors[] = 'Password must be at least 6 characters long';
		}
	} 

	if( !empty($errors) ) {
		echo "<div class='alert alert-danger'>";
		foreach ($errors as $error) {
			echo $error;
			echo '<br/>';
		}
		echo '</div>';
	} else {
		
		$column_name = array('email', 'name');

        if(!empty($password)) {
            array_push($column_name, 'pass');
        }

        $column_value = array($email, $name);

        if(!empty($password)) {
            array_push($column_value, $hashPass);
        }
        
        $query = $customFunction->updateData('user', $column_name, $column_value, 'u_id', $sessionId);     
		if( $query ) {
			 echo "<div class='alert alert-success'>Profile updated</div>";
			 ?>
			<script type="text/javascript">
				setTimeout(function () {
					window.location.href = "profile.php";
				}, 3000);
			</script>
			<?php	
		} else {
			echo "<div class='alert alert-danger'>Profile is not updated</div>";
		}
	}
}