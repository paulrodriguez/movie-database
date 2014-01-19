<?php 
//error_reporting(E_ERROR | E_WARNING);
require_once("../model/session_vars.php");

 ?>
<!DOCTYPE html>
<html>
<?php
//ini_set('display_erros', 'On');
//error_reporting(E_ALL);
//phpinfo();
//include '..model/connect.php';
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
<form method="post" action="/movies/controller/register.php">

<table>
	<tr>
		<td>User name:</td>
		<td><input type='text' class='txt' id='txtUsername' name='txtUsername' value="<?php echo $_SESSION['values']['txtUsername']; ?>"/><span class='error'><?php echo $_SESSION['errors']['txtUsername'];?></span></td>
	</tr>
	<tr>
		<td>First name:</td>
		<td><input type='text' class='txt' id="txtFirst" name="txtFirst" value="<?php echo $_SESSION['values']['txtFirst'];?>"/><span class='error'><?php echo $_SESSION['errors']['txtFirst'];?></span></td>
	</tr>
	<tr>
		<td>Last name:</td>
		<td><input type='text' class='txt' id="txtLast" name="txtLast" value="<?php echo $_SESSION['values']['txtLast'];?>" /><span class='error'><?php echo $_SESSION['errors']['txtLast'];?></span> </td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><input type='text' class='txt' id="txtEmail" name="txtEmail" value="<?php echo $_SESSION['values']['txtEmail'];?>"/><span class='error'><?php echo $_SESSION['errors']['txtEmail'];?></span> </td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" class='txt' id="txtPwd" name="txtPwd" value=""/><span class='error'><?php echo $_SESSION['errors']['txtPwd'];?></span></td>
	</tr>
	<tr>
		<td>Confirm Password:</td>
		<td><input type="password" class='txt' id="txtConfirmPwd" name="txtConfirmPwd" value=""/></td>
	</tr>
</table>
<!--
<label for="txtUsername"> User name: </label>
<input type='text' id='txtUsername' name='txtUsername' value="<?php echo $_SESSION['values']['txtUsername']; ?>"/> <br />
<label for="txtFirst"> First name: </label>
<input type='text' id="txtFirst" name="txtFirst" value="<?php echo $_SESSION['values']['txtFirst'];?>"/> <br />
<label for="txtLast"> Last name: </label>
<input type='text' id="txtLast" name="txtLast" value="<?php echo $_SESSION['values']['txtLast'];?>"/> <br />
<label for="txtEmail">email:</label>
<input type='text' id="txtEmail" name="txtEmail" value="<?php echo $_SESSION['values']['txtEmail'];?>"/> <br />
<label for="txtPwd">Password:</label>
<input type="password" id="txtPwd" name="txtPwd" value=""/> <br />
<label for="txtConfirmPwd">Confirm Password:</label>
<input type="password" id="txtConfirmPwd" name="txtConfirmPwd" value=""/> <br />-->
<input class='left' type="submit" name="registerbtn" value="REGISTER" />
</form>
</fieldset>
</div>
</body>

</html>