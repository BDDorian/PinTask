<!-- Page ChoixListe.php Création d'une liste à l'aide d'un formulaire à valider -->
<?php
if(!isset($_SESSION)){
session_start();
}
?>
<!-- Utilisation de la variable globale SESSION afin d'afficher la session en cours. -->
<?php
if (isset($_SESSION['id_utilisateur']) AND isset($_SESSION['pseudo']))
{
    echo 'Nom de la session :'.$_SESSION['pseudo'];
    echo 'Id de la session :' .$_SESSION['id_utilisateur'];   
}
?>
<!-- On inclut la page server.php afin d'envoyer les éléments du formulaire pour réaliser les requêtes d'insertion. -->
<?php include('server.php') ?>
<!-- à voir si je laisse ça en commentaire <!DOCTYPE html> -->
<html>
<head>
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
<meta charset="utf-8"/>
<link rel="stylesheet" href="StyleInscription.css">
<!--Eléments de la librairie JQUERY pour insérer le DatePicker -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<nav>
<!-- Formulaire pour retourner à la page d'accueil sans se déconnecter de la session utilisée -->
<form action ="index.php" method="post">
<input type="submit" name="indexBouton" class="bouton" value="Accueil">
</form>
<!-- Formulaire pour se déconnecter de la session en cours -->
<form action="deconnexion.php" method="post">
<input type="submit" name="decoButton" class="bouton" value="Deconnexion">
</form>
</nav>
<body>
<div>    
    <title> Minute Papillon : Création de Liste</title>
        <!-- Formulaire pour créer une nouvelle liste -->     
    <div class="header">Création de votre liste </div>
    <div class ="ConteneurChampListe">
        <form action="CreationListe.php" method="post">
        <!-- Inclusion de la page errors.php afin de vérifier les erreurs d'insertion des champs -->
        <?php include('errors.php'); ?>

        <div class="input-group">
        <label>Nom de votre liste:</label>
        <input type="text" name="nomListe">
        </div>

        <!-- Implémentation du DatePicker issue de la librairie JQUERY-->
        <div class="input-group">
        <label>Date de création de votre liste:</label>
        <input id="datepicker"  name="dateListe" type="date">
        </div>

        <div class="input-group">
        <label>Priorité de votre liste:</label>
        <input type="number" value="1" min="1" max="4" name="prioriteListe">
        </div>

        <div class="input-group">
        <button type="submit" class="bouton" name="creation_Liste">Créer</button>
        </div>           
        </form>
    </div> 
</div>      
</body>
</html>
<!-- ** Inclusion du Javascript afin d'instancier l'élement datepicker avec le bon format de date -->
<script>
var date = $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
</script>