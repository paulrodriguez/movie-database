<?php
session_start();
session_regenerate_id();
require_once("../model/validate.class.php");

class RegisterController 
{
	private $validator;
	public function __construct() 
	{
		$this->validator = new Validate();
	}
	public function __destruct()
	{
	
	}
	
	public function showRegisterPage($user='', $email='', $first='', $last='')
	{
		include_once("../view/register.view.php");
	}
	
	public function validateFields($txtUsername, $txtEmail, $firstName, $lastName, $pwd,$confirmpwd)
	{
		$user = $txtUsername;
		$email = $txtEmail;
		$first = $firstName;
		$last = $lastName;
		$iserror = 1;
		if($this->validator->validateUsername($txtUsername) == 0) $iserror = 0;
		if($this->validator->validateEmail($txtEmail) <= 0) $iserror = 0;
		if($this->validator->validateFirstname($firstName) == 0) $iserror = 0;
		if($this->validator->validateLastname($lastName) == 0) $iserror = 0;
		if($this->validator->validatePassword($pwd, $confirmpwd) == 0) $iserror = 0;
		unset($_POST);
		if($iserror == 0)
		{
			//echo "there were errors with the fields";
			$this->showRegisterPage($user, $email, $first, $last);
		}
		else 
		{
			if($this->validator->insertData($user,$email,$first,$last,$pwd) == 1) {
				session_destroy();
				header('Location: /movies');
			}
			else {
			     echo "error with inserting data";
				$this->showRegisterPage();
			}
		}
	}
}

$registerController = new RegisterController();
if(isset($_POST["registerbtn"]))
{
	//echo "trying to register";
	$registerController->validateFields(
		$_POST['txtUsername'], 
		$_POST['txtEmail'], 
		$_POST['txtFirst'], 
		$_POST['txtLast'], 
		$_POST["txtPwd"], 
		$_POST["txtConfirmPwd"]
	);
} else {
	//echo "did not click register";
	unset($_SESSION["errors"]);
	$registerController->showRegisterPage();
}