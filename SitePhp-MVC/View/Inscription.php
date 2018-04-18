<!-- Page d'inscription de l'utilisateur à l'aide d'un formulaire -->

<!-- Lancement de la session afin de pouvoir récupérer les variables globales de la session connectée -->
<?php
/**
 * @brief : Page d'inscription d'un nouvel utilisateur. Un formulaire est mis à sa disposition.
 */
session_start();
?>
<!-- Affichage du pseudo de la session conntectée -->
<?php
if (isset($_SESSION['idUtilisateur']) AND isset($_SESSION['pseudo']))
{
	echo 'Session en cours: '. $_SESSION['pseudo']. '.';
}    
?>
<!-- Inclusion de la page server.php afin d'envoyer les données du formulaire pour l'insertion des données dans la BDD -->
<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<!-- Creating the navbar A refaire -->
<!--
<div class="firstNav">
<a class="active" href="#home">Accueil</a>
<a class="active" href="#deconnexion">Deconnexion</a>
</div>
-->
<head>
<title>Minute Papillon: Création du compte</title>
<link rel="stylesheet" type="text/css" media="screen" href="StyleInscription.css">
<!-- Connexion à la base de données -->
<!-- Application d'un try catch pour capturer l'erreur afin de la traiter ultèrieurement. 
Et vérification de la connexion à la base de données. -->
<?php
	try
	{
		$bdd =  new PDO('mysql:host=localhost;dbname=minutepapillondb;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur'. $e->getmessage());
	}
?>
</head>
<div id="menu">
  <ul id="onglets">
	<li class="active"><a href="index.php"> Accueil </a></li>
</ul>
</div>	
<body>
<div class="header">
	<h2>Création de votre compte</h2>
</div>
<!-- Formulaire composé de champs afin de créer un compte utilisateur -->
<form method="post" action="Inscription.php">
	<!-- On vérifie si il n'y a pas d'erreurs rentrées par l'utilisateur -->
	<?php include('errors.php'); ?>

	<div class="input-group">
		<label>Nom:</label>
		<input type="text" name="nom">
	</div>
	<div class="input-group">
		<label>Prénom:</label>
		<input type="text" name="prenom">
	</div>
	<div class="input-group">
		<label>Pseudo:</label>
		<input type="text" name="pseudo">
	</div>
	<div class="input-group">
		<label>E-mail:</label>
		<input type="mail" name="mail">
	</div>
	<div class="input-group">
		<label>Mot de passe:</label>
		<input type="password" name="motDePasse">
	</div>
	<div class="input-group">
		<button type="submit" class="bouton" name="validation_compte">S'inscrire</button>
	</div>		
</form>          
</body>
</html>