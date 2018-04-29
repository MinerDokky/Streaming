<link rel="shortcut icon" href="m2.png" />
<title>Prémium</title>
<?php include "include/header.php"; ?>
<?php
if($_SESSION == true) { ?>
    <?php
if (isset($_POST['submit1'])) {
  $id = $_SESSION['id_u'];
  $requete = $bdd->query("SELECT * FROM abo WHERE id_u = $id");
  if ($requete->fetch() == false) 
  {
    $requete = $bdd->query("INSERT INTO abo (id_a,datedeb,datefin,id_u) VALUES (2,NOW(),DATE_ADD(NOW(),INTERVAL 2 DAY),'$id')");
    echo "<div class='connectionenc'><p class='encours'>Abonnement pris en compte , plus d'information sur votre espace compte.</p></div>"; 
  }
  else
  {
        echo "<div class='connectionenc22'><p class='encours2'>Un abonnement est déjà en cours,si vous souhaitez modifier votre abonnement rendez-vous dans votre espace compte.</p></div>";
  }
}
?>

        <?php
if (isset($_POST['submit7'])) {
  $id = $_SESSION['id_u'];
  $requete = $bdd->query("SELECT * FROM abo WHERE id_u = $id");
  if ($requete->fetch() == false) 
  {
    $requete = $bdd->query("INSERT INTO abo (id_a,datedeb,datefin,id_u) VALUES (3,NOW(),DATE_ADD(NOW(),INTERVAL 3 DAY),'$id')");
    echo "<div class='connectionenc'><p class='encours'>Abonnement pris en compte , plus d'information sur votre espace compte.</p></div>";   

  }
  else
  {
    echo "<div class='connectionenc22'><p class='encours2'>Un abonnement est déjà en cours,si vous souhaitez modifier votre abonnement rendez-vous dans votre espace compte.</p></div>"; }
}
?>

            <?php
if (isset($_POST['submit31'])) {
  $id = $_SESSION['id_u'];
  $requete = $bdd->query("SELECT * FROM abo WHERE id_u = $id");
  if ($requete->fetch() == false) 
  {
    $requete = $bdd->query("INSERT INTO abo (id_a,datedeb,datefin,id_u) VALUES (5,NOW(),DATE_ADD(NOW(),INTERVAL 5 DAY),'$id')");
    echo "<div class='connectionenc'><p class='encours'>Abonnement pris en compte , plus d'information sur votre espace compte.</p></div>";    
  }
  else
  {
    echo "<div class='connectionenc22'><p class='encours2'>Un abonnement est déjà en cours,si vous souhaitez modifier votre abonnement rendez-vous dans votre espace compte.</p></div>";
  }
}
?>
                <?php } ?>
                <!DOCTYPE html>


                <html>

                <head>

                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="style2.css" rel="stylesheet" type="text/css">
                    <link href="style.css" rel="stylesheet" type="text/css">

                </head>

                <body>
                    <div class="top">
                        <h3 class="pq">Pourquoi ?</h3>
                        <p class="pourquoi">Un abonnement vous permet de profiter du streaming en illimiter. <br> Une grande variété de films et séries à votre entière disposition sans aucune publicité ! <br> Qu'attendez-vous pour souscrire ?</p>
                        <a href="#"><input class="souscrire" type="submit" name="submit" value="souscrire"></a>
                    </div>
                    <form class="abonnement" target="" method="post">
                        <div class="mid">
                            <h3 class="pq2">Durée de l'abonnement</h3>
                            <a href="#"><input class="abonnement" type="submit" name="submit1" value="2 jours - 2€99"></a>
                            <a href="#"><input class="abonnement" type="submit" name="submit7" value="3 jours - 14€99"></a>
                            <a href="#"><input class="abonnement" type="submit" name="submit31" value="5 jours - 24€99"></a>
                            <p class="pourquoi2">*En cliquant sur l'un des boutons vous faite le choix de souscrire à un abonnement. Un seul abonnement par utilisateur.</p>
                        </div>
                    </form>
                </body>
                <?php include "include/footer.php"; ?>