<?php
ob_start();
session_start();
require_once('admin/includes/database.php');
require_once('admin/includes/functions.php');
$customFunction = new customFunction();