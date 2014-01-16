<?php
require_once("../model/movies.class.php");
//include '../model/connect.php';
//$con = db_con("movie_db");
$movies = new Movies();

if(isset($_GET["aid"])) {
	//get the actor info and print it out
	$constraints['where']['id'] = $_GET['aid'];
	$constraints['table'] = "Actor";
	$get_info_actor = $movies->getActor($constraints);
	//mysqli_query($con,"SELECT * FROM Actor WHERE id=".$_GET['aid']."");
	
	echo "<table>";
	if(!is_int($get_info_actor)) {
		while ($row = $get_info_actor->fetch_assoc()) {
		//while($row = mysqli_fetch_array($get_info_actor)) {
			echo "
				
				<tr><td>NAME: </td><td>".$row['first']." ".$row['last']."</td></tr>
				<tr><td>SEX: </td><td>".$row['sex']."</td></tr>
				<tr><td>DATE OF BIRTH: </td><td>".$row['dob']."</td></tr>
				<tr><td>DATE OF DEATH: </td><td>".$row['dod']."</td></tr>	
			";
		}
	}
		
	echo "</table>";
	
	if(isset($constraints['where'])) unset($constraints['where']);
	
	$constraints['where']['mid'] = 'id';
	$constraints['where']['aid'] = $_GET["aid"];
	
	$getMovieActorInfo = $movies->getMovieActor($constraints);
	
		
	if(!is_int($getMovieActorInfo)) {
		if($movies->getMySqliReference()->affected_rows > 0) {
			echo "
				ACTED IN: <br />
				<table>
					<thead><tr><td>MOVIE</td><td>ROLE</td></tr>
					</thead>
				";
			
			while ($row = $getMovieActorInfo->fetch_assoc()) {
				echo "<tr><td><a style='color:yellow' href='search_movie.php?movie=".$row['id']."'>".$row['title']."</a> (".$row['year'].") </td><td>".$row['role']."</tr></tr>";
			}
			echo "</table>";
		}
		else {
			echo "<table><tr><td>this actor has not appeared in any movies</td></tr></table>";
		}
	}
		

}

?>