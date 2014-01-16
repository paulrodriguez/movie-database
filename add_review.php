<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<?php
include 'model/destroy_vars.php';
include 'model/connect.php';
$con = db_con("movie_db");
?>
	<title>ADD REVIEW</title>
	
	
	
	<?php include 'model/header.php'; ?>
	
	<link rel="stylesheet" type='text/css' href="css/jquery.rating.css" />
	
	<script type='text/javascript' src = 'jquery/jquery.rating.js'></script>

	<script type="text/javascript">
	$(document).ready(function() {
			$('.rating_number').hide();
			$('.star').rating('select',3);
		}
	)
	</script>
	
	<style type='text/css'>
		form td, form{font-size:14pt; color:white}
		body{color:white}
	</style>
</head>
<body bgcolor="black">

<div class='outer_div'>
		
			
<?php
include "view/menu.php";

if(isset($_GET['moviereview'])) {
	extract($_GET);
	$error = "";
	if($reviewname=="") {
		$error .= "you must enter your name<br />";
	}
	if($star1=="") {
		$error .= "please select a rating<br />"; 
	}
	if($comment=="") {
		$error .= "you must enter your comment<br />";
	}
	//no errors so we can insert into table
	if($error == "") {
		$insert_query = "INSERT INTO Review VALUES('$reviewname', NOW(), '$movie', '$star1', '$comment')";
		if(!mysqli_query($con,$insert_query)) {
			echo "<b style='color:yellow; font-size:14pt'>your comments could not be inserted because of the following: <br />". mysqli_error($con);
		}
		else {
			unset($_POST);
			echo "<b style='color:yellow; font-size:14pt'>'$reviewname', your review was added successfully</b>";
		}
	}
	else {echo "<b style='color:yellow; font-size:14pt'>".$error."</b>";}

}
?>
<form method="get" action="add_review.php">
	<fieldset>
		<legend>ADD REVIEW</legend>
		<table>
			<tr><td>NAME</td><td><input type="text" name='reviewname' /></td></tr>
			<tr>
			<td>MOVIE</td><td>
			<select name='movie'>
			<?php
			
			$get_movies = mysqli_query($con,"SELECT id, title FROM Movie");
			while ($row = mysqli_fetch_array($get_movies)) {
				if(isset($_GET['movie'])) {
					$selected = "";
					if($_GET['movie'] == $row['id']) {
						$selected = "selected='selected'";
					}
				}
				echo "<option value='".$row['id']."' $selected>".$row['title']."</option>";
			}
			?>

			</select>
			</td>
			</tr>
			<tr><td>RATING</td>
				<td>
					<input name="star1" type="radio" class="star" value="1"/><span class="rating_number">1</span> 
					<input name="star1" type="radio" class="star" value="2"/>  <span class="rating_number">2</span> 
					<input name="star1" type="radio" class="star" value="3"/>  <span class="rating_number">3</span> 
					<input name="star1" type="radio" class="star" value="4"/>  <span class="rating_number">4</span> 
					<input name="star1" type="radio" class="star" value="5"/> <span class="rating_number">5</span> 
				</td>
			</tr>
			<tr><td></td><td></td></tr>
			<tr><td></td><td></td></tr>
			<tr><td valign="top">COMMENT</td><td><textarea name='comment' cols='50' rows='10'></textarea></td></tr>
			<tr><td><input type="submit" value="Submit Review" name='moviereview' /></td></tr>
		</table>
	</fieldset>
</form>
</div>
</body>
<?php mysqli_close($con); ?>
</html>