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
