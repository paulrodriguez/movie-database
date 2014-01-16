<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php
ini_set('display_erros', 'On');
error_reporting(E_ALL);
//phpinfo();
include 'model/connect.php';
//connect to database. function is in 'connect.php'
$con = db_con("movie_db");
/*
$testquery = "select * from Actor where first LIKE '%halle%' OR last LIKE '%halle%'";
$testresult =  mysqli_query($con, $testquery);

while($row = mysqli_fetch_array($testresult)) {
	echo $row['first'] . "<br />";
}*/
?>

<head> <title> Search Actor/Actress </title>
	<?php include 'model/header.php'; ?>
	<!--<link rel='stylesheet' type='text/css' href='menu.css'>-->
		<style type="text/css">
			table, b{font-size:14pt; color:white}
		</style>

	</head>
<body>
<div class='outer_div'> <!--must be included on every page-->
<?php

include 'view/menu.php';

if(isset($_GET['search_query']) && $_GET['search_query'] != "") {
	$name = explode(" ", $_GET['search_query']);
	$size = sizeof($name);
	$query = "select id, first, last, dob FROM Actor where ";
	for($i = 0; $i < $size; $i++) {
		if($i != $size-1) {
			echo "counter: " . $i. "<br />";
			$query .="first LIKE '%".$name[$i]."%' OR last LIKE '%".$name[$i]."%' OR ";		
		}
		else {
			$query .= "first LIKE '%".$name[$i]."%' OR last LIKE '%".$name[$i]."%' ";
		}
		
	}
	$query .= "ORDER BY first, last";
	//echo "query: " . $query . "<br />";
	$result = mysqli_query($con, $query);
	echo "
	<span> SEARCH RESULTS FOR <b>[".$_GET['search_query']."]</b> :</span>
	<div style='height:30px; width:100%'></div>
	<b>ACTORS</b><br />
	<table>
	";
	while($row = mysqli_fetch_array($result)) {
		echo "<tr><td>".$row['first']. " " . $row['last'] . "</td> <td>(".$row['dob'].")</td><td><a href='search_actor.php?actor=".$row['id']."'>more info</a></td></tr>";
	}
	echo "
	</table>
	<div style='height:30px;width:100%'></div><b>MOVIES</b>
	
	";
	$query_movie = "SELECT id, title FROM Movie WHERE ";
			
			for($i=0;$i<$size;$i++) {
				
					if($i!=$size-1) {
						$query_movie .= "title LIKE '%".$name[$i]."%' OR ";
					}
					else {
						$query_movie .= "title LIKE '%".$name[$i]."%'";
					}
				}
	$result_movie = mysqli_query($con, $query_movie);
	echo "<table>";
	while($rows = mysqli_fetch_array($result_movie)) {

				echo "<tr><td>".$rows['title']."</td><td><a href='search_movie.php?movie=".$rows['id']."'>more info</a></td></tr>";
		}
		echo "</table>";
}
//endif

?>

<?php mysqli_close($con); ?>
</div>
</body>
</html>

