<?php 
session_start(); 
session_regenerate_id();
?>
<!DOCTYPE html>
<html>
<?php
ini_set('display_erros', 'On');
error_reporting(E_ALL);


/*
$testquery = "select * from Actor where first LIKE '%halle%' OR last LIKE '%halle%'";
$testresult =  mysqli_query($con, $testquery);

while($row = mysqli_fetch_array($testresult)) {
	echo $row['first'] . "<br />";
}*/
?>

<head> <title> Search Actor/Actress </title>
	<?php include '../model/header.php'; ?>
	<!--<link rel='stylesheet' type='text/css' href='menu.css'>-->
		<style type="text/css">
			table, b{font-size:14pt; color:white}
		</style>

	</head>
<body>
<div class='outer_div'> <!--must be included on every page-->
<?php

include 'menu.php';

	echo "
	<span> SEARCH RESULTS FOR <b>[".$_GET['search_query']."]</b> :</span>
	<div style='height:30px; width:100%'></div>
	<b>ACTORS</b><br />
	";
	if(!is_int($getRelevantActors)) {
		echo "<table>";
		while($row = $getRelevantActors->fetch_assoc()) {
			echo "<tr><td>".$row['first']. " " . $row['last'] . "</td> <td>(".$row['dob'].")</td><td><a href='search_actor.php?actor=".$row['id']."'>more info</a></td></tr>";
		}
		echo "
		</table>
		<div style='height:30px;width:100%'></div><b>MOVIES</b>
		
		";
	}
	
	if(!is_int($getRelevantMovies)) {
		echo "<table>";
		while($rows = $getRelevantMovies->fetch_assoc()) {

					echo "<tr><td>".$rows['title']."</td><td><a href='search_movie.php?movie=".$rows['id']."'>more info</a></td></tr>";
			}
		echo "</table>";
	}


?>


</div>
</body>
</html>

