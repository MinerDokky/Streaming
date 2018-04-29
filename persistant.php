<?php include 'include/connectionbdd.php' ?>

<!DOCTYPE html>
<html>
	<head>
		<title>connexion persistante</title>
	</head>
	<body>
		<?php
			if(!empty($_POST))
			{
				$user = $bdd->query("SELECT id_u,login,mdp FROM user WHERE login=:login AND mdp=:mdp");
				$user->bindValue(':login',$_POST['login'],PDO::PARAM_STR);
				$user->bindValue(':mdp',sha1($_POST['mdp']),PDO::PARAM_STR);
				
				$donnee = $user->fetch();
				if($donnee = $user->fetch())
				{
					$_SESSION['auth'] = $donnee;
					if(isset($_POST['remember']))
					{
						setcookie('auth',$donnee['id_u'].'-----'.sha1($donnee['login'].$donnee['mdp'].$_SERVER['REMOTE_ADDR']),time()+(3600*24*3),'/','localhost',false,true);
					}
				}
				else
				{
					echo "Mauvais identifiants";
				}
			}

			if(isset($_COOKIE['auth']) && !isset($_SESSION['auth']))
			{
				$auth = $_COOKIE['auth'];
				$auth = explode('-----',$auth);
				$user = $bdd->query("SELECT * FROM users WHERE login=:login");

				$donnee = $user->fetch();

				$key = sha1($donnee['login'].$donnee['mdp'].$_SERVER['REMOTE_ADDR']);

				if($key == $auth[0])
				{
					$_SESSION['auth'] = $donnee;
					setcookie('auth',$donnee['id_u'].'-----'.sha1($donnee['login'].$donnee['mdp'].$_SERVER['REMOTE_ADDR']),time()+(3600*24*3),'/','localhost',false,true);
				}
				else
				{
					setcookie('auth','',time()-3600,'/','localhost',false,true);
				}
			}
		?>
		<form method="post">
			Login:<input type="text" name="login" /><br />
			MDP:<input type="password" name="mdp" /><br />
			Se souvenir de moi<input type="checkbox" name="remember" /><br />
			<input type="submit" name="valider">
			<input type="reset" name="RAZ">
		</form>
	</body>
</html>