<?php include 'include/header.php' ?>
<?php
$libelle1 = $_GET['titre'];
$idf = $_GET['idf'];
?>
<?php
$requete = $bdd->query("SELECT lien FROM critiquef WHERE id_f = '$idf'");
if($reponse = $requete->fetch())
{
  $critique = $reponse['lien'];
}
?>
<?php
$requete = $bdd->query("SELECT lien FROM videof WHERE id_f = '$idf'");
if ($reponse = $requete->fetch())
{
  $liens = $reponse['lien'];
}
?>
<?php 
$id = $_SESSION['id_u'];
$requete = $bdd->query("SELECT * FROM notefilm WHERE id_u = $id AND id_f = '$idf'");
if($requete->fetch() == true AND isset($_POST['submit']))
{
  echo "<div class='connectionenc22'><p class='encours'>Vous avez déjà noté ce film</p></div>";
}         
else
        {
          if(isset($_POST['note']))
        {
          $note = $_POST['note'];
          $requete = $bdd->query("INSERT INTO notefilm (note, id_u,id_f) VALUES ('$note','$id','$idf')");
          echo "<div class='connectionenc'><p class='encours'>Note enregistré.</p></div>";

        }

      }
?>

<?php 
$requete = $bdd->query("SELECT SUM(note) as totale FROM notefilm WHERE id_f = '$idf'");
          if($reponse = $requete->fetch())
          {
            $totalnote = $reponse;
          }

          $requete = $bdd->query("SELECT COUNT(*) as note FROM notefilm WHERE id_f = '$idf'");
          if($reponse = $requete->fetch())
          {
            $nombrenote = $reponse;
          }   

 ?>    
 <?php
 $requete = $bdd->query("SELECT description FROM film WHERE id_f = $idf");
 if($reponse = $requete->fetch())
 {
  $description = $reponse['description'];
 }
 ?>  
 <?php
 $vue = $bdd->query("SELECT id_f FROM vuef WHERE id_f = '$idf'");
 if($vue->fetch() == false)
 {
 $requete = $bdd->query("INSERT INTO vuef (id_f,datevue) VALUES ('$idf',NOW())");
 } 
 ?> 
 <?php
 $requete = $bdd->query("SELECT id_f FROM film WHERE id_f NOT IN (SELECT id_f FROM vuef)");
 if($reponse = $requete->fetch())
 {
  $nonvue1 = $reponse[0];
 }
$sug = $bdd->query("SELECT titre FROM film WHERE id_f = '$nonvue1'");
 if($reponse = $sug->fetch())
 {
  $suggestion = $reponse['titre'];
 }
 ?>
<?php
$requete = $bdd->query("SELECT lien FROM lienimgposter WHERE id_f = '$nonvue1'");
if($reponse = $requete->fetch())
 {
  $lienimgnext = $reponse['lien']; 
 }
?>
<?php 
$requete = $bdd->query("SELECT titre,id_f FROM film WHERE titre = '$libelle1' AND id_f = '$idf'");
if($requete->fetch() == true)
{ ?>
<!DOCTYPE html>
<link rel="shortcut icon" href="m2.png" />
<title><?php echo $libelle1; ?></title>

<html>

  <head>

        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link href="style2.css" rel="stylesheet" type="text/css"> 
        <link href="style.css" rel="stylesheet" type="text/css"> 

  </head>
<div class="videos">
<iframe class="videos" width="560" height="315" src='<?php echo $liens; ?>' frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
<p class="note">Noter ce film :</p><br>

<form class="midf" method="post" action="">
    <select  name="note">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
  <img class="star" src="star.svg">
   <input type="submit" name="submit" value="Noter">
  </form>
<?php 
$requete = $bdd->query("SELECT * FROM notefilm WHERE id_f = $idf");
if ($requete->fetch() == true)
{ $moyenne = $totalnote['totale'] / $nombrenote['note']; ?> 
<p class="note">Note moyenne du film :</p><br>
<?php
echo "<p class='note'>" .$moyenne. " /5</p>";
 ?>
 <br><p class="note">Nombre de note :</p>
 <?php 
 echo "<p class='note'>Sur un totale de " .$nombrenote['note']. " note(s)</p>";
 ?>
 <?php }else{ ?>
 <p class="note">Aucune note enregistré à ce jour.</p>
 <?php } ?>
 <div class="synopsis">
 <br><p class="note">Synopsis :</p>
<?php 
echo "<br><p class='note'>" .$description. "</p>";
?>
<a href='<?php echo $critique; ?>'><img class="alocine" src="allocine.svg"></a>
</div>
</div>
<div class="suggestion">
	<div class="sugg">
		<p class="suggestion">Suggestions</p>  
    <a href="watch.php?titre=<?php echo $suggestion ; ?>&idf=<?php echo $nonvue1; ?>"><img class="nextvid" src="<?php echo $lienimgnext; ?>"></a>
    <p class="next">Porchain film :</p>
    <?php echo "<p class='next'>$suggestion</p>"; ?>
	</div>
</div>
<?php }else{ ?>
<!DOCTYPE html>
<link rel="shortcut icon" href="m2.png" />
<title>Erreur 404</title>
<html>

  <head>

        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link href="style2.css" rel="stylesheet" type="text/css"> 
        <link href="style.css" rel="stylesheet" type="text/css"> 

  </head>
    <div class="dimension">
        <img class="logowarning" src="warning.svg">
        <h1 class="erreur">Erreur - Page non autorisé</h1>
        <p class="indication">Cette page vous est interdite car le film n'existe plus.</p>
        <a href="../home.php"><input class="retour" type="submit" name="submit" value="Retour"></a>
    </div>
<?php } ?>

