<div class="categ">
    <h1>FILMS</h1>
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
    <title>Films</title>

    <html>

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet" type="text/css">
        <link href="style2.css" rel="stylesheet" type="text/css">

    </head>

    <body>

        <div class="actionf">
            <?php
	
  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 1");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"actionf.php\"><p class='actionf'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="animation">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 2");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"animationf.php\"><p class='animationf'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="aventure">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 3");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"aventuref.php\"><p class='aventuref'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="comedie">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 4");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"comedief.php\"><p class='comedief'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="drame">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 5");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"dramef.php\"><p class='dramef'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="fantastique">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 6");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"fantastiquef.php\"><p class='fantastiquef'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="guerre">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 7");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"guerref.php\"><p class='guerref'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="horreur">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 9");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"horreurf.php\"><p class='horreurf'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>
        <div class="science">
            <?php

  	$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 11");
  	if ($reponse = $requete->fetch())

  		{
  			echo "<a href=\"sciencef.php\"><p class='sciencef'>".$reponse['libelle']."</p></a>";
  		}

  		?>
        </div>

    </body>
    <?php include "include/footer.php"; ?>