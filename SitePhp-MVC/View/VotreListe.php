 <!-- Vérification de la session en cours, si elle n'existe pas, elle est générée --> 
  <?php

    if(!isset($_SESSION)){
        session_start();
    }
  ?>
  <!--Affiche le pseudo de la session connectée. -->
  <?php
    if (isset($_SESSION['idUtilisateur']) AND isset($_SESSION['pseudo']))
    {
        echo 'en tant que '. $_SESSION['pseudo']. '.';
    }
    
    ?>
<html>
<head>
    <!--Inclusion du fichier server.php -->
    <?php include('server.php') ?>
    <?php include('deconnexion.php') ?>
     <!-- Se connecter avec ma base sur phpMyAdmin 
    J'applique un try catch pour capturer l'erreur afin de la traiter ultèrieurement. 
    Et surtout ne pas afficher des informations comprométantes à l'utilisateur.-->
     <?php
    try
    {
        $bdd =  new PDO('mysql:host=localhost;dbname=minutepapillon;charset=utf8', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    catch (Exception $e)
    {
        die('Erreur'. $e->getmessage());
    }
    ?>

    <meta charset="utf-8"/>
    <link rel="stylesheet" href="StyleInscription.css">
</head> 
<form action ="index.php" method="post">
<input type="submit" name="deconnexionBouton" class="bouton" value="Déconnexion">
</form>
<title> Minute Papillon : Organiser votre travail.</title>
<body>
    <label>Vous avez choisi : ""></label>
    <!-- Division des principaux éléments en conteneur. Cela tendra à disparaître mais c'était pour m'habituer à bien utiliser flexbox. -->
    <div id="ConteneurGlobal">                    
    <!-- Conteneur pour l'espace TO DO -->               
        <div class="header">To Do:
            <input class="bouton" type="submit" name="boutonNouvelleTache" value="Créer Tâche">
            <form id="formCreationTache" method="post" action="VotreTache.php">

            <div class="input-group">
            <label>Intitulé:</label>
            <p id="nomTacheChoisie">       
            <?php
            //Requête permettant de récupérer la dernière tâche rentrée par l'utilisateur. DESC LIMIT permet de prendre le dernier id par ordre décroissant.
            //le mot clé prepare ne marche pas. Il faut mettre query. Pourquoi ? Pour le moment, j'ai pas trouvé.'
             $reponse = $bdd->query('SELECT nomTache FROM tache ORDER BY idTache DESC LIMIT 1');

            while ($donnees = $reponse->fetch())

            {
                echo $donnees['nomTache'];
            }
            $reponse->closeCursor();
   
            ?>
            </p> 
            </div>

            <div class="input-group">
            <label>Priorité :</label>
            <p id="prioriteTacheChoisie">
            <?php
            $reponse = $bdd->query('SELECT prioriteTache FROM tache ORDER BY idTache DESC LIMIT 1');

            while ($donnees = $reponse->fetch())

            {
                echo $donnees['prioriteTache'];
            }
            $reponse->closeCursor();
            ?>
            </p>      
            </div>

            <div class="input-group">
            <label>Date :</label>
            <p id="dateTacheChoisie">
            <?php
            $reponse = $bdd->query('SELECT dateTache FROM tache ORDER BY idTache DESC LIMIT 1');

            while ($donnees = $reponse->fetch())

            {
                echo $donnees['dateTache'];
            }
            $reponse->closeCursor();
        ?>
        </p>
    </div>    
</form>
  
</div>
<!-- Conteneur pour le bouton de TO DO à IN PROGRESS -->

<!-- Conteneur pour l'espace IN PROGRESS -->

        <div class="header">In progress:
            <input  type="submit" id="boutonTransfert" class="bouton" value="Transfert">
            <input type="submit" id="boutonAnnuler" value="Annuler">
            <label>PrioritéPrincipale:</label>
      
            <div class="input-group">
            <label>Intitulé :</label>
            <p id="nomTacheChoisieInProgress"></p>   
            </div>

            <div class="input-group">
            <label>Priorité :</label>
            <p id="prioriteInProgress"></p> 
            </label>
            </div>

            <div class="input-group">
            <label>Date :</label>
            <p id="dateInProgress"></p>
            </div>
        </div>

<!-- Conteneur pour l'espace TO VERIFY -->
        <div class="header">To verify:
            <input type="submit" id="boutonQuiVerify" class="bouton" value="Transfert">

            <div class="input-group">
            <label>Intitulé :</label>
            <p id="nameToVerify"></p>
            </div>

            <div class="input-group">
            <label>Priorité :</label>
            <p id="prioriteToVerify"></p>
            </div>

            <div class="input-group">
            <label>Date :</label>
            <p id="dateToVerify"></p>
            </div>
        </div>
<!-- Conteneur pour l'espace DONE -->    
        <div class="header">Done:
            <input  type="submit" id="boutonQuiDone" class="bouton" value="Transfert">

            <div class="input-group">
            <label>Intitulé :</label>
            <p id="nomDone"></p>
            </div>

            <div class="input-group">
            <label>Priorité :</label>
            <p id="prioriteDone"></p>
            </div>

            <div class="input-group">
            <label>Date :</label>
            <p id="dateDone"></p>
            </div>
        </div>
<!-- fermeture conteneur global -->
</div>
 
</body>
</html>
<script>
// Inclusion du Javascript.
// Test de transfert des données entre les deux formulaires par l'usage d'un bouton et de javascript
// Cela fonctionne toutefois le code ne paraît peut être pas encore très propre.

    var boutonQuiTransfert = document.getElementById('boutonTransfert');
    var boutonQuiAnnule = document.getElementById('boutonAnnuler');

    var nomTacheInProgress = document.getElementById('nomTacheChoisieInProgress');
    var nomTacheToDo = document.getElementById('nomTacheChoisie');
    var prioriteTacheToDo =document.getElementById('prioriteTacheChoisie').innerHTML;
    var dateTacheToDo = document.getElementById('dateTacheChoisie').innerHTML;




   boutonQuiTransfert.onclick = function() {
      
       document.getElementById('nomTacheChoisieInProgress').innerHTML = document.getElementById('nomTacheChoisie').innerHTML;
       document.getElementById('prioriteInProgress').innerHTML = document.getElementById('prioriteTacheChoisie').innerHTML;
       document.getElementById('dateInProgress').innerHTML = document.getElementById('dateTacheChoisie').innerHTML;

       document.getElementById('nomTacheChoisie').innerHTML = "";
       document.getElementById('prioriteTacheChoisie').innerHTML = "";
       document.getElementById('dateTacheChoisie').innerHTML = "";
    

    };

    boutonQuiAnnule.onclick = function() {

        nomTacheInProgress.innerHTML = "";
        document.getElementById('prioriteInProgress').innerHTML ="";
        document.getElementById('dateInProgress').innerHTML ="";
        
    };
// Transfert des élements de InProgress à To Verify via le clic du bouton.
    boutonQuiVerify.onclick = function() {

        document.getElementById('nameToVerify').innerHTML = document.getElementById('nomTacheChoisieInProgress').innerHTML;
        document.getElementById('prioriteToVerify').innerHTML = document.getElementById('prioriteInProgress').innerHTML;
        document.getElementById('dateToVerify').innerHTML = document.getElementById('dateInProgress').innerHTML;

        document.getElementById('nomTacheChoisieInProgress').innerHTML = "";
        document.getElementById('prioriteInProgress').innerHTML = "";
        document.getElementById('dateInProgress').innerHTML = "";
    };

// Transfert final des éleemnts de To Verify à Done via le clic du bouton.  

boutonQuiDone.onclick = function() {

        document.getElementById('nomDone').innerHTML = document.getElementById('nameToVerify').innerHTML;
        document.getElementById('prioriteDone').innerHTML = document.getElementById('prioriteToVerify').innerHTML;
        document.getElementById('dateDone').innerHTML = document.getElementById('dateToVerify').innerHTML;

        document.getElementById('nameToVerify').innerHTML = "";
        document.getElementById('prioriteToVerify').innerHTML = "";
        document.getElementById('dateToVerify').innerHTML = "";
    };

</script>
