<?php include "include/connectionbdd.php"; ?>
<?php
if(isset($_POST['submit']) && $_POST['mdp'] == $_POST['mdp1'])
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $login = htmlentities($_POST['login']);
    $mdp = sha1($_POST['mdp']);
    $prenom = htmlentities($_POST['prenom']);
    $nom = htmlentities($_POST['nom']);
    $mail = htmlentities($_POST['mail']);
    $requete = $bdd->query("INSERT INTO users (login,mdp,nom,prenom,mail,ip,date_inscription) VALUES ('$login','$mdp','$nom','$prenom','$mail','$ip',NOW())");

    echo "<div class='connectionenc'><p class='encours'>Vous faite parti des membres du site.</p></div>";

    header('refresh:3;url=index.php');
}
?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <div class="m">
        <img class="mm" src="m.png">
    </div>
    <div class="logintop2">
        <div class="login2">
            <img class="connection" src="userplus.svg">
            <form action="#" method="post">
                <label>Login*</label>
                <input class="login" type="text" name="login" required placeholder="username" />
                <label>Mail*</label>
                <input class="login" type="email" name="mail" required placeholder="mail@domain.com" />
                <label>Password*</label>
                <input class="password" type="password" name="mdp" required placeholder="password" />
                <label>Confirm Password*</label>
                <input class="password" type="password" name="mdp1" required placeholder="confirm password" />
                <label>Personal Information :</label><br>
                <label>Prenom*</label>
                <input class="login" type="text" name="prenom" required placeholder="prenom" />
                <label>Nom*</label>
                <input class="login" type="text" name="nom" required placeholder="nom" />

                <input class="button" type="submit" name="submit" value="Inscription" />
            </form>
        </div>
    </div>