
 <meta charset ="utf-8"/>
    <link rel="stylesheet" href="StyleInscription.css">

<p class="messageError"> Déconnexion réussie ! </p>
<form action="index.php">
<button type="submit"class="bouton" name="retourAccueil">Retourner à la page d'accueil</button>
</form>

<?php 
/*
if(!isset($_SESSION)){
    session_start();
}
*/
// Suppression des variables de session et de la session
if(isset($_POST['retourAccueil']))
{
$_SESSION = array();
// On détruit les variables de notre session
session_unset ();
session_destroy();
header('location: index.php');
}
?>