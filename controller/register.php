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
	
	public function showRegisterPage()
	{
		include_once("../view/register.view.php");
	}
	
	public function validateFields($username, $email, $first, $last, $pwd,$confirmpwd)
	{
		$_SESSION['values']['txtUsername'] = $_POST['txtUsername'];
		$_SESSION['values']['txtEmail'] = $_POST['txtEmail'];
		$_SESSION['values']['txtFirst'] = $_POST['txtFirst'];
		$_SESSION['values']['txtLast'] = $_POST['txtLast'];
		$iserror = 1;
		if($this->validator->validateUsername($username) == 0) $iserror = 0;
		if($this->validator->validateEmail($email) <= 0) $iserror = 0;
		if($this->validator->validateFirstname($first) == 0) $iserror = 0;
		if($this->validator->validateLastname($last) == 0) $iserror = 0;
		if($this->validator->validatePassword($pwd, $confirmpwd) == 0) $iserror = 0;
		
		if($iserror == 0)
		{
			$this->showRegisterPage();
		}
		else 
		{
			if($this->validator->insertData() == 1) {
				session_destroy();
				header('Location: /movies');
			}
			else {
				$this->showRegisterPage();
			}
		}
	}
}

$registerController = new RegisterController();
if(isset($_POST["registerbtn"]))
{
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