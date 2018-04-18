<!-- Page de votreTache.php pour créer la tâche associée à la liste sélectionnée au préalable à partir de choixListe.php -->

<!-- On inclut la page server.php afin d'envoyer tout à la base de données' -->
<?php  session_start(); ?>
<?php include('server.php');?>

<?php
if(isset($_POST['ChoixDeVotreListe'])){
// On stocke la variable post du choix de la liste dans une variable globale afin de pouvoir l'utiliser même si la page se rafraîchit.
$_SESSION['choixDeLaListe'] =  $_POST['ChoixDeVotreListe'];
} 

?>
<!-- Si on clique sur créer la tâche mais que cela ne marche pas -->
<?php
if(isset($_POST['creation_Tache'])){
$var =  $_POST['idFromCurrentList'];
}
?>
<?php
if (isset($_SESSION['id_utilisateur']) AND isset($_SESSION['pseudo']))
{
    echo 'Nom de la session : '.$_SESSION['pseudo']; ?>
    <br>
    <?php
    echo 'Id de la session : ' .$_SESSION['id_utilisateur'];       
}
?>
<!DOCTYPE html>
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
<div id="menu">
  <ul id="onglets">
    <li class="active"><a href="index.php"> Accueil </a></li>
    <li class="active"><a href="deconnexion.php">Déconnexion </a></li>
</ul>
</div>
<body>
<div>    
    <title> Minute Papillon : Création de Tâche</title>
            
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
        <input type="hidden" name="idFromCurrentList" value=<?php echo $_SESSION['choixDeLaListe']; ?>>
        </div>

        <div class="input-group">
        <button type="submit" class="bouton" name="creation_Tache">Créer</button>
        </div>   
        </div>        
        </form>
    </div>   
<div>      
</body>

</html>
<!-- ** Inclusion du Javascript afin d'instancier l'élement datepicker avec le bon format de date -->
<script>
var date = $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
</script>