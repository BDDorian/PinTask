<?php
if(!isset($_SESSION)){
    session_start();
}
?>
<html>
<head>
    <?php include('server.php');
    ?>
    <?php include('deconnexion.php');
    ?>
    <!-- Vérifie si on a bien enregistré la session -->
    <?php
    if (isset($_SESSION['idUtilisateur']) AND isset($_SESSION['pseudo']))
    {
        echo 'en tant que '. $_SESSION['pseudo']. '.';
    }
    
    ?>
    <button type="submit" class="bouton" name="accueilBouton">Accueil</button>
    
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
   
<title> Minute Papillon : Choix de Liste</title>
</head>
<form method="post" action="index.php">
<input type="submit" name="decoBouton" class="bouton" value="Déconnexion">
</form>
<body>    
<div>
    <div class="header"> Création de votre liste
    </div>
    <p class="creationNouvelleListe"> Pour créer votre liste: </br>
    <form action="CreationListe.php" method="post">
       <div class="input-group">
			<button type="submit" class="bouton" name="Creation_List">Créer une liste</button>
		</div>     
                       
        </form>  
        <!-- Liste déroulante permettant à l'utilisateur de sélectionner la liste crée-->
    <div class="chooseList">
    <p class="choixNouvelleListe"> Choisir une liste déjà crée: </p>
        <form action="VotreListe.php" method="POST">
        <SELECT name="ChoixDeVotreListe">
        <OPTION class="premierChoix">
        <?php 
        $reponse = $bdd->query('SELECT nomListe FROM liste WHERE idListe=1');

        while ($donnees = $reponse->fetch())

        {
            echo $donnees['nomListe'];
        }
            $reponse->closeCursor();
        ?>
        </OPTION>
        <OPTION class="deuxiemeChoix">
            <?php 
        $reponse = $bdd->query('SELECT nomListe FROM liste WHERE idListe=2');

        while ($donnees = $reponse->fetch())

        {
            echo $donnees['nomListe'];
        }
            $reponse->closeCursor();
        ?>
        </OPTION>
        <OPTION>
            <?php 
        $reponse = $bdd->query('SELECT nomListe FROM liste WHERE idListe=3');

        while ($donnees = $reponse->fetch())

        {
            echo $donnees['nomListe'];
        }
            $reponse->closeCursor();
        ?>
        </OPTION>
       
        </SELECT>
        <div class="input-group">
			<button type="submit" class="bouton" name="choixListe">Séléctionner</button>
		</div>
         </form>  
    </div>    
      
   
</div>    
</body>
</html>
