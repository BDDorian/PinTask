
  <!-- On inclut la page server.php afin d'envoyer tout à la base de données' -->
<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
     <!-- Se connecter avec ma base sur phpMyAdmin 
    J'applique un try catch pour capturer l'erreur afin de la traiter ultèrieurement. 
    Et surtout ne pas afficher des informations comprométantes à l'utilisateur.-->
    <?php
    try
    {
        $bdd =  new PDO('mysql:host=localhost;dbname=pintaskbdd;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur'. $e->getmessage());
    }
    ?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="StyleInscription.css">
</head>
<body>
    <div>    
            <title> PinTask : Création de Liste</title>
              
        <div class="header">Création de votre liste </div>
       
        <div class ="ConteneurChampListe">
            <form action="CreationListe.php" method="post">
            <!-- Vérification des erreurs -->
            <?php include('errors.php'); ?>

            <div class="input-group">
			<label>Nom de votre liste:</label>
			<input type="text" name="nomListe">
		    </div>

            <div class="input-group">
			<label>Priorité de votre liste:</label>
			<input type="number" value="1" min="1" max="4" name="prioriteListe">
		    </div>

            <div class="input-group">
			<label>Date de création de votre liste:</label>
			<input id="date" name="dateListe" type="text">
		    </div>
            <div class="input-group">
			<button type="submit" class="bouton" name="creation_Liste">Créer</button>
		    </div>           
            </form>
        </div>   
    <div>      
</body>

</html>
 <!-- ** ON MET LE JAVASCRIPT TOUT EN BAS, QUESTION DE CLARTE ** -->
