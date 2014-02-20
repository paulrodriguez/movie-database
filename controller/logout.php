<?php
/**
Author:           Paul Rodriguez
Created:          Around February, 2014.
Last Updated:  2/20/2014

destroys session information about the user.
redirect to home page.
**/
?>

<?php
session_start();

session_destroy();
$_SESSION['user']['login'] = 'no';
echo "logout test";
header("Location: ../index.php");

?>