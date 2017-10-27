<?php 

// Suppression des variables de session et de la session
if(isset($_POST['deconnexionBouton']))
{
$_SESSION = array();
session_destroy();
echo "ahahahhah";
}

?>