
<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user']['login'])) $_SESSION['user']['login'] = 'no';
if(!isset($_SESSION['user']['email'])) $_SESSION['user']['email'] = '';

//header("Location: controller/search.php");
header("Location: search");
//require();
?>
