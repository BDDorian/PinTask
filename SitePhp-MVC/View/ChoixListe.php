
<html>
<head> 
    <?php include('server.php');
    ?>

    
    <?php
        //if(!isset($_SESSION)){
        session_start();
        //}
        
    ?>

  <?php
    if (isset($_SESSION['id_utilisateur']) AND isset($_SESSION['pseudo']))
    {
        echo 'Nom de la session :'.$_SESSION['pseudo'];
        echo 'Id de la session :' .$_SESSION['id_utilisateur'];
       
    }
    $idUtilisateurFK = $_SESSION['id_utilisateur'];
    
   ?>
     <!-- Se connecter avec ma base sur phpMyAdmin 
    J'applique un try catch pour capturer l'erreur afin de la traiter ultèrieurement. 
    Et surtout ne pas afficher des informations comprométantes à l'utilisateur.-->
    <?php
    try
    {
        $bdd =  new PDO('mysql:host=localhost;dbname=minutepapillondb;charset=utf8', 'root', '');
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
<form action ="index.php" method="post">
<input type="submit" name="indexBouton" class="bouton" value="Accueil">
</form>
<form action="deconnexion.php" method="post">
<input type="submit" name="decoButton" class="bouton" value="Deconnexion">
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
        
        <!--<OPTION class="premierChoix">-->
        <?php
        
        // On recupère bien les listes mais pas celles liées à l'id
        //Solution actuelle 09/02 : On essaye de récupérer l'idée grâce à :
        //Cela marche, il manque simplement de les afficher bien comme il faut dans la liste.
        $idUtilisateurFK = $_SESSION['id_utilisateur'];
        $reponse = $bdd->query("SELECT nom_liste FROM liste WHERE id_utilisateur = '$idUtilisateurFK'");
        //$reponse ->execute();
        //echo $reponse;
        while($data = $reponse->fetch())
        {
            ?>
            <option><?php echo $data['nom_liste']; ?>"</option>
            
        <?php
        }
        ?>
        </SELECT>
            <?php 
        /*$reponse = $bdd->query('SELECT nom_liste FROM liste WHERE id_utilisateur=2');
        while ($donnees = $reponse->fetch())
        {
            echo $donnees['nom_liste'];
        }
            $reponse->closeCursor();
        ?>
        </OPTION>
        <OPTION>
            <?php 
        $reponse = $bdd->query('SELECT nom_liste FROM liste WHERE id_liste=3');
        while ($donnees = $reponse->fetch())
        {
            echo $donnees['nom_liste'];
        }
            $reponse->closeCursor();
        ?>
        </OPTION>
       
        </SELECT>
        */
        ?>
        <div class="input-group">
			<button type="submit" class="bouton" name="choixListe">Séléctionner</button>
		</div>
         </form>  
    </div>    
      
   
</div>    
</body>
</html>