<?php 

//error_reporting(E_ERROR | E_WARNING);


 ?>
<!DOCTYPE html>
<html>
<?php
//ini_set('display_erros', 'On');
//error_reporting(E_ALL);
//phpinfo();
//include 'model/connect.php';
?>

<head> <title> Search Actor/Actress </title>
	<?php include '../model/header.php'; ?>
	<link rel='stylesheet' type='text/css' href="/movies/css/register.css">
</head>
<body>
<div class='outer_div'> <!--must be included on every page-->
<?php

include 'menu.php';

?>
<fieldset>
<form method="post" action="/movies/controller/login.php">
	<table>
		<tr>
			<td>Email:</td>
			<td><input type='text' class='txt' name='txtEmail' id='txtEmail' value="<?php echo $email;?>"/><span class='error'><?php echo $_SESSION['errorlogin']['txtEmail'];?></span></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type='password' class='txt' name='txtPwd' id='txtPwd' value='' /><span class='error'><?php echo $_SESSION['errorlogin']['txtPwd'];?></span></td>
		</tr>
		
	</table>
	<input class='loginsubmit' name="login" type="submit" value="Log In" />
</form>
</body>
</html>