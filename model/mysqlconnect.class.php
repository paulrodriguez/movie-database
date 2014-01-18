<?php
class MySqlConnect {
	protected $MySqli;
	public function __construct() {
		$this->MySqli = new mysqli("localhost", "paul", "1790pdbz","movie_db");
		//add code for checking against database connection failure
		//if($this->Mysqli)
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