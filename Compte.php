<?php include 'include/header.php' ?>
<?php include 'include/blocage.php' ?>
<?php 
$id = $_SESSION['id_u'];
?>
<?php
if (isset($_POST['submit11']))
{
  $requete = $bdd->query("SELECT * FROM abo WHERE id_u = $id");
  if ($requete->fetch() == false)

  {
    echo "<div class='connectionenc22'><p class='encours'>La modification d'abonnement est reservé au membre abonnée...</p></div>";

  }
  else
  {
        $id = $_SESSION['id_u'];
    $requete = $bdd->query("UPDATE abo SET datefin = DATE_ADD(NOW(),INTERVAL 2 DAY) WHERE id_u = $id");
    $requete = $bdd->query("UPDATE abo SET datedeb = NOW() WHERE id_u = $id");
    echo "<div class='connectionenc'><p class='encours'>Abonnement modifié</p></div>";
  }
}
?>

<?php
if (isset($_POST['submit77'])) 
{
    $requete = $bdd->query("SELECT * FROM abo WHERE id_u = $id");
  if ($requete->fetch() == false)
 {   
    echo "<div class='connectionenc22'><p class='encours'>La modification d'abonnement est reservé au membre abonnée...</p></div>";
	}
  else
  {
        $id = $_SESSION['id_u'];
    $requete = $bdd->query("UPDATE abo SET datefin = DATE_ADD(NOW(),INTERVAL 3 DAY) WHERE id_u = $id");
    $requete = $bdd->query("UPDATE abo SET datedeb = NOW() WHERE id_u = $id");
    echo "<div class='connectionenc'><p class='encours'>Abonnement modifié</p></div>";  
  }
}
?>

<?php
if (isset($_POST['submit311'])) 
{
      $requete = $bdd->query("SELECT * FROM abo WHERE id_u = $id");
  if ($requete->fetch() == false)
 {   
    echo "<div class='connectionenc22'><p class='encours'>La modification d'abonnement est reservé au membre abonnée...</p></div>";
  }
  else
  {
    $id = $_SESSION['id_u'];
    $requete = $bdd->query("UPDATE abo SET datefin = DATE_ADD(NOW(),INTERVAL 5 DAY) WHERE id_u = $id");
    $requete = $bdd->query("UPDATE abo SET datedeb = NOW() WHERE id_u = $id");
    echo "<div class='connectionenc'><p class='encours'>Abonnement modifié</p></div>"; 
  }
}
?>
            <?php
if(isset($_POST['submitmodif']))
{
  $login = $_POST['login'];
  $mdp = sha1($_POST['mdp1']);
  $mail = $_POST['mail'];
  $requete = $bdd->query("UPDATE users SET login = $login WHERE id_u = $id");
  $requete = $bdd->query("UPDATE users SET mdp = $mdp WHERE id_u = $id");
  $requete = $bdd->query("UPDATE users SET mail = $mail WHERE id_u = $id");
  echo "<div class='connectionenc'><p class='encours'>Abonnement modifié</p></div>"; 
}

$requete = $bdd->query("SELECT datefin FROM abo WHERE id_u = $id");
if($reponse = $requete->fetch())
{
  $datef = $reponse['datefin'];
}


?>

                <!DOCTYPE html>
                <link rel="shortcut icon" href="m2.png" />
                <title>Compte</title>

                <html>

                <head>

                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="style2.css" rel="stylesheet" type="text/css">
                    <link href="style.css" rel="stylesheet" type="text/css">


                    <script type="text/javascript">
                        function CompteARebours() {
                            var date_actuelle = new Date(); // On déclare la date d'aujourd'hui.
                            var annee = date_actuelle.getFullYear();

                            var abonnement = new Date('<?php echo $datef; ?>'); // On déclare la date de Noël.



                            var tps_restant = abonnement.getTime() - date_actuelle.getTime(); // Temps restant en millisecondes

                            //============ CONVERSIONS

                            var s_restantes = tps_restant / 1000; // On convertit en secondes
                            var i_restantes = s_restantes / 60;
                            var H_restantes = i_restantes / 60;
                            var d_restants = H_restantes / 24;


                            s_restantes = Math.floor(s_restantes % 60); // Secondes restantes
                            i_restantes = Math.floor(i_restantes % 60); // Minutes restantes
                            H_restantes = Math.floor(H_restantes % 24); // Heures restantes
                            d_restants = Math.floor(d_restants); // Jours restants
                            //==================
                            var mois_fr = new Array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

                            var texte = "<div class='abonnement'><p class='connect'>Votre abonnement expirera dans <br><strong>" + d_restants + " jours</strong>, <strong>" + H_restantes + " heures</strong>," +
                                " <strong>" + i_restantes + " minutes</strong> et <strong>" + s_restantes + "s</strong> !</p></div>";


                            document.getElementById("affichage").innerHTML = texte;
                        }
                    </script>


                </head>

                <body>
                    <h1 class="profil">Profil</h1>
                    <div class="modifinfo">
                        <h3 class="modifinfo">Modification d'information :</h3>
                        <form target="#" method="post">
                            <label>Login :
		<input class="log" type="text" name="login" required placeholder="<?php echo $_SESSION['login'];?>" >
		</label>
                            <label>Mot de passe* :
		<input class="mdp" type="password" name="mdp1" required placeholder="nouveau mot de passe" >
		</label>
                            <label>Email :
		<input class="email" type="email" name="mail" required placeholder="<?php echo $_SESSION['mail'];?>" >
		</label>
                            <label>êtes vous sûr ?
		<input class="valider" type="checkbox" name="confirmer" required>		
		</label><input class="valider" type="submit" name="submitmodif" value="Valider">
                        </form>
                    </div>

                    <div class="informationactuelle">
                        <p class="connect">Connecté en tant que :
                            <?php echo $_SESSION['login']; ?>
                        </p>
                        <p class="connect">Compte prémium :</p>
                        <?php 
		$requete = $bdd->query("SELECT * FROM abo WHERE id_u = $id");
  		if ($requete->fetch() == false)
  		{
  			echo "<p class='connect'>Aucun</p>";
  		}
  		else
  		{
  			echo "<p class='connect'>Oui</p>";

  		}  

  		?>
                        <?php
      $requete = $bdd->query("SELECT * FROM abo WHERE id_u = $id");
      if ($requete->fetch() == true) { ?>
                            <p id="affichage">
                                }
                                <script type="text/javascript">
                                    setInterval(CompteARebours, 1); // Rappel de la fonction toutes les 1000 millisecondes (toutes les secondes quoi !).
                                </script>
                            </p>

                            <?php } ?>
                            <p class="connect">Renouvelez votre abonnement : </p>
                            <form class="abonnement" target="#" method="post">
                                <a href="#"><input class="abonnement" type="submit" name="submit11" value="2 jours - 2€99"></a>
                                <a href="#"><input class="abonnement" type="submit" name="submit77" value="3 jours - 14€99"></a>
                                <a href="#"><input class="abonnement" type="submit" name="submit311" value="5 jours - 24€99"></a>
                            </form>
                    </div>
                </body>
                <?php
  if($_SESSION['niveau'] == '2')
    { ?>
<div class="adminpanel">
<?php 
$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 1");
if($reponse = $requete->fetch())
{
  $action = $reponse['libelle'];
}
$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 2");
if($reponse = $requete->fetch())
{
  $animation = $reponse['libelle'];
}
$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 3");
if($reponse = $requete->fetch())
{
  $aventure = $reponse['libelle'];
}
$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 4");
if($reponse = $requete->fetch())
{
  $comedie = $reponse['libelle'];
}
$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 5");
if($reponse = $requete->fetch())
{
  $drame = $reponse['libelle'];
}
$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 6");
if($reponse = $requete->fetch())
{
  $fantastique = $reponse['libelle'];
}
$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 7");
if($reponse = $requete->fetch())
{
  $guerre = $reponse['libelle'];
}
$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 9");
if($reponse = $requete->fetch())
{
  $horreur = $reponse['libelle'];
}
$requete = $bdd->query("SELECT libelle FROM categorie WHERE id_c = 11");
if($reponse = $requete->fetch())
{
  $science = $reponse['libelle'];
}
?>

      <?php 
      if(isset($_POST['delete']))
      {
        if(isset($_POST['choix']))
        {
      $choix = $_POST['choix'];  
      $requete = $bdd->query("DELETE id_c FROM categorie WHERE libelle = '$choix'"); 
      echo "<div class='connectionenc'><p class='encours'>Effectué</p></div>";
      }
      }
      ?>
        <?php
      if(isset($_POST['modifier']))
      {
        if(isset($_POST['choix']))
        {
          $choix = $_POST['choix'];
        $renewcat = $_POST['categorierenew'];
        $requete = $bdd->query("UPDATE categorie SET libelle = '$renewcat' WHERE libelle = '$choix'");
        echo "<div class='connectionenc'><p class='encours'>Recharger la page pour apercevoir les modifications</p></div>";
      }
      }
      ?>
      <?php
      if(isset($_POST['newcatv']))
      {
        $newcat = $_POST['newcat'];
        $requete = $bdd->query("INSERT INTO categorie (libelle) values ('$newcat')");
        echo "<div class='connectionenc'><p class='encours'>Une nouvelle catégorie viens d'être ajouté</p></div>";
      }  
      ?>
      <?php
      if(isset($_POST['suppr']))
      {
        $filmserie = $_POST['filmserie'];
        $film = $bdd->query("SELECT * FROM film WHERE titre = '$filmserie'");
        if ($film->fetch() == true)
        {
          $film1 = $bdd->query("DELETE film WHERE titre = '$filmserie'");
            $nomfilm = $film1->fetch();
            unlink ("film/".$nomfilm.".php");          
          echo "Film supprimé";
        }
        elseif ($film->fetch() == false) 
        {
          echo "Ce film n'existe pas...";
        } 
      }
      ?>
      <?php
      if(isset($_POST['suppr']))
      {
        $filmserie = $_POST['filmserie'];
        $serie = $bdd->query("SELECT * FROM serie WHERE titre = '$filmserie'");
        if($serie->fetch() == true)
        {
            $serie1 = $bdd->query("DELETE serie WHERE titre = '$filmserie'");
            $nomserie = $serie1->fetch();
            unlink ("serie/".$nomserie.".php");
            echo "Série supprimé";
        }
        elseif ($serie->fetch() == false) 
        {
          echo "Cette série n'existe pas...";
        } 
      }
       ?>
       <?php 
       $requete = $bdd->query("SELECT COUNT(*) as nombreuser FROM users");
        if($reponse = $requete->fetch())
          {
            $totaluser = $reponse['nombreuser'];
            echo "Il y à ".$totaluser. " inscrit à ce jours";
          }
       ?>     
  <form method="post" action="">
    <label>Choisir la categorie :(selectionner la categorie à interagir)
    <select class="choix" name="choix">
        <option value="categorie">Categorie</option>
      <option value="<?php echo $action; ?>"><?php echo $action; ?></option>
      <option value="<?php echo $animation; ?>"><?php echo $animation; ?></option>
      <option value="<?php echo $aventure; ?>"><?php echo $aventure; ?></option>
      <option value="<?php echo $comedie; ?>"><?php echo $comedie; ?></option>
      <option value="<?php echo $drame; ?>"><?php echo $drame; ?></option>
      <option value="<?php echo $fantastique; ?>"><?php echo $fantastique; ?></option>
      <option value="<?php echo $guerre; ?>"><?php echo $guerre; ?></option>
      <option value="<?php echo $horreur; ?>"><?php echo $horreur; ?></option>
      <option value="<?php echo $science; ?>"><?php echo $science; ?></option>
    </select>
    </label>
    <input class="valider" type="submit" name="delete" value="supprimer">
    <label class="aaa">Modifier une categorie :(inserer le nouveau libelle) 
    <input class="log" type="text" name="categorierenew">
    <input class="valider" type="submit" name="modifier" value="modifier">
    </label>
  </form>
    <form method="post" target="">
    <label>Nouvelle catégorie :
    <input class="log" type="text" name="newcat">
    <input class="valider" type="submit" name="newcatv" value="Valider">
    </label>
    </form>
    <form method="post">
      <label>Supprimer un film / série :(Veuillez renseigner le nom correspondant au film ou série que vous souhaitez supprimer)
      <input class="log" type="text" name="filmserie">
      <input class="valider" type="submit" name="suppr">
      </label>
    </form>
    <?php 
    if(isset($_POST['bannir']))
    {
      $userss = htmlentities($_POST['userss']);
      $requete = $bdd->query("SELECT login FROM users WHERE login = '$userss'");
      if($requete->fetch() == true)
      {
        $requete = $bdd->query("SELECT ip FROM users WHERE login = '$userss'");
        if ($reponse = $requete->fetch())
        {
          $ipuser = $reponse['ip'];
        }
       $bann = $bdd->query("INSERT INTO ban (login,ip) VALUES ('$userss','$ipuser')");
       echo "<div class='connectionenc'><p class='encours'>Membre banni définitivement</p></div>"; 
      }
      else
      {
        echo "<div class='connectionenc22'><p class='encours'>utilisateur introuvable</p></div>";
      }

    }
    elseif (isset($_POST['bannird'])) 
    {
      $userss = htmlentities($_POST['userss']);
      $date = $_POST['date'];
      $requete = $bdd->query("SELECT login FROM users WHERE login = '$userss'");
      if($requete->fetch() == true)
      {
        $requete = $bdd->query("SELECT ip FROM users WHERE login = '$userss'");
        if ($reponse = $requete->fetch())
        {
          $ipuser = $reponse['ip'];
        }
       $bann = $bdd->query("INSERT INTO ban (login,ip,debban,finban) VALUES ('$userss','$ipuser',NOW(),'$date')");
       echo "<div class='connectionenc'><p class='encours'>Membre banni temporairement</p></div>"; 
      }
      else
      {
        echo "<div class='connectionenc22'><p class='encours'>utilisateur introuvable</p></div>";
      }
    }
    ?>
    <form method="post" action="">
      <label>Bannir un utilisateur
      <label>Saisir le login de l'utilisateur
      <input class="log" type="text" name="userss" required>
      </label>
      <label> Laisser vide pour un bannissage définitive
      <input type="date" name="date">
      </label>
      <input class="valider" type="submit" name="bannir" value="bannir définitivement">
      <input class="valider" type="submit" name="bannird" value="bannir temporairement">
      </label>
    </form>
    </div> 
    <?php } else{?>
    <h1 class="profil">Administration</h1>
          <div class="dimension2">
        <img class="logowarning" src="warning.svg">
        <h1 class="erreur">Erreur - Section non autorisé</h1>
        <p class="indication">Cette section vous est interdite car vous n'êtes pas un administrateur</p>
    </div>
    <?php } ?>

               