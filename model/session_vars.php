<?php


if(!isset($_SESSION['values']['txtUsername'])) {$_SESSION['values']['txtUsername'] = '';}
if(!isset($_SESSION['values']['txtEmail'])) {$_SESSION['values']['txtEmail'] = '';}
if(!isset($_SESSION['values']['txtFirst'])) {$_SESSION['values']['txtFirst'] = '';}
if(!isset($_SESSION['values']['txtLast'])) {$_SESSION['values']['txtLast'] = '';}

if(!isset($_SESSION['errors']['txtUsername'])) {$_SESSION['errors']['txtUsername'] = '';}
if(!isset($_SESSION['errors']['txtEmail'])) {$_SESSION['errors']['txtEmail'] = '';}
if(!isset($_SESSION['errors']['txtPwd'])) {$_SESSION['errors']['txtPwd'] = '';}
if(!isset($_SESSION['errors']['txtFirst'])) {$_SESSION['errors']['txtFirst'] = '';}
if(!isset($_SESSION['errors']['txtLast'])) {$_SESSION['errors']['txtLast'] = '';}

?>