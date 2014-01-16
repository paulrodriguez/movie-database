<?php
session_start();
require_once("validate.class.php");
$validator = new Validate();

if($_GET['val'] == 'createaccount') {
	$_SESSION['values']['txtUsername'] = $_POST['txtUsername'];
	$_SESSION['values']['txtEmail'] = $_POST['txtEmail'];
	$_SESSION['values']['txtFirst'] = $_POST['txtFirst'];
	$_SESSION['values']['txtLast'] = $_POST['txtLast'];



	if($validator->validatePHP() == 0) {
		header("Location: ../register.php");
	}
	else {
		$validator->insertData();
		session_destroy();
		header('Location: ../index.php');
		//echo "your info will be saved to the database";
	}
}
else if($_GET['val'] == 'login') {
	//get email
	$_SESSION['valuelogin']['txtEmail'] = $_POST['txtEmail'];
	//if log in successful return to 
	if($validator->checkLogIn() == 1) {
		$_SESSION['user']['login'] = 'yes';
		$_SESSION['user']['email'] = $_POST["txtEmail"];
		header("Location: ../index.php");
	}
	else {
		header('Location: ../login.php');
	}
}



?>