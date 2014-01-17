<?php session_start(); session_regenerate_id(); ?>
<!DOCTYPE html>
<html>
<?php
include '../model/destroy_vars.php';
include '../model/connect.php';

if(isset($_GET['movie'])) {$onload = "onload='processMovie();'";} 
?>
<head>
	<title>MOVIE INFO</title>
	<?php include '../model/header.php'; ?>
	<script type='text/javascript' src='/movies/javascript/process.js'></script>
	<!--<link rel='stylesheet' type = 'text/css' href='menu.css'>-->
	<style type='text/css'>
		form td, form, table {font-size:14pt; color:white}
		body{color:white}
		</style>
</head>
<body bgcolor="black">

	<div class ='outer_div'> <!--must be included on every page-->
		
<?php
	include 'menu.php';

?>
	<form action="">
		<select name='mid' id='movie'>
<?php
//$get_movie = mysqli_query($con,"select id,title from Movie");
/*
while($row = mysqli_fetch_array($get_movie)) {
	$selected='';
	if(isset($_GET['movie']) && $_GET['movie']==$row['id']) {$selected="selected='selected'";}
	echo "<option value='".$row['id']."' $selected>".$row['title']."</option>";
}*/
	
	while ($row = $getListOfMovies->fetch_assoc()) {
	?>
	<option value="<?php echo $row["id"]; ?>"><?php echo $row["title"]; ?></option>
	<?php
	}
?>
</select>
<input type='button' onclick='processMovie();' value='SEARCH MOVIE' />
</form>
<div id='movieInfo'></div>

</div><!--end of class=outer_div-->
</body>

</html>