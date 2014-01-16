<!DOCTYPE html>
<html>
<?php
include 'connect.php';
$con = db_con("movie_db");
?>
<head>
	<title>ACTOR INFO</title>
	<?php include 'header.php'; ?>
	<!--<link rel='stylesheet' type='text/css' href='menu.css'>-->
	<style type='text/css'>
		form td, form, table{font-size:14pt; color:white}
	</style>
</head>
<body bgcolor = 'black'>

<div style = "margin: 0 auto; width:1000px;background-color:black; color:white"> <!--must be included on every page-->
<?php include 'menu.php'; ?>
<form method='get' action="">
	<select name='actor'>
<?php
$actor = "SELECT  id, first, last FROM Actor ORDER BY first, last";
$get_actor = mysqli_query($con,$actor);

while($row = mysqli_fetch_array($get_actor)) {
	$selected='';
	if(isset($_GET['actor']) && $_GET['actor']==$row['id']) {$selected = "selected='selected'";}
	echo "<option value='".$row['id']."' ".$selected.">".$row['first']." " .$row['last']."</option>";
}



?>

	</select>
	<input type='submit' value='SEARCH ACTOR' />
</form>



<?php
if(isset($_GET['actor'])) {
	
	//get the actor info and print it out
	$get_info_actor = mysqli_query($con,"SELECT * FROM Actor WHERE id=".$_GET['actor']."");
	echo "<table>";
	while($row = mysqli_fetch_array($get_info_actor)) {
			echo "
				
				<tr><td>NAME: </td><td>".$row['first']." ".$row['last']."</td></tr>
				<tr><td>SEX: </td><td>".$row['sex']."</td></tr>
				<tr><td>DATE OF BIRTH: </td><td>".$row['dob']."</td></tr>
				<tr><td>DATE OF DEATH: </td><td>".$row['dod']."</td></tr>
				
			";
			
		}
		echo "</table>";
		//get the movies that the actor has appeared in
		$get_movie_in_actor = mysqli_query($con,"SELECT * FROM MovieActor , Movie WHERE mid=id AND aid=".$_GET['actor']."");
		//keep track of how many movies it has appeared in
		$counter = 0;
		//$get_movie_in_actor = mysql_query($actor_in_movie);
		while ($row = mysqli_fetch_array($get_movie_in_actor)) {
			if($counter==0) {
				echo "
				ACTED IN: <br />
				<table>
					<thead><tr><td>MOVIE</td><td>ROLE</td></tr>
					</thead>
				";
			$counter++;
			}
			echo "<tr><td><a style='color:yellow' href='search_movie.php?movie=".$row['id']."'>".$row['title']."</a> (".$row['year'].") </td><td>".$row['role']."</tr></tr>";
		}
		//print if did not appear in any movies
		if ($counter==0) {
			echo "<table><tr><td>this actor has not appeared in any movies</td></tr>";
		}
		echo "</table>";
		
	}

//close connection to database
mysqli_close($con);
?>
<div id='test'>this is a test</div>
</div>
</body>
</html>
