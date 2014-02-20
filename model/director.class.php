<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

model for directors.
**/
?>
<?php
include_once("mysqlconnect.class.php");

class DirectorModel extends MySqlConnect {
	//private MySqli;
	
	public function __construct() {
		parent::__construct();
		
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
	/*****
	this gets the list of directors for a particular movie
	***/
	public function getMovieDirectors($movieId) {
		$queryString = "SELECT * FROM MovieDirector MD, Director D WHERE D.id=MD.did AND MD.mid=".$movieId;
		$results = $this->MySqli->query($queryString);
		//$results = $this->MySqli->query("select * from Director");
		if(!$results) {
			return -1;
		}
		else {
			return $results;
		}
	}
}

?>