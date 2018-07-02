<?php
require_once('includes/init.php');
$CustomFunction = new CustomFunction();
if( isset($_SESSION['admin_email']) && $_SESSION['admin_email'] != '' ) {

	unset($_SESSION['admin_email']);
	$CustomFunction->redirect('login.php');
	exit();
} else {
	$CustomFunction->redirect('login.php');
	exit();
}