<?php
session_start();
if(!isset($_SESSION['user']['login'])) $_SESSION['user']['login'] = 'no';
if(!isset($_SESSION['user']['email'])) $_SESSION['user']['email'] = '';
header("Location: search.php");

?>