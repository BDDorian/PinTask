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
        $bdd =  new PDO('mysql:host=localhost;dbname=pintaskbdd;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur'. $e->getmessage());
    }
    ?>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="StyleInscription.css">
    
<title> PinTask : Choix de Liste</title>
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
    <div class="chooseList">
    <p class="choixNouvelleListe"> Choisir une liste déjà crée: </p>
        <form action="ChoixListe.php" method="POST">
        <SELECT>
        <OPTION class="ListeChoisie">
        <?php 
        $reponse = $bdd->query('SELECT nomListe FROM liste WHERE IDListe = 1');

        while ($donnees = $reponse->fetch())

        {
            echo $donnees['nomListe'] . '<br />';
        }
            $reponse->closeCursor();
        ?>
        </OPTION>
        <OPTION>
        <?php 
        $reponse = $bdd->query('SELECT nomListe FROM liste where IDListe = 2');

        while ($donnees = $reponse->fetch())

        {
            echo $donnees['nomListe'] . '<br />';
        }
            $reponse->closeCursor();
        ?>
        </OPTION>

        </SELECT>
        
    </div>    
     <div class="input-group">
			<button type="submit" class="bouton" name="choixListe">Séléctionner</button>
		</div> 
        </form> 
    </div>
    <!-- Bouton crée juste pour aller à la page VotreListe.php -->
    <form action = "VotreListe.php" method="POST">
    <button type="submit" class="bouton" name="choixListe">Page Votre Liste</button>
    </form>
</div>    


</body>
</head>
</html>
