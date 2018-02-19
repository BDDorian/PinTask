<!-- Page de server afin d'exécuter la plupart des requêtes SQL pour l'insertion des données dans la base de données -->	
<?php
// Déclaration des variables employées sur cette page.
$nom = "";
$prenom = "";
$pseudo = "";
$mail = "";
$motDePasse = "";
$idUtilisateurFK = "";
$errorsInsert = array();
$errorsLogin= array();
$_SESSION['connecte'] ="";
$nomListe ="";
$dateListe = "";
$prioriteListe ="";
$errorsListe=array();
$nomTache="";
$dateTache="";
$prioriteTache="";
$errorsTache=array();
$pseudoEnregistre ="";
$motDePasseEnregistre ="";
$prioriteTacheChoisie="";
$nomTacheChoisie="";
/* Connexion à la base de données
Application d'un try catch pour capturer l'erreur afin de la traiter ultèrieurement. 
Et vérification de la connexion à la base de données.
*/try
{
	$bdd =  new PDO('mysql:host=localhost;dbname=minutepapillondb;charset=utf8', 'root', '');
}
catch (Exception $e)
{
	die('Erreur'. $e->getmessage());
}
// Vérification du login et du mot de passe :
	if(isset($_POST['Login_account'])){
		//récupération des valeurs saisies par l'utilisateur lors du formulaire.
		$pseudo= $_POST['pseudo'];
		$motDePasse = $_POST['motDePasse'];            
	// Envoi de la requête pour comparer si le pseudo et le mot de passe entrés existent dans la BDD.
	$req = $bdd->prepare("SELECT id_utilisateur from utilisateur WHERE pseudo_utilisateur = :pseudo AND motDePasse_utilisateur = :motDePasse");
	$req ->execute(array(
	'pseudo' => $pseudo,
	'motDePasse' => $motDePasse));  		
	$resultat = $req->fetch();	
	if (!$resultat)	      
	{
	echo "Le login et mot de passe indiqués n'existent pas.";
	header('location: error404.php');
	}
	else
	{
		session_start();
		$_SESSION['id_utilisateur'] = $resultat['id_utilisateur'];
		$_SESSION['pseudo'] = $pseudo;
	}                  
	$req->closeCursor(); 
	}
//Redirection de l'utilisateur vers la page d'accueil.			            
if(isset($_POST['retourAccueil'])) {
header('location: index.php');
}         
//** INSCRIPTION D'UN UTILISATEUR **//
if (isset($_POST['validation_compte'])) {
// On récupère les éléments rentrés dans les cases du formulaire d'inscription du compte.
$nom =  $_POST['nom'];
$prenom = $_POST['prenom'];
$pseudo = $_POST['pseudo'];
$mail = $_POST['mail'];
$motDePasse = $_POST['motDePasse'];
$cleConfirmation = "";
// Vérification des champs, génère une erreur si ils ne sont pas bien remplis correctement.
if (empty($nom)) { array_push($errorsLogin, "Le champ NOM est requis."); }
if (empty($prenom)) { array_push($errorsLogin, "Le champ PRENOM est requis."); }
if (empty($pseudo)) { array_push($errorsLogin, "Le champ PSEUDO est requis."); }
if (empty($mail)) { array_push($errorsLogin, "Le champ E-MAIL est requis."); }
if (empty($motDePasse)) { array_push($errorsLogin, "Le champ MOT DE PASSE est requis."); }
/*
//Vérification si l'une des variables de l'inscription est déjà enregistrée dans la table
$checkIfAlreadyExist = $bdd->prepare("SELECT * FROM utilisateurs WHERE nomUtilisateur ='$nom', prenomUtilisateur ='$prenom', 
pseudoUtilisateur='$pseudo', mailUtilisateur='$mail', motDePasseUtilisateur='$motDePasse'");
//Condition qui indique si au moins l'une des lignes analysées renvoie un élement déjà inscrit.
if(mysql_num_rows($checkIfAlreadyExist) > 0){
	echo " Un élément existe déjà dans la base de données. Veuillez réessayer";
}
*/

//Vérification si l'un des champs existe déjà dans la base de données.
if(ifPseudoAlreadyExist($pseudo)) {array_push($errorsInsert,"le champ PSEUDO existe déjà dans la base de données.");}
if(ifNameAlreadyExist($prenom)) {array_push($errorsInsert, "le champ PRENOM est déjà pris dans la base de données.");}	
if(ifSurnameAlreadyExist($nom)) {array_push($errorsInsert, "le champ NOM est déjà pris dans la base de données.");}	
if(ifMailAlreadyExist($mail)) {array_push($errorsInsert, "le champ MAIL est déjà pris dans la base de données.");}	
if(ifPasswordAlreadyExist($motDePasse)) {array_push($errorsInsert, "le champ PASSWORD est déjà pris dans la base de données.");}	
// Exécution de la requête pour inserer les données de l'utilisateur dans la base de données.
if (count($errorsLogin) == 0) {
	//$password = md5($motDePasse);//encrypt the password before saving in the database
	$req = $bdd->prepare("INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, pseudo_utilisateur, motDePasse_utilisateur, mail_utilisateur ) 
	VALUES('$nom', '$prenom', '$pseudo', '$motDePasse', '$mail')");
	$req -> execute();
	//Redirection vers la page principale pour voir si on se connecte bien
	header('Inscription.php');
	}
}
//** CREATION D'UNE LISTE **//
if(isset($_POST['creation_Liste'])) {
	// On récupère les éléments rentrés dans les cases du formulaire
	$nomListe = $_POST['nomListe'];
	$prioriteListe= $_POST['prioriteListe'];
	$dateListe = $_POST['dateListe'];
	//On inclue l'id de la session en cours pour l'ajouter en tant que clé étrangère.
	$idUtilisateurFK = $_SESSION['id_utilisateur'];
	// On vérifie ensuite que toutes les cases ont été bien renseignées.
	if(empty($nomListe)) {array_push($errorsListe, " le champ NOM est requis."); }
	if(empty($prioriteListe)) {array_push($errorsListe, " le champ PRIORITE est requis."); }
	if(empty($dateListe)) {array_push($errorsListe, " le champ DATE est requis."); }

	//On vérifie si un doublon existe uniquement pour le nom de la Liste.
	if(ifNameListAlreadyExist($nomListe)) {array_push($errorsListe, "Ce NOM de liste existe déjà.");}
	// Exécution de la requête pour alimenter la BDD.
	if(count($errorsListe) == 0){
		$reqListe = $bdd->prepare("INSERT INTO liste (nom_liste, date_liste, priorite_liste, id_utilisateur) 
		VALUES('$nomListe', '$dateListe', '$prioriteListe','$idUtilisateurFK')");
		$reqListe-> execute();
		header('location: ChoixListe.php');	
	}
}
//** CREATION D'UNE TACHE **//
if(isset($_POST['creation_Tache'])) {
	// On récupère les éléments rentrés dans les cases du formulaire
	$nomTache = $_POST['nomTache'];
	$prioriteTache= $_POST['prioriteTache'];
	$dateTache = $_POST['dateTache'];
	$idFromChosenList = $_POST['idFromCurrentList'];
	// On vérifie ensuite que toutes les cases ont été bien renseignées.
	if(empty($nomTache)) {array_push($errorsTache, " le champ NOM est requis."); }
	if(empty($prioriteTache)) {array_push($errorsTache, " le champ PRIORITE est requis."); }
	if(empty($dateTache)) {array_push($errorsTache, " le champ DATE est requis."); }
	// Exécution de la requête pour alimenter la BDD.
	if(count($errorsTache) == 0){
		$reqTache = $bdd->prepare("INSERT INTO tache (nom_tache, date_tache, priorite_tache, id_liste) 
		VALUES('$nomTache', '$dateTache', '$prioriteTache', '$idFromChosenList')");
		$reqTache-> execute();
		header('location: VotreListe.php');		
	}
}
//***FUNCTIONS ***//
// Fonctions crées afin de vérifier si l'un des éléments existent déjà dans la base de données.
// On évite ainsi les doublons.	
function ifPseudoAlreadyExist($pseudo)
{    global $bdd;
	$sql = "SELECT 1
			FROM utilisateur
			WHERE pseudo_utilisateur ='$pseudo'";		 
	$res = $bdd->query($sql);
	$row = $res->fetch();
		
	return !empty($row);
}

function ifNameAlreadyExist($prenom)
{    global $bdd;
	$sql = "SELECT 1
			FROM utilisateur
			WHERE prenom_utilisateur ='$prenom'";		 
	$res = $bdd->query($sql);
	$row = $res->fetch();
		
	return !empty($row);
}

function ifSurnameAlreadyExist($nom)
{    global $bdd;
	$sql = "SELECT 1
			FROM utilisateur
			WHERE nom_utilisateur ='$nom'";		 
	$res = $bdd->query($sql);
	$row = $res->fetch();
		
	return !empty($row);
}

function ifMailAlreadyExist($mail)
{    global $bdd;
	$sql = "SELECT 1
			FROM utilisateur
			WHERE mail_utilisateur ='$mail'";		 
	$res = $bdd->query($sql);
	$row = $res->fetch();
		
	return !empty($row);
}

function ifPasswordAlreadyExist($motDePasse)
{    global $bdd;
	$sql = "SELECT 1
			FROM utilisateur
			WHERE motDePasse_utilisateur ='$motDePasse'";		 
	$res = $bdd->query($sql);
	$row = $res->fetch();
		
	return !empty($row);
}

function ifNameListAlreadyExist($nomListe)
{    global $bdd;
	$sql = "SELECT 1
			FROM liste
			WHERE nom_liste ='$nomListe'";		 
	$res = $bdd->query($sql);
	$row = $res->fetch();
		
	return !empty($row);
}	 
?>