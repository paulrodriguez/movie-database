<?php
//session_start();
//this class is included in the page that is using it
class Validate {
	private $MySqli;
	public function __construct() {
		$this->MySqli = new mysqli("localhost", "paul", "1790pdbz","movie_db");
	}
	
	public function __destruct()
    {
		$this->MySqli->close();      
    }
	//return 1 if successful, 0 otherwise
	public function checkLogIn() {
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
		$query  = "INSERT INTO user VALUES('".$_POST['txtUsername']."', '".$_POST['txtEmail']."', '".$_POST['txtPwd']."', '".$_POST['txtFirst']."', '".$_POST['txtLast']."')";
		if(!$this->MySqli->query($query)) {
			echo "error message: " . $this->MySqli->error;
		}
		else {
			echo "insertion successful";
		}
	}
	
	public function validatePHP() {
		$iserror = 1;
		if($this->validateUsername($_POST['txtUsername']) == 0) $iserror = 0;
		if($this->validateEmail($_POST['txtEmail']) == 0) $iserror = 0;
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
	
	public function validateEmail($email) {
		$query = $this->MySqli->query("SELECT email FROM User WHERE email='".$email."'");
		if($this->MySqli->affected_rows > 0 || $email =="") {
			$_SESSION['errors']['txtEmail'] = 'email field is empty or email is already in use.';
			return 0;
		}
		if(preg_match("/^(?!.*\.{2})[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/",$email)) {
			$_SESSION['errors']['txtEmail'] = '';
			return 1;
		}
		else {
			$_SESSION['errors']['txtEmail'] = 'email is of incorrect format.';
			return 0;
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