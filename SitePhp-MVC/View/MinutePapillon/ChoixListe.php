<!-- Page ChoixListe.php Création d'une liste, et sélection d'une liste déjà crée. -->
<!-- Inclusion du fichier server.php afin d'inclure les requêtes SQL à la page dédiée. -->
<?php include('server.php');
?>
<html>
<head>
<!-- Vérification de la session en cours. Si elle n'existe pas, elle est automatiquement générée. -->
<?php
if(!$_SESSION['id_utilisateur']){
    session_start();
}
?>
<!-- Utilisation de la variable globale SESSION afin d'afficher la session en cours. -->
<?php
if (isset($_SESSION['id_utilisateur']) AND isset($_SESSION['pseudo']))
{
    echo 'Nom de la session : '.$_SESSION['pseudo'];?>
    <br>
    <?php
    echo 'Id de la session : ' .$_SESSION['id_utilisateur'];     
}
else{
    echo "jepassepasparlasession.com";
}
/* Récupération de la clé étrangère id_utilisateur afin de pouvoir l'insérer dans la table liste. */
$idUtilisateurFK = $_SESSION['id_utilisateur'];

?>    
<!-- Connexion à la base de données -->
<!-- Application d'un try catch pour capturer l'erreur afin de la traiter ultèrieurement. 
Et vérification de la connexion à la base de données. -->
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
<!-- Formulaire pour retourner à la page d'accueil sans se déconnecter de la session utilisée -->
<form action ="index.php" method="post">
<input type="submit" name="indexBouton" class="bouton" value="Accueil">
</form>
<!-- Formulaire pour se déconnecter de la session en cours -->
<form action="deconnexion.php" method="post">
<input type="submit" name="decoButton" class="bouton" value="Deconnexion">
</form>
<body>    
<div>
<!-- Formulaire pour créer une nouvelle liste en accédant à la page CreationListe.php -->
<div class="header"> Création de votre liste
</div>
<p class="creationNouvelleListe"> Pour créer votre liste: </br>
<form action="CreationListe.php" method="post">
    <div class="input-group">
        <button type="submit" class="bouton" name="Creation_List">Créer une liste</button>
    </div>     
                    
    </form>  
    <!--Formulaire pour choisir une liste déjà crée par l'utilisateur de la session -->
<div class="chooseList">
<p class="choixNouvelleListe"> Choisir une liste déjà crée: </p>
    <form action="VotreTache.php" method="post">
    <SELECT name="ChoixDeVotreListe">
    <?php
    /* On récupère une nouvelle fois la variable de la session de l'utilisateur afin de choisir les listes crée par cet utilisateur uniquement. */
    $idUtilisateurFK = $_SESSION['id_utilisateur'];
    $reponse = $bdd->query("SELECT nom_liste, id_liste FROM liste WHERE id_utilisateur = '$idUtilisateurFK'");
    while($data = $reponse->fetch())
    {
        ?>
        <option value=<?php echo $data['id_liste']?>> <?php echo $data['nom_liste']; ?></option>       
    <?php
    }
    ?>
    </SELECT>
        <?php 
    ?>
    <input name="submit" type="submit">
        </form>  
</div>     
</div>    
</body>
</html>