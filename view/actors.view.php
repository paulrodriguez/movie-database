<?php session_start(); session_regenerate_id(); ?>
<!DOCTYPE html>
<html>
<?php
include '../model/destroy_vars.php';
//include_once("/movies/controller/actors.php");
//$movies = new Movies();
//include '/model/connect.php';
//$con = db_con("movie_db");
//$onload = "";
//if an actor id is in url when we get here, then get that actor info
//if(isset($_GET['actor'])) {$onload = "onload='processActor();'";}
?>
<head>
	<meta charset="utf-8" />
	<title>ACTOR INFO</title>
	<?php include '../model/header.php'; ?>
	<!--<link rel='stylesheet' type='text/css' href='menu.css'>-->
	<style type='text/css'>
		form td, form, table{font-size:14pt; color:white}
		#getActors {display:none;}
	</style>
	
	<!--the script that contains the code to obtain stuff from the database-->
<script type='text/javascript' src='/movies/scripts/process.js'></script>

<script type="text/javascript">
	window.onload = function() {
		var menu = new Menu(document.getElementById("main_menu"));
		document.getElementById("getActors").style.display = "block";
	}
</script>
</head>
<body bgcolor = 'black'>

<div style = "margin: 0 auto; width:1000px;background-color:black; color:white"> <!--must be included on every page-->
<?php include 'menu.php'; ?>
<form action="" id="getActors">
	<select name='actor' id='actor'>
<?php
if(!is_int($getListOfActors)) {
	while($row = $getListOfActors->fetch_assoc()) {
		$selected='';
		if(isset($_GET['actor']) && $_GET['actor']==$row['id']) {$selected = "selected='selected'";}
		echo "<option value='".$row['id']."' ".$selected.">".$row['first']." " .$row['last']."</option>";
	}
}


?>

	</select>
	<input type='button' onclick='processActor();' value='SEARCH ACTOR' />
</form>
 <div id='actorInfo'><?php echo $getActorInfo; ?></div>



</div>
</body>
</html>
