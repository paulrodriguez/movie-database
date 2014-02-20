<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

controller for Movies.
allows to retrieve all movies and output information
about a specific movie.
**/
?>

<?php
include_once("../model/movies.class.php");
include_once("../model/actor.class.php");
include_once("../model/review.class.php");
include_once("../model/director.class.php");
class MoviesController {
	private $movies;
	private $actors;
	private $directors;
	private $reviews;
	public function __construct() {
		$this->movies = new MoviesModel();
		$this->actors = new ActorsModel();
		$this->directors = new DirectorModel();
		$this->reviews = new ReviewModel();
	}
	
	public function __destruct() {
	
	}
	
	public function outputMovieInfo($movieId) {
	
		$constraints["where"]["id"]=$movieId;
		$movieResult = $this->movies->getMovie($constraints);
		$returnString = "<table>";
		while ($row = $movieResult->fetch_assoc()) {
			$returnString .= "<tr><td>TITLE: </td><td>".$row['title']."</td></tr>
				<tr><td>YEAR: </td><td>".$row['year']."</td></tr>
				<tr><td>RATING: </td><td>".$row['rating']."</td></tr>
				<tr><td>COMPANY: </td><td>".$row['company']."</td></tr>
				
				<tr><td colspan='2'>ACTORS</td></tr>";
		}
		
		//get the directors of the movie
		$directorResult = $this->directors->getMovieDirectors($movieId);
		while ($row = $directorResult->fetch_assoc()) {
			$returnString .= "<tr><td>DIRECTOR(S): </td><td>".$row["first"]." ".$row["last"]."</td>";
		}
		
		//get the actors in the movie
		$actorResult = $this->actors->getActorsInMovie($movieId);
		while ($row = $actorResult->fetch_assoc()) {
			$returnString .= "<tr><td>NAME: <a href='/movies/controller/actors.php?aid=".$row['aid']."'>".$row['first']." ".$row['last']."</a></td><td> ROLE: ".$row['role']."</td></tr>";
		}
		
		
		
		$returnString .= "</table><br /><div>REVIEWS</div>-------------------------------------------";
		$reviewsResult = $this->reviews->getMovieReviews($movieId);
		if($reviewsResult->num_rows > 0) {
			$averageRating = $this->reviews->getAverageMovieReview($movieId)->fetch_array(MYSQLI_ASSOC);
			$returnString .= "<div style='width:100%'>AVERAGE SCORE: ".round($averageRating['avg_rating'],2)."/5</div>
	          <table></tr>
			  ";
			  
			  while ($row = $reviewsResult->fetch_assoc()) {
			  $returnString .= "<tr><td>REVIEWER NAME: </td><td>".$row['name']."</td><tr>
					<tr><td>DATE: </td><td>".$row['time']."</td></tr>
					<tr><td>RATING: </td><td>".$row['rating']."</td></tr>
					<tr><td>COMMENT: </td><td>".$row['comment']."</td></tr>
					";
			}
			
			$returnString .= "</table>
				<div style='font-size:14pt'><a href='/movies/controller/review.php?mid=".$movieId."'>add your own review</a></div>
				";
		}
		else {
			$returnString .= "
				<div style='font-size:14pt'><a href='/movies/controller/review.php?mid=".$movieId."'>add your own review</a></div>
				";
		}
		return $returnString;
		
	}
	
	public function getAllMovies() {
		if(isset($constraints['select'])) unset($constraints['select']);
		if(isset($constraints['where'])) unset($constraints['where']);
		$constraints['select']['id'] = "id";
		$constraints['select']['title'] = "title";
		return $this->movies->getMovie($constraints);
	}
	
	public function displayMoviePage($movieId = -1) {
		$getMovieInfo = "Pick a  movie.";
		if($movieId != -1) { 
			$getMovieInfo = $this->outputMovieInfo($movieId);
		}
		//echo $getActorInfo;
		$getListOfMovies = $this->getAllMovies();
		
		include "../view/movies.view.php";
	}
}

$moviecontroller = new MoviesController();

if(isset($_GET["mid"]) && !isset($_GET["ajax"])) {
	$moviecontroller->displayMoviePage($_GET["mid"]);
}

else if(isset($_GET["mid"]) && isset($_GET["ajax"])) {
	if($_GET["ajax"] == 1) {
		//do something that will output the code
		echo $moviecontroller->outputMovieInfo($_GET["mid"]);
	}
	else {
		echo "the actor could not be found.";
	}
}
else {
	$moviecontroller->displayMoviePage();
}
?>