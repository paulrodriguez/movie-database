<html>
<?php
echo 'test<br />';

$con = mysqli_connect("localhost", "root", 'mexicano', "movie_db");

if(mysqli_connect_errno($con)) {
	echo "could not connect to mysql database: " . mysqli_connect_error();
}
else {
	echo "connection successful <br />";
}
$result =  mysqli_query($con, "select * from Movie where id < 100");

while($row = mysqli_fetch_array($result)) {
	echo $row['title'] . "<br />";
}
echo "test 2 <br />";
?>

<head> <title> Search Actor/Actress </title>
		<style type="text/css">
			table, b{font-size:14pt}
			/*the code below is the style for menu*/
			.nav{width:100%;float:right;margin:0px; padding:0px; margin-top:0px}
			.nav .s1 a{text-decoration:none; color:black;display:block}
			.nav .s2 a{text-decoration:none; color:black;display:block;}
		
			.nav ul li{list-style:none; float:right}
	
			
			.nav ul li ul{display:none}
		
			.nav ul li ul.second_submenu{width:180px;float:left;position:absolute;margin:0px; padding:0px;}
			.nav ul li ul.first_submenu{width:140px;float:left; position:absolute;margin:0px; padding:0px}
			
			/*give these a class for hovering so that when using javascript we can remove these elements and use jquery instead*/
			.nav ul li:hover ul{display:block;background-color:white}
			.nav ul >li:hover{background-color:yellow;color:black}
		
		
		
			.first_submenu li, .second_submenu li{border-bottom-style:solid; border-bottom-width:2px}
			.s1{width:140px;text-align:center}
			.s2{width:180px;text-align:center}
			.wrapper{width:460px;margin:0 auto;margin-right:20px}
			/*.container{margin:0 auto;width:1000px;background-color:black;color:white}*/
			.search_bar{margin-top:15px;position:absolute}
		</style>

	</head>
<body>
</body>
<?php mysqli_close($con); ?>
</html>

