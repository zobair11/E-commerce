<?php
session_start();

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'project85');

$conn = mysqli_connect(HOST, USER, PASS, DB);

if(!$conn) {
	exit('Database connection is not established');
}