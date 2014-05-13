<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

model for Actors.
**/
?>
<?php
include_once("mysqlconnect.class.php");
class ActorsModel extends MySqlConnect{
	//private $connection;
	//private $MySqli;
	public function __construct() {
		parent::__construct();
		//$this->connection = new MySqlConnect();
		//$this->MySqli = $this->connection->MySqliReference();
	}
	
	public function __destruct()
    {
		  parent::__destruct();
    }
	
		public function getActor($constraints) {
		$selectColumnsString = "*";
		
		$whereStringConditions = "";
		//create string if we have to select specific columns
		if(isset($constraints['select'])) {
			if(sizeof($constraints['select']) > 0) {
				$selectColumnsString = implode(", ",$constraints['select']);
			}
		}
		
		//create string conditions for query string
		if(isset($constraints['where'])) {
			if(sizeof($constraints['where']) > 0) {
				$whereStringConditions = " WHERE ";
				foreach($constraints['where'] as $key => $value) {
				$whereStringConditions .= $key."=".$value." AND ";
				}
				$whereStringConditions = substr($whereStringConditions,0,sizeof($whereStringConditions)-6);
			}
		}
		$fullQueryString = "SELECT ".$selectColumnsString." FROM actor".$whereStringConditions;
		
		//$results = $this->MySqli->query("SELECT ".$selectColumnsString." FROM ".$constraints['table']."".$whereStringConditions);
		$results = $this->MySqli->query($fullQueryString);
		if(!$results) {
			//print_r("invalid query");
			print_r($this->MySqli->error);
			return -1;
		}
		else {
			return $results;
		}
	}
	
	
	public function getActorsInMovie($movieId) {
		$queryString = "SELECT * FROM actor A, movieactor MA WHERE MA.aid=A.id AND MA.mid=".$movieId;
		
		$results = $this->MySqli->query($queryString);
		if(!$results) {
			return -1;
		}
		else {
			return $results;
		}
		
	}
	
	public function searchActors($constraints) {
		$query = "select id, first, last, dob FROM actor WHERE ";
		
		for($i = 0; $i < sizeof($constraints); $i++) {
			if($i != sizeof($constraints)-1) {
				//echo "counter: " . $i. "<br />";
				$query .="first LIKE '%".$constraints[$i]."%' OR last LIKE '%".$constraints[$i]."%' OR ";		
			}
			else {
				$query .= "first LIKE '%".$constraints[$i]."%' OR last LIKE '%".$constraints[$i]."%' ";
			}
			
		}
		$query .= "ORDER BY first, last";
	
		$results = $this->MySqli->query($query);
		if(!$results) {
			//print_r("invalid query");
			print_r($this->MySqli->error);
			return -1;
		}
		else {
			return $results;
		}
	}
}


?>