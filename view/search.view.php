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

<head> 
	<meta charset="utf-8" />
	<title> Search Actor/Actress </title>
	<?php include '../model/header.php'; ?>
	<!--<link rel='stylesheet' type='text/css' href='menu.css'>-->
		<style type="text/css">
			table, b{font-size:14pt; color:white}
		</style>
		<script type="text/javascript">
	window.onload = function() {
		var menu = new Menu(document.getElementById("main_menu"));
		
	}
	</script>
	</head>
<body>
<div class='outer_div'> <!--must be included on every page-->
<?php

include 'menu.php';
if($nosearch == false) {
?>
<span> SEARCH RESULTS FOR <b><?php echo $searchQuery; ?></b> :</span>
	<div style='height:30px; width:100%'></div>
	<b>ACTORS</b><br />
	<?php
	if(!is_int($getRelevantActors)) {
	?>
	<table>
	<?php	while($row = $getRelevantActors->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $row['first'] . " " . $row['last']; ?> </td> 
			<td>(<?php echo $row['dob']; ?>)</td>
			<td><a href="/movies/actors/<?php echo $row['id']; ?>/">more info</a></td>
		</tr>
	<?php	}//end of while loop ?>

		</table>
		<div style='height:30px;width:100%'></div><b>MOVIES</b>
		
	<?php }//end if ?>
	
	<?php if(!is_int($getRelevantMovies)) { ?>
		<table>
		<?php while($rows = $getRelevantMovies->fetch_assoc()) { ?>

			<tr>
				<td> <?php echo $rows['title']; ?></td><td><a href="/movies/movie/<?php echo $rows['id']; ?>/">more info</a></td>
			</tr>
			<?php } ?>
		</table>
<?php
	}
}

?>

<?php include 'footer.php'; ?>
</div>
</body>
</html>

