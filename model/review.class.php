<?php
include_once("mysqlconnect.class.php");
class ReviewModel extends MySqlConnect {
	private $connection;
	private $MySqli;
	public function __construct() {
		$this->connection = new MySqlConnect();
		$this->MySqli = $this->connection->MySqliReference();
	}
	
	public function __destruct()
    {
		  
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
		if(!is_int($rating) || $rating == "") return 0;
		return 1;
	}
	public function validateComment($comment) {
		return 1;
	}
	public function validateMovie($movie) {
		if(!is_int($movie) || $movie =="") return 0;
		return 1;
	}
	
	public function redirectToReviewPage($movie) {
		$listOfMovies = $this->MySqli->query("SELECT id, title FROM Movie");
		include_once("../view/review.view.php");
	}
	
	public function insertReview($user, $rating, $comment, $movie) {
		$insertReviewQuery = "INSERT INTO Review (name, mid, rating, comment) VALUES(?,?,?,?)";
		
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
}

?>