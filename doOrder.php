<?php
require_once('init-front.php');

extract($_POST);

$company  = $customFunction->inputvalid($_POST['company']);
$email   = $customFunction->inputvalid($_POST['email']);
$title  = $customFunction->inputvalid($_POST['title']);
$fname   = $customFunction->inputvalid($_POST['fname']);
$mname  = $customFunction->inputvalid($_POST['mname']);
$lname   = $customFunction->inputvalid($_POST['lname']);
$address  = $customFunction->inputvalid($_POST['address']);
$phone   = $customFunction->inputvalid($_POST['phone']);
$mphone   = $customFunction->inputvalid($_POST['mphone']);
$fax  = $customFunction->inputvalid($_POST['fax']);
$message   = $customFunction->inputvalid($_POST['message']);

$ordered = date("Y-m-d h:i:s");
$lastTmpId = $_SESSION['tmp_id'];
$tmp_id = $_SESSION['tmp_id'];

$column_name = array('company', 'email', 'title', 'fname', 'mname', 'lname', 'address', 'zip', 'country', 'state', 'phone', 'mphone', 'fax', 'payment', 'message', 'u_id', 'p_id', 'ordered');
$column_values = array($company, $email, $title, $fname, $mname, $lname, $address, $zip, $country, $state, $phone, $mphone, $fax, $payment, $message, $u_id, $p_id, $ordered);
$query = $customFunction->insert_data('product_order', $column_name, $column_values); 


if( $query ) {
	echo "<div class='alert alert-success'>";
		echo "Congratulation! Your order has been placed.";
	echo "</div>";
	foreach ($tmp_id as $key => $value) {
		$column_name = array('is_completed');
        $column_value = array(1);
        $update = $customFunction->updateData('tmp_cart', $column_name, $column_value, 'tmp_id', $value);  
		$delete = $customFunction->deleteData('tmp_cart','is_completed',1);
	}
	?>
	<script type="text/javascript">
		$("#checkout").prop('disabled', true);
		setTimeout(function () {
			window.location.href = "index.php";
		}, 3000);
	</script>
	<?php
} else {
	echo "<div class='alert alert-danger'>";
		echo "OPPS! Something is wrong.";
		echo mysqli_error($connection);
	echo "</div>";
}