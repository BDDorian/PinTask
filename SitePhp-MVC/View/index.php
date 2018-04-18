

<!--Boucle permettant la vérifaition de l'existence d'une session. Si la session n'est pas crée, elle sera alors générée avec le pseudo correspondant.-->
<?php
/**
 * @brief : Page d'accueil du site Minute-Papillon. L'utilisateur peut soit s'inscrire ou se connecter à un compte déjà existant.
 */
/**
 * @brief: Boucle permettant la vérification de l'existence d'une session.
 */
if (isset($_SESSION['idUtilisateur']) AND isset($_SESSION['pseudo']))
{
    echo 'Session en cours: '. $_SESSION['pseudo']. '.';
}   
?>
<html>
<head>
<!-- Inclusion du fichier server.php afin de générer les requêtes SQL pour la page index -->
<?php include('server.php') ?>

<!-- Connexion à la base de données -->
<!-- Application d'un try catch pour capturer l'erreur afin de la traiter ultèrieurement. 
Et vérification de la connexion à la base de données. -->
<?php
/**
 * @brief: Connexion à la base de données.
 */
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
<!-- Division des principaux éléments en conteneur. Utilisation de flexbox afin de mieux organiser le rendu du site -->
<div>
    <div class ="header">
        <h2> Bienvenue Minute Papillon ! </h2>
    </div>
    <div class ="Conteneur2">
        <p class="newMember" >Vous êtes nouveau ici ? Inscrivez-vous : </p>
    </div>
    <!-- Formulaire servant à accéder à la page d'inscription d'un utilisateur -->
    <form class= "formRegisterIndex"action="Inscription.php" method="post">
    <div class="input-group">
        <button type="submit" class="bouton" name="Register_account">S'inscrire</button>
    </div>                    
    </form>
    <!-- Formulaire servant à accéder à la page ChoixListe.php en vérifiant le pseudo et le mot de passe enregistrés. -->
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