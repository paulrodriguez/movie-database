<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

model for movies.
**/
?>
<?php
include_once("mysqlconnect.class.php");

class MoviesModel extends MySqlConnect{
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
	
	public function rownum() {
		return $this->MySqli->affected_rows;
	}
	
	
	public function getMovie($constraints) {
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
		$fullQueryString = "SELECT ".$selectColumnsString." FROM movie".$whereStringConditions;
		
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

	/*****
	gets all the movies for an actor, or all the actors in a movie
	@param $constaints: the constraints for the select clause and where clause
	@return: returns the reference to the query, or 
	*****/
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
		$fullQueryString = "SELECT ".$selectColumnsString." FROM movieactor, movie".$whereStringConditions;
		
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
	
	public function searchMovies($constraints) {
		$query = "SELECT id, title FROM movie WHERE ";
		$size = sizeof($constraints);	
			for($i=0;$i<$size;$i++) {
				
					if($i!=$size-1) {
						$query .= "title LIKE '%".$constraints[$i]."%' OR ";
					}
					else {
						$query .= "title LIKE '%".$constraints[$i]."%'";
					}
				}
		$results = $this->MySqli->query($query);
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