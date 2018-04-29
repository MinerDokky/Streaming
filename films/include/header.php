<?php include "include/connectionbdd.php"; ?>
<!DOCTYPE HTML>
<link href="style2.css" rel="stylesheet" type="text/css">
<nav>
	<img class="logom" src="m.png">	
	<form action="recherche.php" method="post">
	<input class="selectfs" type="submit" name="submit" value="Rechercher">	
	<input class="search" type="search" name="search" placeholder="nom...">
	</form>
	<ul>
		<li><a href="../index.html"><img class="home" src="home-button.svg"></a></li>
		<li><a href="../home.php">Films</a></li>
		<li><a href="../Series.php">Séries</a></li>
		<li><a href="../Prémium.php">Prémium</a></li>
		<?php
		if($_SESSION == true) { ?>
		<li><a href="../Compte.php">Compte</a></li>		
		<li><a href="../deconnection.php">Deconnection</a></li>
		<?php }else{ ?> 
		<a href="../connexion.php"><input class="inscriptionconnection" type="submit" name="inscription/connection" value="Connection/Inscription"></a>
		<?php } ?>							
	</ul>
</nav>
