<link rel="shortcut icon" href="m2.png" />
<title>Comedie</title>
<?php include 'include/header.php' ?>
<link href="style2.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
<?php 
$id = $_SESSION['id_u'];
$requete = $bdd->query("SELECT datedeb FROM abo WHERE id_u = $id");
if($requete->fetch() == true) { ?>
<img class="films" src="poster/bbt.jpg">
<?php
$requete = $bdd->query("SELECT titre FROM serie WHERE id_s = 6 AND id_c = 4");
if($reponse = $requete->fetch())
{
    $titre = $reponse['titre'];
}
$requete = $bdd->query("SELECT description FROM serie WHERE id_s = 6 AND id_c = 4");
if($reponse = $requete->fetch())
{
    $description = substr($reponse['description'],0,60)."... <a href='serie/watch.php?titre=The Big Bang Theory&ids=6&idsn=1&ep=1'>Regarder</a>";
    
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
