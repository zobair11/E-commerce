<?php
require_once('init-front.php');

$CustomFunction = new CustomFunction();
if( isset($_SESSION['logged_user']) && $_SESSION['logged_user'] !== '' ) {

	unset($_SESSION['logged_user']);
	$CustomFunction->redirect('signup.php');
	exit();
} else {
	$CustomFunction->redirect('signup.php');
	exit();
}