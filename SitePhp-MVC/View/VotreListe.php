<html>
<head>
    <!--Inclusion du fichier server.php -->
    <?php include('server.php') ?>
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
</head>   
<title> Minute Papillon : Organiser votre travail.</title>
<body>
    <label>Vous avez choisi : ""></label>
    <!-- Division des principaux éléments en conteneur. Cela tendra à disparaître mais c'était pour m'habituer à bien utiliser flexbox. -->
<div id="ConteneurGlobal">                      
<!-- Conteneur pour l'espace TO DO -->               
<div id="ConteneurPrincipal">To Do:
<form method="post" action="VotreTache.php">
    <div class="element">
        <label>Intitulé :</label>
        <input name="nomTacheChoisie"></input>
        <label>Ici:
        <?php
        //Requête permettant de récupérer la dernière tâche rentrée par l'utilisateur. DESC LIMIT permet de prendre le dernier id par ordre décroissant.'
         $reponse = $bdd->prepare('SELECT nomTache FROM tache ORDER BY idTache DESC LIMIT 1');

        while ($donnees = $reponse->fetch())

        {
            echo $donnees['nomTache'];
        }
            $reponse->closeCursor();

        ?>
        </label>
    </div>

    <div class="element">
        <label>Priorité :</label>
        <label name="prioriteTacheChoisie">
        <?php
        
         $reponse = $bdd->prepare('SELECT prioriteTache FROM tache ORDER BY idTache DESC LIMIT 1');

        while ($donnees = $reponse->fetch())

        {
            echo $donnees['prioriteTache'];
        }
            $reponse->closeCursor();

        ?>
        </label>
    </div>

    <div class="element">
        <label>Date :</label>
        <label="dateTacheChoisie">
        <?php
         $reponse = $bdd->prepare('SELECT dateTache FROM tache ORDER BY idTache DESC LIMIT 1');

        while ($donnees = $reponse->fetch())

        {
            echo $donnees['dateTache'];
        }
            $reponse->closeCursor();

        ?>
        </label>
    </div>
    <div class="element">
       <button class="bouton" name="boutonNouvelleTache">Créer nouvelle tâche</buton>
    </div>
    </form>
  
</div>
<!-- Conteneur pour le bouton de TO DO à IN PROGRESS -->

<!-- Conteneur pour l'espace IN PROGRESS -->
<form method="get" action="VotreListe.php">
<div id="ConteneurPrincipal">In progress:
 <input  type="submit" name="boutonTransfert" value="Transfert">
 <label>PrioritéPrincipale:</label>
  </form>     
    <div class="element">
        <label>Intitulé :</label>
        <label name="nomTacheChoisieInProgress">

        </label>
    </div>

    <div class="element">
        <label>Priorité :</label>
        <label name="prioriteInProgress">
        <?php
        
        ?></label>
    </div>

    <div class="element">
        <label>Date :</label>
        <input disabled="true"></input>
    </div>
</div>

<!-- Conteneur pour l'espace TO VERIFY -->
<div id="ConteneurPrincipal">To verify:

    <div class="element">
        <label>Intitulé :</label>
        <input disabled="true"></input>
    </div>

    <div class="element">
        <label>Priorité :</label>
        <input disabled="true"></input>
    </div>

    <div class="element">
        <label>Date :</label>
        <input disabled="true"></input>
    </div>
</div>
<!-- Conteneur pour l'espace DONE -->    
    <div id="ConteneurPrincipal">Done:

    <div class="element">
        <label>Intitulé :</label>
        <input disabled="true"></input>
    </div>

    <div class="element">
        <label>Priorité :</label>
        <input disabled="true"></input>
    </div>

    <div class="element">
        <label>Date :</label>
        <input disabled="true"></input>
    </div>
</div>
<!-- fermeture conteneur global -->
</div>
</body>
</html>
<!--
<script>
function vider()
{
	document.getElementById("tacheToDo").value = "";
	return false;
};
</script>
-->