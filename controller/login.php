<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

controller for Login.
validates user when they want to log in to their account
**/
?>

<?php
session_start();
session_regenerate_id();
//if(!isset($_SESSION['valuelogin']['txtEmail'])) $_SESSION['valuelogin']['txtEmail'] = '';

$_SESSION['errorlogin']['txtEmail'] = '';
$_SESSION['errorlogin']['txtPwd'] = '';
include_once("../model/validate.class.php");

class LoginController 
{
	private $validator;
	public function __construct() 
	{
		$this->validator = new Validate();
	}
	public function __destruct() 
	{
	
	}
	
	public function logIn() 
	{
	$email = $_POST["txtEmail"];
	//$_SESSION['valuelogin']['txtEmail'] = $_POST['txtEmail'];
	//if log in successful return to  main page
	//if($validator->validateEmail($_POST["txtEmail"]) == 1)
	//login successful
	if($this->validator->checkLogIn() == 1) {
		$_SESSION['user']['login'] = 'yes';
		$_SESSION['user']['email'] = $_POST["txtEmail"];
		//$_SESSION['user']['uName'] = 
		$_SESSION['timeout'] = time();
		unset($_SESSION['valuelogin']);
		unset($_SESSION['errorlogin']);
		header("Location: ../index.php");
	}
	else {
		include("../view/login.view.php");
	}
	}
}

$login = new LoginController();

if(isset($_POST["login"]))
	$login->logIn();
else
	include("../view/login.view.php");
?>