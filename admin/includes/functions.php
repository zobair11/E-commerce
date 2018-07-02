<?php
$connection = $database->connect;

class CustomFunction {

	public function inputvalid( $string ) {
		global $connection;
		return mysqli_real_escape_string($connection, $string);		
	}

	public function redirect ( $location, $refresh = null) {

		if( empty($refresh) ) {
			header("Location: {$location}");
		} else {
			header("Refresh:{$refresh}; url={$location}");
		}		
	}

	public function is_login () {

		if( !isset($_SESSION['admin_email']) && $_SESSION['admin_email'] == '' )	{
			self::redirect('login.php');	
			exit();		
		}
	}

	public function insert_data($table, $column_name = array(), $column_values = array() )  {
		
		global $connection;

		$column_name = implode(',', $column_name);

		$column_v = array();
		foreach ($column_values as $value) {
			$column_v[] = "'".$value."'";
		}
		$column_values1 = implode(',', $column_v);

		$insert = "INSERT INTO $table ( $column_name ) VALUES ( $column_values1 ) ";
		
		$query = mysqli_query($connection, $insert);

		if($query) {
			return true;
		} else {
			return false;
		}
	}

	public function getAllData ($table, $orderby, $order = null, $id = null) {
		global $connection;
		$query = "SELECT * FROM $table ";

		if( !empty($id) ) {
			$query .= " WHERE $orderby = $id ";
		}

		if( !empty($order) ) {
			if($order == 'ASC' || $order == 'DESC' ) {
				$query .= " ORDER BY $orderby $order ";
			}			
		}


		$query = mysqli_query($connection, $query);
		return $query;
	}

	public function updateData ($table, $column_name, $column_values, $id, $id_value) {
		global $connection;		

		$data = array();
		foreach ($column_name as $key => $value) {
			$data[] = $value . '=' . "'".$column_values[$key]."'";
		}
		$data = implode(', ', $data);		

		$query = " UPDATE $table SET ";
		$query .= $data;
		$query .= " WHERE $id = $id_value ";
		$query = mysqli_query($connection, $query);
		return $query;		
	} 

	public function deleteData ($table, $id, $id_value) {
		global $connection;
		$query = mysqli_query($connection, "DELETE FROM $table WHERE $id =  $id_value ");
		return $query;
	}

	public function numRows($query) {
		global $connection;		
		$numRows = mysqli_num_rows($query);
		return $numRows;
	}

	public function readMore ($string, $start, $end, $url) {
		return substr($string, $start, $end) . "<a href='$url'>...Read More</a>";
	}

	public function isLogin () {
		if( !isset($_SESSION['logged_user']) && $_SESSION['logged_user'] == '' ) {
			self::redirect('login.php');
		}
	}

	public function isLoginExit () {
		if( isset($_SESSION['logged_user']) && $_SESSION['logged_user'] != '' ) {
			self::redirect('index.php');
		}
	}

}