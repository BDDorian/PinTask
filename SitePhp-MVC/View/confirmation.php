<?php
    if(isset($_GET['pseudo'], $_GET['cleConfirmation']) AND !empty($_GET['pseudo']) AND !empty($_GET['cleConfirmation'])){
    $pseudo = htmlspecialchars(urldecode($_GET['pseudo']));
    $cleConfirmation = intval($_GET['cleConfirmation']);
    $reqconfirm = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo = ?");
    $reqconfirm->execute(array($pseudo));

    }
?>