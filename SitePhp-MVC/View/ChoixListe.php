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
    <div class="header"> Création de votre liste </h1>
    </div>
    <p class="creationNouvelleListe"> Pour créer votre liste: </br>
    <form action="CreationListe.php" method="post">
       <div class="input-group">
			<button type="submit" class="bouton" name="Creation_List">Créer une liste</button>
		</div>                    
        </form>  
    <div class="chooseList">
    <p class="choixNouvelleListe"> Choisir une liste déjà crée: </p>
    <ul id="registeredList">
        <li>Liste numéro 1 </li>
        <li>Liste numéro 2 </li>
        <li>Liste numéro 3 </li>
    </ul>
    </div>    

     <div class="input-group">
			<button type="submit" class="bouton" name="Creation_List">Séléctionner</button>
		</div>  
    </div>
</div>    


</body>
</head>
</html>
