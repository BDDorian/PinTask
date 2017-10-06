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
</head>   
<title> PinTask : Organiser votre travail.</title>
<body>
    <!-- Division des principaux éléments en conteneur. Cela tendra à disparaître mais c'était pour m'habituer à bien utiliser flexbox. -->
    <div class="listeGlobale">
        <div class ="header-VotreListe">
            <h2> To do !</h2>
        </div>
        <div class="input-group-VotreListe">
			<label>Votre tâche choisie.</label>
			<input type="text" name="toDoTache">
		    </div>
   </div>         
        <div class="header-VotreListe">
            <h2> In progress </h2>
        </div>
        <div class="input-group-VotreListe">
			<label>Votre tache choisie.</label>
			<input type="text" name="inProgressTache">
		    </div>
        <div class="header-VotreListe">
            <h2> To verify </h2>
        </div>
        <div class="input-group-VotreListe">
			<label>Votre tache choisie</label>
			<input type="text" name="toVerifyTache">
		    </div>
        <div class="header-VotreListe">
            <h2> Done </h2>
        </div>
        <div class="input-group-VotreListe">
			<label>Votre tache choisie.</label>
			<input type="text" name="doneTache">
		    </div>
   
   </div>
</body>
</html>
