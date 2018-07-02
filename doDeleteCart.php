<?php
require_once('init-front.php');
$delete_p_id = (int) $_POST['delete_p_id'];
if ( $delete = $customFunction->deleteData('tmp_cart', 'p_id', $delete_p_id) ) {
	?>
	<script type="text/javascript">
		window.location.href="add_to_cart.php";
	</script>
	<?php
} else {
	echo "<div class='alert alert-danger'>Something is wrong.</div>";
}