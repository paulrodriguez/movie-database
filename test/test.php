

<?php 
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//header("content-type:text/xml");
//echo "<test>test</test>";
header('WWW-Authenticate: Basic realm="Test Authentication System"'); 
header('HTTP/1.0 401 Unauthorized');
echo "test";

?>
