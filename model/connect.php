<?php
function db_con($database) {
	//added the '@' sign to suppress warnings in case database connection failed
	$con = @mysqli_connect('localhost' , 'paul', '1790pdbz', $database);
	if(@mysqli_connect_errno($con)) {
		include("/view/db_error.php");
		die();
		//die("coult not connect: " . mysqli_connect_error());
		//die("could not connect: " . mysqli_connect_error());
	}
	return $con;	
}
?>
