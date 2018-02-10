<!-- Vérification de la session existante -->
<?php/*
if(!isset($_SESSION)){
    session_start();
}
*/
?>
<!-- Affichage du pseudo de la session conntectée OPTIONNEL-->
  <?php
    if (isset($_SESSION['idUtilisateur']) AND isset($_SESSION['pseudo']))
    {
        echo 'Session en cours: '. $_SESSION['pseudo']. '.';
    }
    
    ?>
<!-- On inclut la page server.php afin d'envoyer tout à la base de données' -->
<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<!-- Creating the navbar -->
<!--
<div class="firstNav">
  <a class="active" href="#home">Accueil</a>
  <a class="active" href="#deconnexion">Deconnexion</a>
</div>
-->
<head>
	<title>Pintask: Création du compte</title>
	<link rel="stylesheet" type="text/css" href="StyleInscription.css">
     <!-- Se connecter avec ma base sur phpMyAdmin 
    J'applique un try catch pour capturer l'erreur afin de la traiter ultèrieurement. 
    Et surtout ne pas afficher des informations comprométantes à l'utilisateur.-->
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

<body>
	<div class="header">
		<h2>Création de votre compte</h2>
	</div>
	<!-- Formulaire composé de champs afin de créer un compte utilisateur -->
	<form method="post" action="Inscription.php">
        <!-- On vérifie si il n'y a pas d'erreurs-->
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