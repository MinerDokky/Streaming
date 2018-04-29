<link rel="shortcut icon" href="m2.png" />
<title>Guerre</title>
<?php include 'include/header.php' ?>
<link href="style2.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
<?php 
$id = $_SESSION['id_u'];
$requete = $bdd->query("SELECT datedeb FROM abo WHERE id_u = $id");
if($requete->fetch() == true) { ?>
<img class="films" src="poster/Kong.jpg">
<?php
$requete = $bdd->query("SELECT titre FROM film WHERE id_f = 7 AND id_c = 7");
if($reponse = $requete->fetch())
{
	$titre = $reponse['titre'];
}
$requete = $bdd->query("SELECT description FROM film WHERE id_f = 7 AND id_c = 7");
if($reponse = $requete->fetch())
{
	$description = substr($reponse['description'],0,60)."... <a href='films/watch.php?titre=Kong&idf=7'>Regarder</a>";
	
}

echo "<p class='titre'>" .$titre. "</p>";
echo "<p class='description'>" .$description. "</p>";

 ?>
 
    </div>
    <?php }else{ ?>
    <div class="dimension">
        <img class="logowarning" src="warning.svg">
        <h1 class="erreur">Erreur - Page non autorisé</h1>
        <p class="indication">Cette page vous est interdite car aucun abonnement n'est associé à votre compte.<br> Veuillez souscrire un abonnement afin de pouvoir profiter du service.</p>
        <a href="home.php"><input class="retour" type="submit" name="submit" value="Retour"></a>
    </div>
    <?php } ?>
