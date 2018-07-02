<?php
class Database {

	private $_host = 'localhost';
	private $_user = 'root';
	private $_pass = '';
	private $_db   = 'project85';
	public  $connect;

	public function __construct() {
		return self::connection();
	}

	public function connection () {
		$this->connect = mysqli_connect( $this->_host, $this->_user, $this->_pass, $this->_db );
		if(!$this->connect) {
			die('Sorry, Database connectio is not established');
		}	
	}	
}

$database 	= new Database();