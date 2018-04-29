<?php session_start();

try//connexion à la bdd
{
    $bdd = new PDO("mysql:host=localhost;dbname=streaming;charset=utf8","root","");
}
catch(Exception $e)
{
    die("Une erreur s'est produite.");
}

?>
<?php
$ip = $_SERVER['REMOTE_ADDR'];
$date = date("l jS \of F Y h:i:s A");
$requete = $bdd->query("SELECT finban FROM ban WHERE ip = '$ip'");
if($reponse = $requete->fetch())
{
    $finban = $reponse['finban'];
    if($findate < $date)
    {
        $requete = $bdd->query("DELETE ban WHERE ip = '$ip'");
    }
}
$requete = $bdd->query("SELECT * FROM ban WHERE ip = '$ip'");
if($requete->fetch() == true)
{
    header("Location:banni.php");
    session_start();
    session_destroy();
}

?>