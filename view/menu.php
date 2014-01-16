<?php

///ini_set('display_erros', 'On');
error_reporting (E_ALL ^ E_NOTICE);
include("/model/variables.php");
?>
<div class='nav'>
	<div class='search_bar'>
		<form method='get' action = 'search.php'>
			<input style="font-size:12pt" type='text' name='search_query' value ='' />
			<input style="font-size:12pt" type='submit' name='submit' value='SEARCH' />
		</form>
		
	</div>

	<div id="wrapper">
		<ul id="main_menu">

			<li class="last" style="<?php echo $menuSize[0];?>;"> 
				<div style="width:<?php echo $menuSize[0];?>; text-align:center"> ADD CONTENT</div>
				<ul class="subMenuDropdown subMenuCssDropdown">
					<li class="page-item"><div><a href="add_actor_director.php">ADD NEW ACTOR/DIRECTOR</a></div></li>
					<li class="page-item"><div><a href="add_actor_to_movie.php">ADD ACTOR TO MOVIE</a></div></li>
					<li class="page-item"><div><a href="add_director_to_movie.php">ADD DIRECTOR TO MOVIE</a></div></li>
					<li class="page-item"><div><a href="add_movie.php">ADD NEW MOVIE</a></div></li>
					<li class="page-item"><div><a href="add_review.php">RATE A MOVIE</a></div></li>	
				</ul>
			</li>
			<li style="<?php echo $menuSize[1];?>;">
				<div style="width:<?php echo $menuSize[1];?>; text-align:center">BROWSE DATABASE</div>
				<ul class="subMenuDropdown subMenuCssDropdown">						
					<li class="page-item"><div><a href="search_actor.php">SEARCH ACTOR INFORMATION</div></a></li>
					<li class="page-item"><div><a href="search_movie.php">SEARCH MOVIE INFORMATION</a></div></li>
				</ul>
			</li>
			<li class="first" style="<?php echo $menuSize[2];?>;"> 
				<div style="width:<?php echo $menuSize[2];?>; text-align:center">ACCOUNT</div>
				<ul class="subMenuDropdown subMenuCssDropdown">		
					<?php 
					//output this if the user is not logged in or registered
					if($_SESSION['user']['login'] == 'no' || $_SESSION['user']['login'] == null) :
					?>
					<li class="page-item"><div><a href="register.php">REGISTER</a></div></li>
					<li class="page-item"><div><a href="login.php">LOG IN</a></div></li>
					<?php
					elseif($_SESSION['user']['login']  == 'yes') :
					?>
					<li class="page-item"><div><a href="#">MANAGE PROFILE</a></div></li>
					<li class="page-item"><div><a href="model/logout.php">LOG OUT</a></div></li>
					<?php endif; ?>
				</ul>
			</li>
		</ul>
	</div><!--end div id=wrapper-->
</div> <!--end div class=nav-->
<div style="height:100px"></div>
