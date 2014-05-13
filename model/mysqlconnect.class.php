<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

class that creates a MySQL connection.
**/
?>
<?php
//error_reporting(E_ALL^E_WARNING);

//error_reporting(E_ERROR | E_PARSE);
include 'mysql_connect.php';

class MySqlConnect {
	protected $MySqli;
	public function __construct() {
	       //for Windows MySQL
		   GLOBAL $mysql_info;
		$this->MySqli = new mysqli($mysql_info['host'], $mysql_info['username'], $mysql_info['password'], $mysql_info['database']);
		//for Ubuntu VM
		//$this->MySqli = new mysqli("localhost", "root", "pauldbz", "movie_db");
		//add code for checking against database connection failure
		if($this->MySqli->connect_errno) {
		$error = $this->MySqli->connect_error;
		include_once "../view/db_error.php";
		die();
		}
	}
	
	public function __destruct()
    {
		$this->MySqli->close();      
    }
	
	public function mysqlirows() {
		return $this->MySqli->affected_rows;
	}
}

?>