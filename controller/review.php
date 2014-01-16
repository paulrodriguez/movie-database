<?php
require_once("../model/review.class.php");

$reviews = new Review();
//if user submitted review
if(isset($_GET['sbtnMovieReview'])) {
	extract($_GET);
	if($reviews->validateReviewData($txtReviewer, $rating, $txtComment, $movieId) == 1) {
		$error = "could not add to review to the database";
		include_once("../view/review.view.php");
	}
}
else {
	$movieId = "";
	//if(isset($_GET["movie"])) $movieId = $_GET["movie"]
	$reviews->redirectToReviewPage($movieId);
	//include_once("../add_review.php");
}
?>