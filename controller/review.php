<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

controller for Reviews.
allows to retrieve reviews from a movie and add a review
to a movie.
**/
?>

<?php
include_once("../model/review.class.php");
include_once("../model/movies.class.php");
class ReviewController {
	private $reviews;
	private $movies;
	public $errors;
	public function __construct() {
		$this->reviews = new ReviewModel();
		$this->movies = new MoviesModel();
	}
	
	public function __destruct() {
	
	}
	public function validateNewReview($txtReviewer, $rating, $txtComment, $movieId) {
		if(isset($this->errors)) unset($this->errors);
		$returnValue = 1;
		if($this->reviews->validateUser($txtReviewer) == 0) {
			$this->errors["username"] = " username is empty";
			$returnValue = 0;
		}
		if($this->reviews->validateRating($rating) == 0) {
			$this->errors["rating"] ="the rating must be chosen";
			$returnValue = 0;
		}
		if ($this->reviews->validateMovieId($movieId) == 0) {
			$this->errors["movieid"] ="this movie does not exist";
			$returnValue = 0;
		}
		
		if($this->reviews->validateComment($txtComment) ==0) {
			$this->errors["comment"] ="comment is invalid";
			$returnValue = 0;
		} 
		else if($this->reviews->validateComment($txtComment) == -1) {
			$this->errors["comment"] ="script tags and html tags are not allowed";
			$returnValue = 0;
		}
		
		
		return $returnValue;
		
	}
	public function redirectToReviewPage($movie =null, $error="") {
		$listOfMovies = $this->movies->getMovie(null);
		include_once("../view/review.view.php");
	}
}
$reviews = new ReviewController();
//if user submitted review
if(isset($_POST['sbtnMovieReview'])) {
	extract($_POST);

	if($reviews->validateNewReview($txtReviewer, intval($rating), $txtComment, intval($movieId)) == 0) {
		$error = "there was an error with your inputs. movieId: ".$movieId;
		//echo $error;
		$reviews->redirectToReviewPage($movieId,$reviews->errors);
	}
	else {
		echo "data was correct.";
	}
}
else if(isset($_GET["mid"])) {
	$reviews->redirectToReviewPage($_GET["mid"]);
}
else {
	//if(isset($_GET["movie"])) $movieId = $_GET["movie"]
	$reviews->redirectToReviewPage();
	//include_once("../add_review.php");
}
?>