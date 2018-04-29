<?php include 'include/header.php' ?>
<?php
$libelle1 = $_GET['titre'];
$ids = $_GET['ids'];
$idsn = $_GET['idsn'];
$ep = $_GET['ep'];
?>
<?php
$requete = $bdd->query("SELECT lien FROM critiques WHERE id_s = '$ids'");
if($reponse = $requete->fetch())
{
  $critique = $reponse['lien'];
}
?>
<?php
$requete = $bdd->query("SELECT lien FROM videos WHERE id_s = '$ids'");
if ($reponse = $requete->fetch())
{
  $liens = $reponse['lien'];
}
?>
<?php 
$id = $_SESSION['id_u'];
$requete = $bdd->query("SELECT * FROM noteserie WHERE id_u = $id AND id_s = '$ids'");
if($requete->fetch() == true AND isset($_POST['submit']))
{
  echo "<div class='connectionenc22'><p class='encours'>Vous avez déjà noté ce film</p></div>";
}         
else
        {
          if(isset($_POST['note']))
        {
          $note = $_POST['note'];
          $requete = $bdd->query("INSERT INTO noteserie (note, id_u,id_s) VALUES ('$note','$id','$ids')");
          echo "<div class='connectionenc'><p class='encours'>Note enregistré.</p></div>";

        }

      }
?>

<?php 
$requete = $bdd->query("SELECT SUM(note) as totale FROM noteserie WHERE id_s = '$ids'");
          if($reponse = $requete->fetch())
          {
            $totalnote = $reponse;
          }

          $requete = $bdd->query("SELECT COUNT(*) as note FROM noteserie WHERE id_s = '$ids'");
          if($reponse = $requete->fetch())
          {
            $nombrenote = $reponse;
          }   

 ?>    
 <?php
 $requete = $bdd->query("SELECT description FROM serie WHERE id_s = $ids");
 if($reponse = $requete->fetch())
 {
  $description = $reponse['description'];
 }
 ?>  
 <?php
 $vue = $bdd->query("SELECT id_s FROM vues WHERE id_s = '$ids'");
 if($vue->fetch() == false)
 {
 $requete = $bdd->query("INSERT INTO vues (id_s,datevue,id_sn,episode,titre) VALUES ('$ids',NOW(),'$idsn','$ep','$libelle1')");
 } 
 ?> 
 <?php
 $requete = $bdd->query("SELECT id_s FROM serie WHERE id_s NOT IN (SELECT id_s FROM vues)");
 if($reponse = $requete->fetch())
 {
  $nonvue1 = $reponse[0];
 }
 $requete = $bdd->query("SELECT id_c FROM serie WHERE id_s = '$nonvue1'");
if($reponse = $requete->fetch())
 {
  $id_cc = $reponse['id_c'];
 } 
$sug = $bdd->query("SELECT titre FROM serie WHERE id_c = '$id_cc'");
 if($reponse = $sug->fetch())
 {
  $suggestion = $reponse['titre'];
 }
  $sug = $bdd->query("SELECT id_sn FROM serie WHERE titre = '$suggestion' IN (SELECT id_s FROM vues)");
  if($reponse = $sug->fetch())
 {
  $idsn1 = $reponse['id_sn'];
 }
 $sug = $bdd->query("SELECT episode FROM serie WHERE titre = '$suggestion'  IN (SELECT id_s FROM vues)");
  if($reponse = $sug->fetch())
 {
  $ep1 = $reponse['episode'];
 } 
 ?>
<?php
$requete = $bdd->query("SELECT lien FROM lienimgposters WHERE id_s = '$nonvue1'");
if($reponse = $requete->fetch())
 {
  $lienimgnext = $reponse['lien']; 
 }
?>
<?php 
$requete = $bdd->query("SELECT titre,episode,id_sn,id_s,description,id_c FROM serie WHERE titre = '$libelle1' AND id_s = '$ids' AND episode = '$ep' AND id_sn = '$idsn'");
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
  <div class="pagination">
    <a href='watch.php?titre=<?php echo $libelle1; ?>&ids=<?php echo $ids ; ?>&idsn=<?php echo $idsn; ?>&ep=<?php echo 1-$ep; ?>'>&laquo;Episode précedent</a><a href='watch.php?titre=<?php echo $libelle1; ?>&ids=<?php echo $ids ; ?>&idsn=<?php echo $idsn; ?>&ep=<?php echo ++$ep; ?>'>Episode suivant &raquo;</a>
  </div><br>
    <br><div class="pagination">
    <a href='watch.php?titre=<?php echo $libelle1; ?>&ids=<?php echo $ids ; ?>&idsn=<?php echo ++$idsn; ?>&ep=<?php echo $ep-1; ?>'>Saison suivante &raquo;</a>
  </div>

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
$requete = $bdd->query("SELECT * FROM noteserie WHERE id_s = $ids");
if ($requete->fetch() == true)
{ $moyenne = $totalnote['totale'] / $nombrenote['note']; ?> 
<p class="note">Note moyenne de la série :</p><br>
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
    <a href="watch.php?titre=<?php echo $suggestion ; ?>&ids=<?php echo $nonvue1; ?>&idsn=<?php echo $idsn1; ?>&ep=<?php echo $ep1; ?>"><img class="nextvid" src="<?php echo $lienimgnext; ?>"></a>
    <p class="next">Porchaine série :</p>
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

