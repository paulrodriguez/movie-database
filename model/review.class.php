<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

controller for reviews.
**/
?>
<?php
include_once("mysqlconnect.class.php");
class ReviewModel extends MySqlConnect {
	//private $connection;
	//private $MySqli;
	public function __construct() {
		parent::__construct();
		//$this->connection = new MySqlConnect();
		//$this->MySqli = $this->connection->MySqliReference();
	}
	
	public function __destruct()
    {
		  parent::__destruct();
    }
	
	public function validateReviewData($user, $rating, $comment, $movie) {
		if($this->validateUser($user) == 0) return 0;
		if($this->validateRating($rating) == 0) return 0;
		if($this->validateComment($comment) == 0) return 0;
		return 1;
	
	}
	public function validateUser($user) {
		if ($user == "") return 0;
		return 1;
	}
	
	public function validateRating($rating) {
		if(!is_int($rating) || $rating == "") {
			return 0;
		}
		return 1;
	}
	public function validateComment($comment) {
		if($comment == "")
			return 0;
		else if (preg_match( "/<\/?(\s)*script(\s*)|(.*)>/",$comment))
			return -1;
		return 1;
	}
	public function validateMovieId($movie) {
		if(!is_int($movie) || $movie =="") return 0;
		return 1;
	}
	
	
	
	public function insertReview($user, $rating, $comment, $movie) {
		$insertReviewQuery = "INSERT INTO review (name, mid, rating, comment) VALUES(?,?,?,?)";
		
		if ($stmt = $this->MySqli->prepare($insertReviewQuery)) { 
			$stmt->bind_param("siis",$username,$movie, $rating, $comment);
			if(!$stmt->execute()) {
				printf("Error: %s.\n", $stmt->error);
				die();
				return 0;
			}
			else {
				return 1;
			}
		}
	}
	
	public function getMovieReviews($movieId) {
		$queryString = "SELECT * FROM review WHERE mid=".$movieId;
		
		$results = $this->MySqli->query($queryString);
		if(!$results) {
			return -1;
		}
		else {
			return $results;
		}
 	}
	
	public function getAverageMovieReview($movieId) {
		$queryString = "SELECT AVG(rating) AS avg_rating FROM review WHERE mid=".$movieId;
		$results = $this->MySqli->query($queryString);
		if(!$results) {
			return -1;
		}
		else {
			return $results;
		}
	}
}

?>