 <?php

if(!isset($_SESSION)){
    session_start();
}
?>
 <meta charset="utf-8"/>
    <link rel="stylesheet" href="StyleInscription.css">

<?php include('server.php'); ?>

<?php
echo "C'est dommage" $_SESSION['pseudo'] . "vous rencontrez une Erreur 404. 
Il est impossible de vous connecter à la page demandée. 
Cliquez sur le bouton retour pour revenir à la page d'accueil.";
?>
<form action="index.php">
<button type="submit"class="bouton" name="retourAccueil">Retourner à la page d'accueil</button>
</form>