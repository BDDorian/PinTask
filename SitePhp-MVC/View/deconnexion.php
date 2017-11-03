<?php 
if(!isset($_SESSION)){
    session_start();
}
// Suppression des variables de session et de la session
if(isset($_POST['decoBouton']))
{

$_SESSION = array();

// On détruit les variables de notre session
session_unset ();

session_destroy();

header('location: index.php');
}


?>