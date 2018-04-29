<div class="categ2">
    <h1>SERIES</h1>
</div>
<?php include "include/header.php"; ?>
<?php include 'include/blocage.php' ?>
<?php
    $id =$_SESSION['id_u'];
    $date = date("l jS \of F Y h:i:s A");
    $requete = $bdd->query("SELECT datefin FROM abo WHERE id_u = $id");
    if($reponse = $requete->fetch() AND $reponse < $date)
    {
        $requete = $bdd->query("DELETE FROM abo WHERE id_u = $id");
    }
 
?>
    <!DOCTYPE html>
    <link rel="shortcut icon" href="m2.png" />
    <title>Séries</title>

    <html>

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="style2.css" rel="stylesheet" type="text/css">

    </head>

    <body>

        <div class="actionf2">
            <?php
	
  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 1");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"actions.php\"><p class='actionf2'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="animation2">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 2");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"animations.php\"><p class='animationf2'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="aventure2">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 3");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"aventures.php\"><p class='aventuref2'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="comedie2">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 4");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"comedies.php\"><p class='comedief2'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="drame2">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 5");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"drames.php\"><p class='dramef2'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="fantastique2">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 6");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"fantastiques.php\"><p class='fantastiquef2'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>

    </body>
    <?php include "include/footer.php"; ?>