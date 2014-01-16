<?php
if(isset($_SESSION['values']['txtUsername'])) {unset($_SESSION['values']['txtUsername']);}
if(isset($_SESSION['values']['txtEmail'])) {unset($_SESSION['values']['txtEmail']);}
if(isset($_SESSION['values']['txtFirst'])) {unset($_SESSION['values']['txtFirst']);}
if(isset($_SESSION['values']['txtLast'])) {unset($_SESSION['values']['txtLast']);}

if(isset($_SESSION['errors']['txtUsername'])) {unset($_SESSION['errors']['txtUsername']);}
if(isset($_SESSION['errors']['txtEmail'])) {unset($_SESSION['errors']['txtEmail']);}
if(isset($_SESSION['errors']['txtPwd'])) {unset($_SESSION['errors']['txtPwd']);}
if(isset($_SESSION['errors']['txtFirst'])) {unset($_SESSION['errors']['txtFirst']);}
if(isset($_SESSION['errors']['txtLast'])) {unset($_SESSION['errors']['txtLast']);}

?>