<?php session_start(); session_regenerate_id(); ?>
<!DOCTYPE html>
<html>
<?php
include 'model/destroy_vars.php';
require_once("/model/movies.class.php");
$movies = new Movies();
//include '/model/connect.php';
//$con = db_con("movie_db");
$onload = "";
//if an actor id is in url when we get here, then get that actor info
//if(isset($_GET['actor'])) {$onload = "onload='processActor();'";}
?>
<head>
	<title>ACTOR INFO</title>
	<?php include '/model/header.php'; ?>
	<!--<link rel='stylesheet' type='text/css' href='menu.css'>-->
	<style type='text/css'>
		form td, form, table{font-size:14pt; color:white}
		#getActors {display:none;}
	</style>
	
	<!--the script that contains the code to obtain stuff from the database-->
<script type='text/javascript' src='javascript/process.js'></script>

<script type="text/javascript">
	window.onload = function() {
		
		<?php if(isset($_GET['actor'])) { ?>processActor(); <?php }?>
		document.getElementById("getActors").style.display = "block";
	}
</script>
</head>
<body bgcolor = 'black' <?php echo $onload; ?> >

<div style = "margin: 0 auto; width:1000px;background-color:black; color:white"> <!--must be included on every page-->
<?php include '/view/menu.php'; ?>
<form action="" id="getActors">
	<select name='actor' id='actor'>
<?php
$constaints['select']['id'] = 'id';
$constaints['select']['last'] = 'last';
$constaints['select']['first'] = 'first';
$constraints['order'] = 'first, last';
//$constraints['table'] = "Actor";
$getListOfActors = $movies->getActor($constraints);
//$actor = "SELECT  id, first, last FROM Actor ORDER BY first, last";
//$get_actor = mysqli_query($con,$actor);
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
 <div id='actorInfo'></div>



</div>
<?php //mysqli_close($con); ?>
</body>
</html>
