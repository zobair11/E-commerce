<?php
require_once('init.php');

if( isset($_SESSION['admin_email']) && $_SESSION['admin_email'] != '' ) {

	unset($_SESSION['admin_email']);
	redirect('login.php');
	exit();
}