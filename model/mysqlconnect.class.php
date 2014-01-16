<?php
class MySqlConnect {
	private $MySqli;
	public function __construct() {
		$this->MySqli = new mysqli("localhost", "paul", "1790pdbz","movie_db");
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