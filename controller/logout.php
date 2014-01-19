<?php
session_start();

session_destroy();
$_SESSION['user']['login'] = 'no';
echo "logout test";
header("Location: ../index.php");

?>