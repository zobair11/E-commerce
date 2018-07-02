<?php
require_once('init-front.php');
if( !isset($_SESSION['logged_user']) ) {
	echo "<div class='alert alert-danger'>Please Log In</div>";
	die();
}

$qnt 	= (int) $_POST['qnt'];
$p_id 	= (int) $_POST['p_id'];
$u_id 	=  $_SESSION['logged_user'];

if(empty($qnt)) {
	echo "<div class='alert alert-danger'>Please enter your product qunatity</div>";
} else {
	$lastId = array();
	$query 	= mysqli_query($connection, "INSERT INTO tmp_cart(p_id, qnt, u_id, dated) VALUES ('$p_id', '$qnt', '$u_id', NOW() ) ");
	$lastId = mysqli_insert_id($connection);
	
	if( isset($_SESSION['tmp_id']) ) {
		array_push( $_SESSION['tmp_id'], $lastId);
	} else {
		$_SESSION['tmp_id'] = array($lastId);
	}
	

	if( $query ) {
		?>
		<script type="text/javascript">
			window.location.href = "add_to_cart.php";
		</script>
		<?php
	} else {
		echo "<div class='alert alert-danger'>Sorry, System can't working...</div>";
	}
}
