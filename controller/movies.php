<?php
include_once("../model/movies.class.php");
include_once("../model/actor.class.php");
class MoviesController {
	private $movies;
	public function __construct() {
		$this->movies = new MoviesModel();
	}
	
	public function __destruct() {
	
	}
	
	public function outputMovieInfo($movieId) {
		echo "testing";
		return "test";
	}
	
	public function getAllMovies() {
		if(isset($constraints['select'])) unset($constraints['select']);
		if(isset($constraints['where'])) unset($constraints['where']);
		$constraints['select']['id'] = "id";
		$constraints['select']['title'] = "title";
		return $this->movies->getMovie($constraints);
	}
	
	public function displayMoviePage($movieId = -1) {
		$getActorInfo = "Pick  movie.";
		if($movieId != -1) { 
			$getActorInfo = $this->outputMovieInfo($constraints);
		}
		//echo $getActorInfo;
		$getListOfMovies = $this->getAllMovies();
		
		include("../view/movies.view.php");
	}
}

$controller = new MoviesController();

if(isset($_GET["mid"]) && !isset($_GET["ajax"])) {
	$controller->displayMoviePage($_GET["mid"]);
}

else if(isset($_GET["mid"]) && isset($_GET["ajax"])) {
	if($_GET["ajax"] == 1) {
		//do something that will output the code
		echo $controller->outputMovieInfo($_GET["mid"]);
	}
	else {
		echo "the actor could not be found.";
	}
}
else {
	$controller->displayMoviePage();
}
?>