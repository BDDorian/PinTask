<!-- Page de déconnexion afin de se déconnecter de la session en cours -->
<meta charset ="utf-8"/>
<link rel="stylesheet" href="StyleInscription.css">

<p class="messageError"> Déconnexion réussie ! </p>
<form action="index.php">
<button type="submit"class="bouton" name="retourAccueil">Retourner à la page d'accueil</button>
</form>
<?php 
//  Méthode isset pour vérifier si l'utilisateur appuie sur le bouton. Affiche alors une valeur booléenne TRUE or FALSE.
if(isset($_POST['retourAccueil']))
{
    $_SESSION = array();
    // Destruction de la session en cours. Et redirection sur la page principale pour soit créer un nouveau compte ou bien se reconnecter.
    session_unset ();
    session_destroy();
    header('location: index.php');
    }
?>