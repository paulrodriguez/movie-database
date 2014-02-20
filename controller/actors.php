<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

controller for Actors.
allows to retrieve all actors, and display their info
**/
?>

<?php
include_once("../model/actor.class.php");
include_once("../model/movies.class.php");
class ActorsController {
	private $actor;
	private $movie;
	public function __construct() {
		$this->actor = new ActorsModel();
		$this->movie = new MoviesModel();
	}
	public function __destruct() {
	
	}
	public function getAllActors() {
		if(isset($constaints['select'])) unset($constaints['select']);
		if(isset($constaints['where'])) unset($constaints['where']);
		$constaints['select']['id'] = 'id';
		$constaints['select']['last'] = 'last';
		$constaints['select']['first'] = 'first';
		$constraints['order'] = 'first, last';
		return $this->actor->getActor($constraints);
	}
	
	/****
	this returns an HTML formatted string of the information about an actor
	
	****/
	public function outputActorInfo($actorId) {
		$actorResult = "";
		$constraints['where']['id'] = $actorId;
		//get the info for the actor
		$getActorInfo = $this->actor->getActor($constraints);
		
		if(isset($constraints['where'])) unset($constraints['where']);
		$constraints['where']['mid'] = 'id';
		$constraints['where']['aid'] = $actorId;
		//get the movies the actor has been in 
		$getMovieActorInfo = $this->movie->getMovieActor($constraints);
		$totalMoviesActed= $this->movie->rownum();
		if((!is_int($getActorInfo) && !is_int($getMovieActorInfo))) {
			$actorResult .= "<table>";
			while ($row = $getActorInfo->fetch_assoc()) {
				//while($row = mysqli_fetch_array($get_info_actor)) {
				$actorResult .= "
				
				<tr><td>NAME: </td><td>".$row['first']." ".$row['last']."</td></tr>
				<tr><td>SEX: </td><td>".$row['sex']."</td></tr>
				<tr><td>DATE OF BIRTH: </td><td>".$row['dob']."</td></tr>
				<tr><td>DATE OF DEATH: </td><td>".$row['dod']."</td></tr>	
				";
			}
			$actorResult .= "</table>";
			if($totalMoviesActed > 0) {
				$actorResult .= "
					ACTED IN: <br />
					<table>
						<thead><tr><td>MOVIE</td><td>ROLE</td></tr>
						</thead>
				";
				
				
				while ($row = $getMovieActorInfo->fetch_assoc()) {
				//while($row = mysqli_fetch_array($get_info_actor)) {
					$actorResult .= "
						<tr><td><a style='color:yellow' href='/movies/controller/movies.php?mid=".$row['id']."'>".$row['title']."</a> (".$row['year'].") </td><td>".$row['role']."</tr></tr>";
				}
				$actorResult .= "</table>";
			}
			else {
				$actorResult .= "<table><tr><td>this actor has not appeared in any movies</td></tr></table>";
			}
			return $actorResult;
		}
		
		else {
			return "failed to load correct info.";
		}
	}
	
	
	public function displayPage($constraints = -1) {
		$getActorInfo = "Pick an actor to see their profile.";
		if($constraints != -1) { 
			$getActorInfo = $this->outputActorInfo($constraints);
		}
		//echo $getActorInfo;
		$getListOfActors = $this->getAllActors();
		
		include("../view/actors.view.php");
	}
}

$controller = new ActorsController();

if(!isset($_GET["ajax"]) && isset($_GET["aid"])) {
	//echo "first if statement"
	$controller->displayPage($_GET["aid"]);
	
}
else if(isset($_GET["aid"]) && isset($_GET["ajax"])) {
	if($_GET["ajax"] == 1) {
		//do something that will output the code
		echo $controller->outputActorInfo($_GET["aid"]);
	}
	else {
		echo "the actor could not be found.";
	}
}
else {
$controller->displayPage();
}

?>