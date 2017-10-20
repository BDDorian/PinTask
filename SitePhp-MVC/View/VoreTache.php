
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
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="StyleInscription.css">
</head>

<body>
    <div>    
            <title> PinTask : Création de Tâche</title>
              
        <div class="header">Création de votre tâche </div>
        <!-- Formulaire crée pour insérer la tâche voulue par l'utilisateur -->
        <div class ="ConteneurChampListe">
            <form action="VotreTache.php" method="post">
            <!-- Vérification des erreurs -->
            <?php include('errors.php'); ?>

            <div class="input-group">
			<label>Nom de votre tâche:</label>
			<input type="text" name="nomTache">
		    </div>

            <div class="input-group">
			<label>Date de création de votre tâche:</label>
			<input id="date" name="dateTache" type="text">
		    </div>

            <div class="input-group">
			<label>Priorité de votre tâche:</label>
			<input type="number" value="1" min="1" max="4" name="prioriteTache">
		    </div>

            <div class="input-group">
			<button type="submit" class="bouton" name="creation_Tache">Créer</button>
		    </div>           
            </form>
        </div>   
    <div>      
</body>

</html>
 <!-- ** ON MET LE JAVASCRIPT TOUT EN BAS, QUESTION DE CLARTE ** -->
