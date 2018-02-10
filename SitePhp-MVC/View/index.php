<!-- A FAIRE : INDENTER CORRECTEMENT TOUT LE CODE -->
<!--Boucle permettant la vérifaition de l'existence d'une session. Si la session n'est pas crée, elle sera alors générée lors de la validation du pseudo' -->


  <?php
    if (isset($_SESSION['idUtilisateur']) AND isset($_SESSION['pseudo']))
    {
        echo 'Session en cours: '. $_SESSION['pseudo']. '.';
    }
    
    ?>
<html>
<head>
   <!-- Inclusion du fichier server.php afin de générer les requêtes pour la page index -->
   <?php include('server.php') ?>
   
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
    <!-- style appliqué pour les grand écrans -->
    <link rel="stylesheet" href="StyleInscription.css">
</head> 
 
<title> Minute Papillon : Organiser votre travail.</title>
<body>
    <!-- Division des principaux éléments en conteneur. Cela tendra à disparaître mais c'était pour m'habituer à bien utiliser flexbox. -->
    <div>
        <div class ="header">
            <h2> Bienvenue Minute Papillon ! </h2>
        </div>
        <div class ="Conteneur2">
            <p class="newMember" >Vous êtes nouveau ici ? Inscrivez-vous : </p>
       </div>
       <form class= "formRegisterIndex"action="Inscription.php" method="post">
       <div class="input-group">
			<button type="submit" class="bouton" name="Register_account">S'inscrire</button>
		</div>                    
        </form>

        <div class="Conteneur3">
            <p class="alreadyMember"> Déjà inscrit ? Indiquez votre pseudo et votre mot de passe: </p>   
            <form action="ChoixListe.php" method="post"> 
            <div class="input-group">
			<label>Pseudo:</label>
			<input type="text" name="pseudo">
		    </div>
            <div class="input-group">
			<label>Mot de passe:</label>
			<input type="password" name="motDePasse">
		    </div>
            <div class="input-group">
			<button type="submit" class="bouton" name="Login_account">Se connecter</button>
		    </div>
              
            </form>
        </div>

        
   </div>
</body>
</html>