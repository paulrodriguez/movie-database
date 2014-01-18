<?php session_start(); session_regenerate_id(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php
include '../model/destroy_vars.php';
?>
	<title>ADD REVIEW</title>
	
	
	<?php include_once("../model/header.php"); ?>

	<link rel="stylesheet" type='text/css' href="/movies/css/jquery.rating.css" />
	
	<script type='text/javascript' src = '/movies/scripts/jquery.rating.js'></script>

	<script type="text/javascript">
	$(document).ready(function() {
			$('.rating_number').hide();
			$('.star').rating('select',3);
			var menu = new Menu(document.getElementById("main_menu"));
		}
	)
	</script>

	
	<style type='text/css'>
		form td, form{font-size:14pt; color:white}
		body{color:white}
		span.error {color:red}
	</style>
</head>
<body bgcolor="black">

<div class='outer_div'>
		
			
<?php
include_once("menu.php");

?>
<form method="post" action="/movies/controller/review.php">
	<fieldset>
		<legend>ADD REVIEW</legend>
		<table>
			<tr><td>NAME</td><td><input type="text" name='txtReviewer' />
				<span class="error"><?php if(isset($error["username"])) echo $error["username"]; ?></span></td></tr>
			<tr>
				<td>MOVIE</td>
				<td>
					<select name='movieId'>
					<?php
					//prints out all the movies in a select element tag
					while ($row = $listOfMovies->fetch_array()) {
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
					<span class="error">
					<?php if(isset($error["movieid"])) echo $error["movieid"]; ?>
					</span>
				</td>
				
			</tr>
			<tr>
				<td>RATING</td>
				<td>
					<input name="rating" type="radio" class="star" value="1"/><span class="rating_number">1</span> 
					<input name="rating" type="radio" class="star" value="2"/>  <span class="rating_number">2</span> 
					<input name="rating" type="radio" class="star" value="3"/>  <span class="rating_number">3</span> 
					<input name="rating" type="radio" class="star" value="4"/>  <span class="rating_number">4</span> 
					<input name="rating" type="radio" class="star" value="5"/> <span class="rating_number">5</span>

					<span class="error"><?php if(isset($error["rating"])) echo $error["rating"]; ?></span>					
				</td>
			</tr>
			<tr><td></td><td></td></tr>
			<tr><td></td><td></td></tr>
			<tr>
				<td valign="top">COMMENT</td><td><textarea name='txtComment' cols='50' rows='10'></textarea><span class="error"><?php if(isset($error["comment"])) echo $error["comment"]; ?></span>	</td>
			</tr>
			<tr><td><input type="submit" value="Submit Review" name='sbtnMovieReview' /></td></tr>
		</table>
	</fieldset>
</form>
</div><!--end class=outer_div-->
</body>
</html>