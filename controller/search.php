<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

controller for Search.
constructs the search for movies and actors.
**/
?>

<?php
require_once("../model/mysqlconnect.class.php");
require_once("../model/actor.class.php");
require_once("../model/movies.class.php");

//$actors = new ActorsModel();
//$movies = new MoviesModel();
class SearchController {
	private $actors;
	private $movies;
	
	public function __construct() {
		$this->actors = new ActorsModel();
		$this->movies = new MoviesModel();
	}
	
	public function getActorsSearch($searchQuery) {
			$name = explode(" ", $searchQuery);
			$getRelevantActors = $this->actors->searchActors($name);
			return $getRelevantActors;
		
	}
	
	public function getMoviesSearch($searchQuery) {
			$name = explode(" ", $searchQuery);
			$getRelevantMovies = $this->movies->searchMovies($name);
			return $getRelevantMovies;
	}
}

$search = new SearchController();
if(isset($_GET['search_query']) && $_GET['search_query'] != "") {
	$nosearch = false;
	//$getRelevantActors = -1;
	$getRelevantActors = $search->getActorsSearch($_GET["search_query"]);
	$getRelevantMovies = $search->getMoviesSearch($_GET["search_query"]);
	$searchQuery = $_GET["search_query"];
	unset($_GET["search_query"]);
	include "../view/search.view.php";
}
else {
	$nosearch = true;
	include "../view/search.view.php";
}
?>
