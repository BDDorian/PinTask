<!-- Vérification de la session en cours. Si elle n'existe pas, elle est générée. -->
<?php
if(!isset($_SESSION)){
    session_start();
}
?>
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
        $bdd =  new PDO('mysql:host=localhost;dbname=minutepapillon;charset=utf8', 'root', '');
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
<nav>
<input type="submit" name="deconnexionBouton" class="bouton">
</nav>

<body>
    <div>    
            <title> Minute Papillon : Création de Tâche</title>
        
        <div class="header">Création de votre tâche </div>
       
        <div class ="ConteneurChampListe">
            <form action="VotreListe.php" method="post">
            <!-- Vérification des erreurs -->
            <?php include('errors.php'); ?>

            <div class="input-group">
			<label>Nom de votre tâche:</label>
			<input type="text" name="nomTache">
		    </div>

             <!-- Implémentation du DatePicker, à vérifier si la BDD se met à jour avec la date choisie -->
            <div class="input-group">
            <label>Date de création de votre tâche:</label>
            <input id="datepicker"  name="dateTache" type="date">
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
 <!-- Inclusion du datepicker -->
<script>
  var date = $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
</script>