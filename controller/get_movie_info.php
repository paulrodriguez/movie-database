<?php
include '../model/connect.php';
$con = db_con("movie_db");


if(isset($_GET['mid'])) {
	$get_directors = mysqli_query($con,"SELECT * FROM MovieDirector MD, Director D WHERE D.id=MD.did AND MD.mid=".$_GET['mid']."");
	$directors = "";
	
	while($row = mysqli_fetch_array($get_directors)) {
		
		$directors .= $row['first'] . " " . $row['last'] . " ";
	}
	$movieinfo = mysqli_query($con,"SELECT * FROM Movie where id=".$_GET['mid']."");
	$getmovieinfo = mysqli_fetch_array($movieinfo);
	$querymovie=mysqli_query($con,"SELECT * FROM Actor A, MovieActor MA WHERE MA.aid=A.id AND MA.mid=".$_GET['mid']."");
	//$get_mymovie = mysql_query($querymovie);
	//$first = true;
	//while($row = mysql_fetch_assoc($get_mymovie)) {
		//if($first) {
		
			echo "
			
				<table>
				<tr><td>TITLE: </td><td>".$getmovieinfo['title']."</td></tr>
				<tr><td>YEAR: </td><td>".$getmovieinfo['year']."</td></tr>
				<tr><td>RATING: </td><td>".$getmovieinfo['rating']."</td></tr>
				<tr><td>COMPANY: </td><td>".$getmovieinfo['company']."</td></tr>
				<tr><td>DIRECTOR(S): </td><td>".$directors."</td>
				<tr><td colspan='2'>ACTORS</td></tr>
				";
				//print out the actors for the movies
				while($row = mysqli_fetch_array($querymovie)) {
					echo "<tr><td>NAME: <a href='search_actor.php?actor=".$row['aid']."'>".$row['first']." ".$row['last']."</a></td><td> ROLE: ".$row['role']."</td></tr>";
			}
			/*$first=false;
		}
		else {
		echo "<tr><td>NAME: <a href='search_actor.php?actor=".$row['aid']."'>".$row['first']." ".$row['last']."</a> </td><td>ROLE: ".$row['role']."</td></tr>";
		}*/
	

	echo "</table><br /><div>REVIEWS</div>-------------------------------------------";

	$review_query = "SELECT * FROM Review WHERE mid=".$_GET['mid']."";
	$reviews = mysqli_query($con,"SELECT * FROM Review WHERE mid=".$_GET['mid']."");
	$count = mysqli_affected_rows($con);
	if($count == 0) {
			echo "<div style='font-size:14pt'>No reviews for this movie yet. <a style='color:yellow' href='add_review.php?movie=".$_GET['mid']."'>be the first to review</a></div>";
	}
	else {
		$avg = mysqli_query($con, "SELECT AVG(rating) AS avg_rating FROM Review WHERE mid=".$_GET['mid']."");
		$get_avg = mysqli_fetch_array($avg);
		echo "<div style='width:100%'>AVERAGE SCORE: ".round($get_avg['avg_rating'],2)."/5</div>
	          <table></tr>
			  ";
	
		while($row=mysqli_fetch_array($reviews)) {
			echo "<tr><td>REVIEWER NAME: </td><td>".$row['name']."</td><tr>
			<tr><td>DATE: </td><td>".$row['time']."</td></tr>
			<tr><td>RATING: </td><td>".$row['rating']."</td></tr>
			<tr><td>COMMENT: </td><td>".$row['comment']."</td></tr>
			";
		}
		echo "</table>
			<div style='font-size:14pt'><a href='add_review.php?movie=".$_GET['mid']."'>add your own review</a></div>
		";
	
	}
	//$avg = mysqli_query($con, "SELECT AVG(rating) AS avg_rating FROM Review WHERE mid=".$_GET['movie']."");
//	$counter = 0;
	/*
	
	if($rows >0) {
		$get_avg = mysqli_fetch_aarray($avg);
		echo "<div style='width:100%'>AVERAGE SCORE: ".rtrim($get_avg['avg_rating'],'0')."/5</div>
	          <table></tr>
			  ";
	
		while($row=mysqli_fetch_array($reviews)) {
			echo "<tr><td>REVIEWER NAME: </td><td>".$row['name']."</td><tr>
			<tr><td>DATE: </td><td>".$row['time']."</td></tr>
			<tr><td>RATING: </td><td>".$row['rating']."</td></tr>
			<tr><td>COMMENT: </td><td>".$row['comment']."</td></tr>
			";
		}
		echo "</table>
			<div style='font-size:14pt'><a href='add_review.php?movie=".$_GET['movie']."'>add your own review</a></div>
		";
	}
	else {
		echo "<div style='font-size:14pt'>No reviews for this movie yet. <a href='add_review.php?movie=".$_GET['movie']."'>be the first to review</a></div>";
	}*/
	
	
}

mysqli_close($con);
?>