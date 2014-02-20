<?php
/**
Author:          Paul Rodriguez
Created:         Around January, 2014
Last Updated:  2/20/214

this view page is the default page of movies database website.
it shows only the menu or if the user made a search. then it will
show the results of that search.

**/
?>
<?php session_start(); session_regenerate_id(); ?>
<!DOCTYPE html>
<html>
<?php
include '../model/destroy_vars.php';
include '../model/connect.php';
?>
<head>
	<title>MOVIE INFO</title>
	<?php include '../model/header.php'; ?>
	<script type='text/javascript' src='/movies/scripts/process.js'></script>
	<!--<link rel='stylesheet' type = 'text/css' href='menu.css'>-->
	<style type='text/css'>
		form td, form, table {font-size:14pt; color:white}
		body{color:white}
	</style>
	<script type="text/javascript">
		window.onload = function() {
			var menu = new Menu(document.getElementById("main_menu"));
			document.getElementById("getMovie").style.display = "block";
		}
	</script>
</head>
<body bgcolor="black">

	<div class ='outer_div'> <!--must be included on every page-->
		
<?php
	include 'menu.php';

?>
	<form action="" id="getMovie">
		<select name='mid' id='movie'>
<?php
	
	while ($row = $getListOfMovies->fetch_assoc()) {
	?>
			<option value="<?php echo $row["id"]; ?>"><?php echo $row["title"]; ?></option>
	<?php
	}
?>
		</select>
		<input type='button' onclick='processMovie();' value='SEARCH MOVIE' />
	</form>
	
	<div id='movieInfo'><?php echo $getMovieInfo; ?></div>

</div><!--end of class=outer_div-->
</body>

</html>