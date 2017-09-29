<?php

session_start();

// Déclaration des variables.

$nom = "";
$prenom = "";
$pseudo = "";
$mail = "";
$motDePasse = "";
$errors= array();
$_SESSION['connecte'] ="";

$nomListe ="";
$dateListe = "";
$prioriteListe ="";
$errorsListe=array();

//Connection à la base de données :
try
    {
        $bdd =  new PDO('mysql:host=localhost;dbname=pintaskbdd;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur'. $e->getmessage());
    }
    
// Inscription de l'utilisateur:
if (isset($_POST['validation_compte'])) {

	// On récupère les éléments rentrés dans les cases du formulaire
	$nom =  $_POST['nom'];
	$prenom = $_POST['prenom'];
	$pseudo = $_POST['pseudo'];
	$mail = $_POST['mail'];
    $motDePasse = $_POST['motDePasse'];

	// On vérifie ensuite si les cases ont bien été remplies.
	if (empty($nom)) { array_push($errors, "Le champ NOM est requis."); }
	if (empty($prenom)) { array_push($errors, "Le champ PRENOM est requis."); }
	if (empty($pseudo)) { array_push($errors, "Le champ PSEUDO est requis."); }
    if (empty($mail)) { array_push($errors, "Le champ E-MAIL est requis."); }
    if (empty($motDePasse)) { array_push($errors, "Le champ MOT DE PASSE est requis."); }


	// On exécute la requête pour alimenter la BDD.
	if (count($errors) == 0) {
		$password = md5($motDePasse);//encrypt the password before saving in the database
		$req = $bdd->prepare("INSERT INTO utilisateur (nomUtilisateur, prenomUtilisateur, pseudoUtilisateur, mailUtilisateur, motDePasseUtilisateur) 
        VALUES('$nom', '$prenom', '$pseudo', '$mail', '$motDePasse')");
		$req -> execute();

		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['success'] = "Vous êtes bien connecté(e)!";
		header('location: index.php');
	}

	//Création de la liste :
	
	if(isset($_POST['creation_Liste'])) {

		// On récupère les éléments rentrés dans les cases du formulaire
		$nomListe = $_POST['nomListe'];
		$prioriteListe= $_POST['prioriteListe'];
		$dateListe = $_POST['dateListe'];

		// On vérifie ensuite que toutes les cases ont été bien renseignées.$_COOKIE

		if(empty($nomListe)) {array_push($errorsListe, " le champ NOM est requis."); }
		if(empty($prioriteListe)) {array_push($errorsListe, " le champ PRIORITE est requis."); }
		if(empty($dateListe)) {array_push($errorsListe, " le champ DATE est requis."); }

		// Exécution de la requête pour alimenter la BDD.
		if(count($errorsListe) == 0){
			$reqListe = $bdd->prepare("INSERT INTO liste (nomListe, dateListe, prioriteListe) VALUES('$nomListe','$dateListe','$prioriteListe')");
			$reqListe-> execute();
			$_SESSION['success'] = "Enregistrement de votre liste réussi !";
			header('location: CreationListe.php');
		}
	}

}
?>