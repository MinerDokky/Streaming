<?php session_start();

try//connexion à la bdd
{
    $bdd = new PDO("mysql:host=localhost;dbname=streaming;charset=utf8","root","");
}
catch(Exception $e)
{
    die("Une erreur s'est produite.");
}

                if(isset($_COOKIE['auth']) && !isset($_SESSION['auth'])) // si il y a un cookie et que la session est fausse donc qu'il n'est pas connecté
                {
                    $auth = $_COOKIE['auth']; 
                    $auth = explode('-----',$auth); // quand on rencontre '-----' on place la suite dans $auth[1]

                    $user = $bdd->prepare("SELECT * FROM users WHERE id_u=:id_u"); //on regarde dans la table où il y a l'id correspondant 
                    $user->bindValue(':id_u',$auth[0],PDO::PARAM_INT); //pour ne pas que l'on puisse entrer de requete 
                    $user->execute(); //on execute
                    $donnee = $user->fetch();
                    
                    $key = sha1($donnee['login'].$_SERVER['REMOTE_ADDR']);
                    
                    if($key == $auth[1]) // si les données login mdp et ip correspondent 
                    {
                    	$_SESSION['connecte'] = true; 
                        $_SESSION['auth'] = (array)$user;
                        setcookie('auth',$user['id_u'].'-----'.sha1($user['login'].$_SERVER['REMOTE_ADDR']),time()+3600*24*3,'/','localhost',false,true); //le dernier argument evite que le cookie soit editalbe en javascript, remote_addr est l'adresse ip
                                              
                    
                    }
                    else
                    {
                        setcookie('auth','',time()-3600,'/','localhost',false,true); //si les données login mdp et ip ne correspondent pas
                        die('mauvais cookie');
                    }
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
    header("Location:.../.../banni.php");
    session_start();
    session_destroy();
}

?>