<!-- Vérification de l'existence de la session, elle est automatiquement générée si elle n'existe pas -->
	
<?php
// Déclaration des variables.
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
//Connection à la base de données :
try
    {
        $bdd =  new PDO('mysql:host=localhost;dbname=minutepapillondb;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur'. $e->getmessage());
    }
// Vérification du login et du mot de passe :
  
        if(isset($_POST['Login_account'])){
            //récupération des valeurs saisies par l'utilisateur
            $pseudo= $_POST['pseudo'];
			$motDePasse = $_POST['motDePasse'];
			
	
			              
       // Envoie de la requête pour comparer si le pseudo et le mot de passe entrés existent dans la BDD.
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
			//$_SESSION['id_utilisateur'] = $idUtilisateurFK;
        }                  
       $req->closeCursor(); // Termine le traitement de la requête
		}
		            
if(isset($_POST['retourAccueil'])) {
	header('location: index.php');
}         
// Inscription de l'utilisateur:
// LA CLE DE CONFIRMATION EST BUGGEE. A MODIFIER.
if (isset($_POST['validation_compte'])) {
	// On récupère les éléments rentrés dans les cases du formulaire
	$nom =  $_POST['nom'];
	$prenom = $_POST['prenom'];
	$pseudo = $_POST['pseudo'];
	$mail = $_POST['mail'];
	$motDePasse = $_POST['motDePasse'];
	$cleConfirmation = "";
	/*$longueurCleConfirmation = 10;
	
	for($i = 1; $i < $longueurCleConfirmation; $i++)
	{
		$cleConfirmation .= mt_rand(0,9);
	}
	*/
	
	
	// On vérifie ensuite si les cases ont bien été remplies.
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

	//Vérification si le champ existe déjà. Cela fonctionne. A répter pour tache et liste.
	if(ifPseudoAlreadyExist($pseudo)) {array_push($errorsInsert,"le champ PSEUDO existe déjà dans la base de données.");}
	if(ifNameAlreadyExist($prenom)) {array_push($errorsInsert, "le champ PRENOM est déjà pris dans la base de données.");}	
	if(ifSurnameAlreadyExist($nom)) {array_push($errorsInsert, "le champ NOM est déjà pris dans la base de données.");}	
	if(ifMailAlreadyExist($mail)) {array_push($errorsInsert, "le champ MAIL est déjà pris dans la base de données.");}	
	if(ifPasswordAlreadyExist($motDePasse)) {array_push($errorsInsert, "le champ PASSWORD est déjà pris dans la base de données.");}	
	
	// On exécute la requête pour alimenter la BDD.
	if (count($errorsLogin) == 0) {
		//$password = md5($motDePasse);//encrypt the password before saving in the database
		$req = $bdd->prepare("INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, pseudo_utilisateur, motDePasse_utilisateur, mail_utilisateur ) 
        VALUES('$nom', '$prenom', '$pseudo', '$motDePasse', '$mail')");
		$req -> execute();

		//Redirection vers la page principale pour voir si on se connecte bien
		header('Inscription.php');
		// Envoi du mail de confirmation
		/*
		$messageDeConfirmation='
		<html>
		<body>
			<div align="center>
				<a href="file:///C:/wamp64/www/MinutePapillon/Inscription.php?pseudo='.urlencode($pseudo).'&key'.$cleConfirmation'">Confirmez votre compte en cliquant ici : ></a>
			</div>

		</body>
		</html>
		';
	

		
		mail($mail, "Bonjour" . $pseudo . "Voici mon mail de confirmation. Veuillez cliquez sur le lien ci-dessous pour activer votre compte");
		//$_SESSION['pseudo'] = $pseudo;
		//$_SESSION['success'] = "Vous êtes bien connecté(e)!";
		header('location: index.php');
		*/
		}
	}


	//Création de la liste :	
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
			//$reqAutre = $bdd -> prepare("SELECT id_utilisateur FROM utilisateur WHERE id_utilisateur = '.$idUtilisateurFK'");
			//$reqAutre ->execute();
			$reqListe = $bdd->prepare("INSERT INTO liste (nom_liste, date_liste, priorite_liste, id_utilisateur) 
			VALUES('$nomListe', '$dateListe', '$prioriteListe','$idUtilisateurFK')");
			$reqListe-> execute();
			
			//$_SESSION['success'] = "Enregistrement de votre liste réussi !";
			header('location: ChoixListe.php');	
		}
	}
	//Création de la tâche :
	
	if(isset($_POST['creation_Tache'])) {
		// On récupère les éléments rentrés dans les cases du formulaire
		$nomTache = $_POST['nomTache'];
		$prioriteTache= $_POST['prioriteTache'];
		$dateTache = $_POST['dateTache'];
		//On récupère l'id de la liste en cours afin d'associer la tâche avec cette même liste
		$idListeForeignKey = "";
		$choiceFromListe = $_POST['ChoixDeVotreListe'];		
		//On réalise cette requête pour récupérer l'id de la liste en cours :
		$reqListe= $bdd-> query("SELECT id_liste FROM liste WHERE nom_liste = '$choiceFromListe'");
		$reqListe->fetch();
		echo $reqListe;
		
		// On vérifie ensuite que toutes les cases ont été bien renseignées.
		if(empty($nomTache)) {array_push($errorsTache, " le champ NOM est requis."); }
		if(empty($prioriteTache)) {array_push($errorsTache, " le champ PRIORITE est requis."); }
		if(empty($dateTache)) {array_push($errorsTache, " le champ DATE est requis."); }
		// Exécution de la requête pour alimenter la BDD.
		if(count($errorsTache) == 0){
			$reqTache = $bdd->prepare("INSERT INTO tache (nom_tache, date_tache, priorite_tache, id_liste) 
			VALUES('$nomTache', '$dateTache', '$prioriteTache', '$reqListe')");
			$reqTache-> execute();
			
			//$_SESSION['success'] = "Enregistrement de votre tâche réussie !";
			header('location: VotreListe.php');	
		}		
	}

	//***FUNCTIONS ***//
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
	//Vérification pour les listes au niveau des doublons

	function ifNameListAlreadyExist($nomListe)
	{    global $bdd;
		$sql = "SELECT 1
				FROM liste
				WHERE nom_liste ='$nomListe'";		 
		$res = $bdd->query($sql);
		$row = $res->fetch();
		 
		return !empty($row);
	}

	//Aucune vérification sur les tâches étant donné que nous pouvons insérer les mêmes tâches pour les opérations
	//Seulement les listes peuvent changer. 
	//Un bouton supprimer tâche en cours sera implémenté afin de changer la tâche crée
	 
		 
?>