<link rel="shortcut icon" href="m2.png" />
<title>Connection</title>
<?php include "include/connectionbdd.php"; ?>
<?php
if(isset($_POST['submit']))
{
    $password = sha1($_POST['password']);
    $login = htmlentities($_POST['login']);


    $user = $bdd->query("SELECT * FROM users WHERE login = '$login' AND mdp = '$password'");

    if ($reponse = $user->fetch())
    {
        $_SESSION['connecte'] = true;
        $_SESSION['id_u'] = $reponse['id_u'];
        $_SESSION['mail'] = $reponse['mail'];
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['niveau'] = $reponse['niveau'];
        $_SESSION['auth'] = (array)$user;
        $donnee = $_SESSION['auth'];
        $requete = $bdd->query("UPDATE users SET datelastco = NOW() WHERE login = '$login'");
        if(isset($_POST['save'])) /* sert a saubegarder le cookie*/
                    {
                        setcookie('auth',$reponse['id_u'].'-----'.sha1($reponse['login'].$_SERVER['REMOTE_ADDR']),time()+3600*24*3,'/','localhost',false,true); //le dernier argument evite que le cookie soit editalbe en javascript, remote_addr est l'adresse ip
                        
                    } 


        header('refresh:3;url=home.php');
        echo "<div class='connectionenc'><p class='encours'>Connection en cours....</p></div>";   
    }
    else
    {
        echo "<div class='connectionenc2'><p class='encours2'>Information incorrecte....</p></div>";
    }

}
?>

<!DOCTYPE html>


<html>

  <head>

        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet" type="text/css">   

  </head>

  <body>
<div class="wrapper">
<img class="logoindex" src="LOGOMOVIX.png">
<div class="m">
<img class="mm" src="m.png">
</div>
<div class="logintop">
<div class="login">
<img class="connection" src="usercheck.svg">
<form class="login" target="" method="post">
    <label about="text"><p>Username</label>
    <input class="login" type="text" name="login" placeholder="username" required />
	<label about="mdp"><p>Password</label>
    <input class="password" type="password" name="password" placeholder="password" htmlentities required />
    <div class="g-recaptcha" data-sitekey="6Lfn1FEUAAAAAN1zmg-5AKEyNLxyENo0OPm4CRRn" required></div>
    <input type="checkbox" name="save" ><label>Se souvenir de moi.</label>
    <input class="button" type="submit" name="submit" value="Connexion"   />
    <a href="inscription.php"><p class="loggin">S'inscrire ?</p></a>
</form>
</div>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</>



