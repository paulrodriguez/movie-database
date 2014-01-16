<?php
require_once("../model/mysqlconnect.class.php");
require_once("../model/actor.class.php");
require_once("../model/movies.class.php");

$actors = new Actor();
$movies = new Movies();
//$conn = new MySqlConnect();
//$mysqli = $conn->MySqliReference();
if(isset($_GET['search_query']) && $_GET['search_query'] != "") {
	$name = explode(" ", $_GET['search_query']);
	
	$getRelevantActors = $actors->searchActors($name);
	$getRelevantMovies = $movies->searchMovies($name);
	include "../view/search.view.php";
}
?>
