<?php session_start(); ?>
<?php
try //connexion à la bdd
	{
		$bdd = new PDO("mysql:host=localhost;dbname=streaming;charset=utf8","root","",
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die("Base de données non trouvé");
	}
	?>
    <html>

    <head>
        <title>Connexion persistante</title>
        <meta charset="utf-8" />
    </head>

    <body>
        <?php                
            if(!empty($_POST)) /* regarde si il n'y a pas deja des données entrées */
            {
                $user = $bdd->prepare("SELECT id, login, mdp FROM users WHERE login=:login AND mdp=:mdp"); /* prepare la requete à lancer dans la bdd, pour sécuriser la saisie */
                $user->bindValue(':login',$_POST['login'],PDO:: PARAM_STR); /* s'assure que l'entrée est un texte et pas une requete */
                $user->bindValue(':mdp',sha1($_POST['mdp']),PDO:: PARAM_STR); /* s'assure que l'entrée est un texte et le crypte */
                $user->execute(); /* execute toutes les requetes */
                $donnee = $user->fetch(); /* inserre les données dans la variable $donnee */
                if($donnee = $user->fetch()) /* si il existe dans la bdd */
                {
                    $_SESSION['auth'] = $donnee; /* tout ce qui est dans donnee va dans la variable $auth */
                    
                    if(isset($_POST['remember'])) /* sert a saubegarder le cookie*/
                    {
                        setcookie('auth',$donnee['id'].'-----'.sha1($donnee['login'].$donnee['mdp'].$_SERVER['REMOTE_ADDR']),time()+(3600*24*3),'/','localhost',false,true); //le dernier argument evite que le cookie soit editalbe en javascript, remote_addr est l'adresse ip
                        
                    }                                    
                }
                else
                {
                    echo "Mauvais identifiants"; /* si il n'existe pas */
                }
                if(isset($_COOKIE['auth']) && !isset($_SESSION['auth'])) // si il y a un cookie et que la session est fausse donc qu'il n'est pas connecté
                {
                    $auth = $_COOKIE['auth']; 
                    $auth = explode('-----',$auth); // quand on rencontre '-----' on place la suite dans $auth[1]
                    $user = $bdd->prepare("SELECT * FROM users WHERE id_u=:id_u"); //on regarde dans la table où il y a l'id correspondant 
                    $user->bindValue(':id_u',$auth[0],PDO::PARAM_INT); //pour ne pas que l'on puisse entrer de requete 
                    $user->execute(); //on execute
                    $donnee = $user->fetch();
                    
                    $key = sha1($donnee['login'].$donnee['mdp'].$_SERVER['REMOTE_ADDR']);
                    
                    if($key == $auth[1]) // si les données login mdp et ip correspondent 
                    {
                        $_SESSION['auth'] = $donnee;
                        setcookie('auth',$donnee['id'].'-----'.sha1($donnee['login'].$donnee['mdp'].$_SERVER['REMOTE_ADDR']),time()+(3600*24*3),'/','localhost',false,true); //le dernier argument evite que le cookie soit editalbe en javascript
                        
				    header("Location:index.php");
                    
                    }
                    else
                    {
                        setcookie('auth','',time()-3600,'/','localhost',false,true); //si les données login mdp et ip ne correspondent pas
                    }
                }
            }
        ?>
        <form methode="post">
            Login:<input type="text" name="login" /><br /> 
            MDP:<input type="password" name="mdp" /><br /> 
            se souvenir de moi<input type="checkbox" name="remember" /><br />
            <input type="submit" value="valider" />
            <input type="reset" value="RAZ" />
        </form>
    </body>

    </html>