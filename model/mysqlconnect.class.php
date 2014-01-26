<?php
error_reporting(E_ALL^E_WARNING);
//error_reporting(E_ERROR | E_PARSE);
class MySqlConnect {
	protected $MySqli;
	public function __construct() {
		$this->MySqli = new mysqli("localhost", "paul", "1790pdbz","movie_db");
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