 <!-- Page de visualisation de la to do list -->
 
 <!-- Démarrage de la session pour récupérer les données $_SESSION --> 
  <?php
        session_start();
  ?>
  <!--Affiche le pseudo de la session connectée. -->
  <?php
    if (isset($_SESSION['id_utilisateur']) AND isset($_SESSION['pseudo']))
    {
        echo 'Session en cours : '. $_SESSION['pseudo']. '.';
    }
    ?>
<html>
<head>
    <!--Inclusion du fichier server.php pour la transmission des requêtes. -->
    <?php include('server.php') ?>
    
<!-- Connexion à la base de données -->
<!-- Application d'un try catch pour capturer l'erreur afin de la traiter ultèrieurement. 
Et vérification de la connexion à la base de données. -->
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
<div id="menu">
  <ul id="onglets">
    <li class="active"><a href="index.php"> Accueil </a></li>
    <li class="active"><a href="deconnexion.php">Déconnexion </a></li>
</ul>
</div>
<div>
<!--Afficher la liste choisie par l'utilisateur à l'aide d'une requête sur la base de données.-->
<p> <h2 class="ListChosen">Liste choisie:</p>
<?php
$idListFrom = $_SESSION['choixDeLaListe'];
//Requête crée pour récupérer le nom de la liste sélectionnée sur choixListe.php et l'afficher sur cette page.
$reqFindNameList = $bdd->query("SELECT nom_liste, id_liste FROM liste WHERE id_liste = '$idListFrom'");
while($donnees = $reqFindNameList -> fetch()){
        echo $donnees['nom_liste'];
    }
    $reqFindNameList->closeCursor();
?>
</h2>
</div>
<title> Minute Papillon : Organiser votre travail.</title>
<body>
    <!-- Division des principaux éléments en conteneur. Utilisation de flexbox -->
    <div id="ConteneurGlobal">                    
    <!-- Conteneur pour l'espace TO DO -->               
        <div class="header">TO DO: 
        <form id="formCreationTache" method="submit" action="VotreTache.php">
            
            <input class="bouton" type="submit" style="hidden" name="boutonNouvelleTache" id="boutonCreerTache" value="Créer Tâche">
        </form>    

            <div class="input-group">
            <label>Intitulé:</label>
            <p id="nomTacheChoisie">      
            <?php 
            /* Requête SQL permettant d'afficher le nom de la dernière tâche crée par l'utilisateur avec la liste liée */
            $idListGet = $_SESSION['choixDeLaListe'];
            $reponse = $bdd->query("SELECT nom_tache, id_liste FROM tache  WHERE id_liste = '$idListGet' ORDER BY id_tache DESC LIMIT 1 ");
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
            /* Requête SQL permettant d'afficher la priorité de la tâche */
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
            /* Requête SQL afin d'afficher la date de la tâche associée. */
            $reponse = $bdd->query('SELECT date_tache, id_liste FROM tache ORDER BY id_tache DESC LIMIT 1');
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
            <input type="submit" name="boutonQuiSupprime" class ="bouton" value="Supprimer" style ="hidden">
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
/** JAVASCRIPT **/

//Déclation préalable des boutons pour annuler.
    var boutonQuiTransfert = document.getElementById('boutonTransfert');
    var boutonQuiAnnuleInProgress = document.getElementById('boutonAnnulerInProgress');
    var boutonQuiAnnuleToVerify = document.getElementById('boutonAnnulerToVerify');
    var boutonCreerNouvelleTache = document.getElementById('boutonCreerTache');
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
    boutonCreerNouvelleTache.style.visibility ="hidden";

   // Fonction permettant le transfert de la tâche de TO DO à in PROGRESS; 
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
        document.getElementById('boutonCreerTache').style.visibility = 'visible';
        //document.getElementById('boutonQuiTransfert').disabled = 'true';
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