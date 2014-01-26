<?php

///ini_set('display_erros', 'On');
error_reporting (E_ALL ^ E_NOTICE);
include("../model/variables.php");
$userinfo = '';
if(isset($_SESSION["user"]["username"]))
	$userinfo = "logged in as: ".$_SESSION["user"]["username"];
?>
<div style="width:100%;"><span style="float:right"><?php echo $userinfo;?></span></div>
<div class='nav'>
	<div class='search_bar'>
		<!--<form method='get' action = '/movies/controller/search.php'>-->
		<form method='get' action = '/movies/controller/search.php'>
			<input style="font-size:12pt" type='text' name='search_query' value ='' />
			<input style="font-size:12pt" type='submit' name='submit' value='SEARCH' />
		</form>
		
	</div>

	<div id="wrapper">
		<ul id="main_menu">

			<li class="last" style="<?php echo $menuSize[0];?>;"> 
				<div style="width:<?php echo $menuSize[0];?>; text-align:center"> ADD CONTENT</div>
				<ul class="subMenuDropdown subMenuCssDropdown">
					<li class="page-item2"><div><a href="/add_actor_director.php">ADD NEW ACTOR/DIRECTOR</a></div></li>
					<li class="page-item2"><div><a href="/movies/add_actor_to_movie.php">ADD ACTOR TO MOVIE</a></div></li>
					<li class="page-item2"><div><a href="/movies/add_director_to_movie.php">ADD DIRECTOR TO MOVIE</a></div></li>
					<li class="page-item2"><div><a href="/movies/add_movie.php">ADD NEW MOVIE</a></div></li>
					<li class="page-item2"><div><a href="/movies/controller/review.php">RATE A MOVIE</a></div></li>	
				</ul>
			</li>
			<li class="middle" style="<?php echo $menuSize[1];?>;">
				<div style="width:<?php echo $menuSize[1];?>; text-align:center">BROWSE DATABASE</div>
				<ul class="subMenuDropdown subMenuCssDropdown">						
					<li class="page-item1"><div><a href="/movies/actors">SEARCH ACTOR INFORMATION</div></a></li>
					<li class="page-item1"><div><a href="/movies/movie">SEARCH MOVIE INFORMATION</a></div></li>
				</ul>
			</li>
			<li class="first" style="<?php echo $menuSize[2];?>;"> 
				<div style="width:<?php echo $menuSize[2];?>; text-align:center">ACCOUNT</div>
				<ul class="subMenuDropdown subMenuCssDropdown">		
					<?php 
					//output this if the user is not logged in or registered
					if($_SESSION['user']['login'] == 'no' || $_SESSION['user']['login'] == null) :
					?>
					<li class="page-item0"><div><a href="/movies/controller/register.php">REGISTER</a></div></li>
					<li class="page-item0"><div><a href="/movies/controller/login.php">LOG IN</a></div></li>
					<?php
					elseif($_SESSION['user']['login']  == 'yes') :
					?>
					<li class="page-item0"><div><a href="#">MANAGE PROFILE</a></div></li>
					<li class="page-item0"><div><a href="/movies/controller/logout.php">LOG OUT</a></div></li>
					<?php endif; ?>
				</ul>
			</li>
		</ul>
	</div><!--end div id=wrapper-->
</div> <!--end div class=nav-->
<div style="height:100px"></div>
