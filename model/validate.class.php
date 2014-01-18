<?php
//session_start();
include_once("mysqlconnect.class.php");
//this class is included in the page that is using it
class Validate {
	public function __construct() {
		parent::__construct();
		//$this->MySqli = new mysqli("localhost", "paul", "1790pdbz","movie_db");
	}
	
	public function __destruct()
    {
		parent::__destruct();   
    }
	//return 1 if successful, 0 otherwise
	public function checkLogIn() {
		if ($this->validateEmail($_POST['txtEmail']) < 0) {
			$_SESSION['errorlogin']['txtEmail'] = 'email is invalid';
			return 0;
		}
	
		$query = $this->MySqli->query("SELECT * FROM user where email='".$_POST['txtEmail']."'");
		if($this->MySqli->affected_rows == 0) {
			$_SESSION['errorlogin']['txtEmail'] = 'there is no account associated with this email.';
			return 0;
		}
		else {
			$_SESSION['errorlogin']['txtEmail'] = '';
			$result = $query->fetch_assoc();
		//	print_r($result);
			//die();
			if($result['password'] != $_POST['txtPwd']) {
				$_SESSION['errorlogin']['txtPwd'] = 'invalid password';
				return 0;
			}
			else {
				$_SESSION['errorlogin']['txtPwd'] = '';
				return 1;
			}
		}
	}
	
	public function insertData() {
		//$query  = "INSERT INTO user VALUES('".$_POST['txtUsername']."', '".$_POST['txtEmail']."', '".$_POST['txtPwd']."', '".$_POST['txtFirst']."', '".$_POST['txtLast']."')";
		$query = "INSERT INTO user VALUES(?,?,?,?,?);";
		if ($stmt = $this->MySqli->prepare($query)) {
			$stmt->bind_param("sssss",$username,$email, $pwd, $first, $last);
			$username = $_POST["txtUsername"];
			$email = $_POST["txtEmail"];
			$pwd = $_POST["txtPwd"];
			$first = $_POST["txtFirst"];
			$last = $_POST["txtLast"];
			//$stmt->execute();
			if(!$stmt->execute()) {
				return 0;
			}
			else {
				return 1;
			}
		}
	}
	
	public function validatePHP() {
		$iserror = 1;
		if($this->validateUsername($_POST['txtUsername']) == 0) $iserror = 0;
		if($this->validateEmail($_POST['txtEmail']) <= 0) $iserror = 0;
		if($this->validateFirstname($_POST['txtFirst']) == 0) $iserror = 0;
		if($this->validateLastname($_POST['txtLast']) == 0) $iserror = 0;
		if($this->validatePassword($_POST['txtPwd'], $_POST['txtConfirmPwd']) == 0) $iserror = 0;
		return $iserror;
	}
	//return 1 if successful, else return 0
	public function validateUsername($username) {
		if($username == "") {
			$_SESSION['errors']['txtUsername'] = 'user name cannot be empty';
			return 0;
		}
		//need to check if the username is not already in the database
		$query = $this->MySqli->query('SELECT userName from User WHERE userName="' . $username . '"');
		if($this->MySqli->affected_rows > 0) {
			$_SESSION['errors']['txtUsername'] = 'user name already in use.';
			return 0;
		}
		else {
			$_SESSION['errors']['txtUsername'] = ''; 
			return 1;
		}
	}
	
	/***
	@$email: takes in the email to validate
	@return: returns 1 if email is in correct format, 0 if email already exists in database or -1 if email is of incorrect format
	
	***/
	public function validateEmail($email) {
		
		
		if(preg_match("/^(?!.*\.{2})[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/",$email)) {
			$_SESSION['errors']['txtEmail'] = '';
			$query = $this->MySqli->query("SELECT email FROM User WHERE email='".$email."'");
			//if email already exists it will return a row
			if($this->MySqli->affected_rows > 0) {
				$_SESSION['errors']['txtEmail'] = 'an account with this email already exists.';
				return 0;
			}
			else {
				return 1;
			}
		}
		else {
			$_SESSION['errors']['txtEmail'] = 'email is of incorrect format.';
			return -1;
		}
	}
	public function validateFirstname($first) {
		if($first == '') {
			$_SESSION['errors']['txtFirst'] = 'first name cannot be empty';
			return 0;
		} else {
			if(preg_match('/^[a-zA-Z]+$/',$first)) {
				$_SESSION['errors']['txtFirst'] = '';
				return 1;
			}
			else {
				$_SESSION['errors']['txtFirst'] = 'first name cannot be empty and must contain letters only.';
				return 0;
			}
		}
	}
	public function validateLastname($last) {
		if($last == '') {
			$_SESSION['errors']['txtLast'] = 'last name cannot be empty';
			return 0;
		} else {
			if(preg_match('/^[a-zA-Z]+$/',$last)) {
				$_SESSION['errors']['txtLast'] = '';
				return 1;
			}
			else {
				$_SESSION['errors']['txtLast'] = 'last name cannot be empty and must contain letters only.';
				return 0;
			}
		}
	}
	
	public function validatePassword($pwd, $confirmPwd) {
		if($pwd != $confirmPwd) {
			$_SESSION['errors']['txtPwd'] = 'passwords do not match';
			return 0;
		}
		else {
			if(strlen($pwd) < 6) {
				$_SESSION['errors']['txtPwd'] = 'password length must be at least 6 characters.';
				return 0;
			}
			else {
				$_SESSION['errors']['txtPwd'] = '';
				return 1;
			}
		}
	}
}

?>