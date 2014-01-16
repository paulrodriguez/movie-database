<?php session_start(); session_regenerate_id(); ?>
<!DOCTYPE html>
<html>
<head>
<?php

include '../model/destroy_vars.php';
//include 'model/connect.php';
//$con = db_con("movie_db");
?>
	<title>ADD REVIEW</title>
	
	
	<?php include_once("../model/header.php"); ?>

	<link rel="stylesheet" type='text/css' href="../css/jquery.rating.css" />
	
	<script type='text/javascript' src = '../jquery/jquery.rating.js'></script>

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
include_once("menu.php");

?>
<form method="get" action="/controller/review.php">
	<fieldset>
		<legend>ADD REVIEW</legend>
		<table>
			<tr><td>NAME</td><td><input type="text" name='txtReviewer' /></td></tr>
			<tr>
			<td>MOVIE</td><td>
			<select name='movieId'>
			<?php
			
			//$get_movies = mysqli_query($con,"SELECT id, title FROM Movie");
			while ($row = $listOfMovies->fetch_array()) {
				/*if(isset($_GET['movie']) && is_int($_GET['movie'])) {
					$selected = "";
					if($_GET['movie'] == $row['id']) {
						$selected = "selected='selected'";
					}
				}*/
				if (isset($movie)) {
					$selected = "";
					if($movie == $row['id']) {
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
					<input name="rating" type="radio" class="star" value="1"/><span class="rating_number">1</span> 
					<input name="rating" type="radio" class="star" value="2"/>  <span class="rating_number">2</span> 
					<input name="rating" type="radio" class="star" value="3"/>  <span class="rating_number">3</span> 
					<input name="rating" type="radio" class="star" value="4"/>  <span class="rating_number">4</span> 
					<input name="rating" type="radio" class="star" value="5"/> <span class="rating_number">5</span> 
				</td>
			</tr>
			<tr><td></td><td></td></tr>
			<tr><td></td><td></td></tr>
			<tr><td valign="top">COMMENT</td><td><textarea name='txtComment' cols='50' rows='10'></textarea></td></tr>
			<tr><td><input type="submit" value="Submit Review" name='sbtnMovieReview' /></td></tr>
		</table>
	</fieldset>
</form>
</div>
</body>
</html>