<html>

<head>
    <!-- J'ai crée plein de fichier css, un pour chaque page. Je sais que ce n'est pas la bonne méthode.
    Je vais regrouper tout en un, mais c'était juste histoire de remplir et de personnaliser les pages.
    -->
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
</head>
</html>
