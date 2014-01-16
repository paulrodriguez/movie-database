<html>
<?php
error_reporting(E_ALL);
?>
<head> <title> Search Actor/Actress </title>
	<?php include 'model/header.php'; ?>
	<!--<link rel='stylesheet' type='text/css' href='menu.css'>-->
		<style type="text/css">
			table, b{font-size:14pt; color:white}
		</style>

	</head>
<body>
<div class='outer_div'> <!--must be included on every page-->
<?php

include 'view/menu.php';
echo "we could not connect to the database because of the following error: ". mysqli_connect_error();
?>
</div>
</body>
</html>