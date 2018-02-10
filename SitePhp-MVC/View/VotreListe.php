 <!-- Vérification de la session en cours, si elle n'existe pas, elle est générée --> 
  <?php
  //On teste juste en mettant uniquement un session start pour simplement récupérer la session en cours.
    //if(!isset($_SESSION)){
        session_start();
    //}
  ?>
  <!--Affiche le pseudo de la session connectée. -->
  <?php
    if (isset($_SESSION['id_utilisateur']) AND isset($_SESSION['pseudo']))
    {
        echo 'Session en cours : '. $_SESSION['pseudo']. '.';
    }
    echo "Après id";
   
    ?>
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
        $bdd =  new PDO('mysql:host=localhost;dbname=minutepapillondb;charset=utf8', 'root', '');
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
<div class="input-group">
<form action="index.php" method="post">
<div id="deuxiemeBoutonNav"><input type ="submit" name ="accueilBouton" class ="boutonHome" value="Accueil">
</div>
</form>
<form action="deconnexion.php" method="post">
<div id="premierBoutonNav"><input type="submit" name="deconnexionBouton" class="boutonDeconnexion" value="Déconnexion">
</div>
</form>
</div>


<div>
<!--Afficher la liste choisie par l'utilisateur-->
<p> <h2 class="ListChosen">Liste choisie:
<?php
echo $_POST['ChoixDeVotreListe'];
//On crée une variable qui va prendre la valeur choisie dans la liste déroulante de la page ChoixListe
$choiceFromListe = $_POST['ChoixDeVotreListe'];
echo $choiceFromListe;
?>
<SELECT>
<?php
$reqListe= $bdd-> query("SELECT id_liste FROM liste WHERE nom_liste = '$choiceFromListe'");
//$reqListe-> execute();
while($data = $reqListe->fetch()){
    //$idListeChoisie = $data['id_liste'];
    ?>
    <option><?php echo $data['id_liste']; ?>"</option>
<?php
}
?>
</SELECT>

</h2>
</p>


</div>
<title> Minute Papillon : Organiser votre travail.</title>
<body>
    <!-- Division des principaux éléments en conteneur. Cela tendra à disparaître mais c'était pour m'habituer à bien utiliser flexbox. -->
    <div id="ConteneurGlobal">                    
    <!-- Conteneur pour l'espace TO DO -->               
        <div class="header">TO DO:
        <form id="formCreationTache" method="submit" action="VotreTache.php">
            <input class="bouton" type="submit" name="boutonNouvelleTache" value="Créer Tâche">
        </form>    

            <div class="input-group">
            <label>Intitulé:</label>
            <p id="nomTacheChoisie">       
            <?php
            //Requête permettant de récupérer la dernière tâche rentrée par l'utilisateur. DESC LIMIT permet de prendre le dernier id par ordre décroissant.
            //le mot clé prepare ne marche pas. Il faut mettre query. Pourquoi ? Pour le moment, j'ai pas trouvé.'
             $reponse = $bdd->query('SELECT nom_tache FROM tache ORDER BY id_tache DESC LIMIT 1');
            while ($donnees = $reponse->fetch())
            {
                echo $donnees['nom_tache'];
            }
            $reponse->closeCursor();
   
            ?>
            </p> 
            </div>

            <div class="input-group">
            <label>Priorité :</label>
            <p id="prioriteTacheChoisie">
            <?php
            $reponse = $bdd->query('SELECT priorite_tache FROM tache ORDER BY id_tache DESC LIMIT 1');
            while ($donnees = $reponse->fetch())
            {
                echo $donnees['priorite_tache'];
            }
            $reponse->closeCursor();
            ?>
            </p>      
            </div>

            <div class="input-group">
            <label>Date :</label>
            <p id="dateTacheChoisie">
            <?php
            $reponse = $bdd->query('SELECT date_tache FROM tache ORDER BY id_tache DESC LIMIT 1');
            while ($donnees = $reponse->fetch())
            {
                echo $donnees['date_tache'];
            }
            $reponse->closeCursor();
        ?>
        </p>
    </div>    
</form>
  
</div>
<!-- Conteneur pour le bouton de TO DO à IN PROGRESS -->

<!-- Conteneur pour l'espace IN PROGRESS -->

        <div class="header">IN PROGRESS:
            <input  type="submit" id="boutonTransfert" class="bouton" value="Transfert">
            <input type="submit" id="boutonAnnulerInProgress" class ="bouton" value="Annuler">
      
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
        <div class="header">TO VERIFY:
            <input type="submit" id="boutonQuiVerify" class="bouton" value="Transfert">
            <input type="submit" id= "boutonAnnulerToVerify"  class ="bouton" value = "Annuler">

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
        <div class="header">DONE:
            <input  type="submit" id="boutonQuiDone" class="bouton" value="Transfert" style ="hidden">

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
//Déclation préalable des boutons pour annuler.
    var boutonQuiTransfert = document.getElementById('boutonTransfert');
    var boutonQuiAnnuleInProgress = document.getElementById('boutonAnnulerInProgress');
    var boutonQuiAnnuleToVerify = document.getElementById('boutonAnnulerToVerify');
    var nomTacheInProgress = document.getElementById('nomTacheChoisieInProgress');
    var nomTacheToDo = document.getElementById('nomTacheChoisie').innerHTML;
    var prioriteTacheToDo =document.getElementById('prioriteTacheChoisie').innerHTML;
    var dateTacheToDo = document.getElementById('dateTacheChoisie').innerHTML;
    //Déclaration des constantes pour les réutiliser avec le bouton annuler.
    const constNameTaskChosen = document.getElementById('nomTacheChoisie').innerHTML;
    const constPriorityChosen = document.getElementById('prioriteTacheChoisie').innerHTML;
    const constDateTaskChosen = document.getElementById('dateTacheChoisie').innerHTML;

    //Définition des boutons à invisible au départ
    boutonQuiAnnuleInProgress.style.display = "hidden";
    boutonQuiAnnuleToVerify.style.display = "hidden";

    
   boutonQuiTransfert.onclick = function() {
      
       document.getElementById('nomTacheChoisieInProgress').innerHTML = document.getElementById('nomTacheChoisie').innerHTML;
       document.getElementById('prioriteInProgress').innerHTML = document.getElementById('prioriteTacheChoisie').innerHTML;
       document.getElementById('dateInProgress').innerHTML = document.getElementById('dateTacheChoisie').innerHTML;
       document.getElementById('nomTacheChoisie').innerHTML = "";
       document.getElementById('prioriteTacheChoisie').innerHTML = "";
       document.getElementById('dateTacheChoisie').innerHTML = "";
    
    };
    // Annulation des éléments présents dans la colonne sélectionée. En cliquant, les données de la tâche sont retransférées automatiquement dans la section  précédente.
    boutonQuiAnnuleInProgress.onclick = function() {
        nomTacheInProgress.innerHTML = "";
        document.getElementById('prioriteInProgress').innerHTML ="";
        document.getElementById('dateInProgress').innerHTML ="";
        document.getElementById('nomTacheChoisie').innerHTML = constNameTaskChosen;
        document.getElementById('prioriteTacheChoisie').innerHTML = constPriorityChosen;
        document.getElementById('dateTacheChoisie').innerHTML = constDateTaskChosen;
        
    };
// Transfert des élements de InProgress à To Verify via le clic du bouton.
    boutonQuiVerify.onclick = function() {
        document.getElementById('nameToVerify').innerHTML = document.getElementById('nomTacheChoisieInProgress').innerHTML;
        document.getElementById('prioriteToVerify').innerHTML = document.getElementById('prioriteInProgress').innerHTML;
        document.getElementById('dateToVerify').innerHTML = document.getElementById('dateInProgress').innerHTML;
        document.getElementById('nomTacheChoisieInProgress').innerHTML = "";
        document.getElementById('prioriteInProgress').innerHTML = "";
        document.getElementById('dateInProgress').innerHTML = "";

        //Set le bouton transfert à visible
        document.getElementById('boutonQuiDone').style.visibility = visible;
    };
    boutonQuiAnnuleToVerify.onclick = function() {
        
        document.getElementById('nomTacheChoisieInProgress').innerHTML = constNameTaskChosen;
        document.getElementById('prioriteInProgress').innerHTML = constPriorityChosen;
        document.getElementById('dateInProgress').innerHTML = constDateTaskChosen;
        document.getElementById('nameToVerify').innerHTML = "";
        document.getElementById('prioriteToVerify').innerHTML = "";
        document.getElementById('dateToVerify').innerHTML = "";
        
    };
// Transfert final des éleemnts de To Verify à Done via le clic du bouton.  
    boutonQuiDone.onclick = function() {
        document.getElementById('nomDone').innerHTML = document.getElementById('nameToVerify').innerHTML;
        document.getElementById('prioriteDone').innerHTML = document.getElementById('prioriteToVerify').innerHTML;
        document.getElementById('dateDone').innerHTML = document.getElementById('dateToVerify').innerHTML;
        document.getElementById('nameToVerify').innerHTML = "";
        document.getElementById('prioriteToVerify').innerHTML = "";
        document.getElementById('dateToVerify').innerHTML = "";
        //Une fois que l'on arrive au Done. Les boutons précédents sont désactivés.
        document.getElementById('boutonTransfert').style.visibility ='hidden';
        document.getElementById('boutonQuiVerify').style.visibility = 'hidden';
        document.getElementById('boutonAnnulerInProgress').style.visibility = 'hidden';
        document.getElementById('boutonAnnulerToVerify').style.visibility = 'hidden';
    };
    boutonQuiAnnule.onclick = function() {
        nomTacheInProgress.innerHTML = "";
        document.getElementById('nameToVerify').innerHTML =constNameTaskChosen;
        document.getElementById('prioriteToVerify').innerHTML =constPriorityChosen;
        document.getElementById('dateToVerify').innerHTML = constDateTaskChosen;
        document.getElementById('nomDone').innerHTML = "";
        document.getElementById('prioriteDone').innerHTML = "";
        document.getElementById('dateDone').innerHTML = "";
        
    };
</script>