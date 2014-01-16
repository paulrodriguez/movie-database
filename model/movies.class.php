<?php

class Movies {
	private $MySqli;
	public function __construct() {
		$this->MySqli = new mysqli("localhost", "paul", "1790pdbz","movie_db");
	}
	
	public function __destruct()
    {
		$this->MySqli->close();      
    }
	public function getMySqliReference() {
		return $this->MySqli;
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
		$fullQueryString = "SELECT ".$selectColumnsString." FROM Actor".$whereStringConditions;
		
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
	
	public function getMovieActor($constraints) {
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
		$fullQueryString = "SELECT ".$selectColumnsString." FROM MovieActor, Movie".$whereStringConditions;
		
		$results = $this->MySqli->query($fullQueryString);
		//echo $results->affected_rows;
		if(!$results) {
			print_r($this->MySqli->error);
			return -1;
		}
		else {
			return $results;
		}
	}
}

?>