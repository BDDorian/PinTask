<!-- On inclut la page server.php afin d'envoyer tout à la base de données' -->
<?php  session_start(); ?>
<?php include('server.php') ?>
<?php
    if (isset($_SESSION['id_utilisateur']) AND isset($_SESSION['pseudo']))
    {
        echo 'Nom de la session :'.$_SESSION['pseudo'];
        echo 'Id de la session :' .$_SESSION['id_utilisateur'];
        echo 'Id de la liste :' .$_SESSION['id_liste'];
       
    }
    ?>
<!DOCTYPE html>
<html>

<head>
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
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="StyleInscription.css">
    <!--Eléments crées pour insérer JQuery DatePicker -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
			<input id="datepicker" name="dateTache" type="date">
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
 <script>
  var date = $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
  </script>