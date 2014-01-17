<?php
class MySqlConnect {
	private $MySqli;
	public function __construct() {
		$this->MySqli = new mysqli("localhost", "paul", "1790pdbz","movie_db");
		//add code for checking against database connection failure
		//if($this->Mysqli)
	}
	
	public function __destruct()
    {
		$this->MySqli->close();      
    }
	
	public function MySqliReference() {
		return $this->MySqli;
	}
}

?>