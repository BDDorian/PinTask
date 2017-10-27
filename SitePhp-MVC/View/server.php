<?php



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
        $bdd =  new PDO('mysql:host=localhost;dbname=minutepapillon;charset=utf8', 'root', '');
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
        $req = $bdd->prepare("SELECT idUtilisateur from utilisateur WHERE pseudoUtilisateur = :pseudo AND motDePasseUtilisateur = :motDePasse");
       
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
			$_SESSION['idUtilisateur'] = $resultat['idUtilisateur'];
			$_SESSION['pseudo'] = $pseudo;
            echo "Vous êtes connecté";
        }   
                   
       $req->closeCursor(); // Termine le traitement de la requête
		}
		     
        
if(isset($_POST['retourAccueil'])) {
	header('location: index.php');
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

		//$_SESSION['pseudo'] = $pseudo;
		//$_SESSION['success'] = "Vous êtes bien connecté(e)!";
		header('location: index.php');
	}
}

	//Création de la liste :
	
	if(isset($_POST['creation_Liste'])) {

		// On récupère les éléments rentrés dans les cases du formulaire
		$nomListe = $_POST['nomListe'];
		$prioriteListe= $_POST['prioriteListe'];
		$dateListe = $_POST['dateListe'];

		// On vérifie ensuite que toutes les cases ont été bien renseignées.

		if(empty($nomListe)) {array_push($errorsListe, " le champ NOM est requis."); }
		if(empty($prioriteListe)) {array_push($errorsListe, " le champ PRIORITE est requis."); }
		if(empty($dateListe)) {array_push($errorsListe, " le champ DATE est requis."); }

		// Exécution de la requête pour alimenter la BDD.
		if(count($errorsListe) == 0){
			$reqListe = $bdd->prepare("INSERT INTO liste (nomListe, dateListe, prioriteListe) 
			VALUES('$nomListe', '$dateListe', '$prioriteListe')");
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

		// On vérifie ensuite que toutes les cases ont été bien renseignées.

		if(empty($nomTache)) {array_push($errorsTache, " le champ NOM est requis."); }
		if(empty($prioriteTache)) {array_push($errorsTache, " le champ PRIORITE est requis."); }
		if(empty($dateTache)) {array_push($errorsTache, " le champ DATE est requis."); }

		// Exécution de la requête pour alimenter la BDD.
		if(count($errorsTache) == 0){
			$reqTache = $bdd->prepare("INSERT INTO tache (nomTache, dateTache, prioriteTache) 
			VALUES('$nomTache', '$dateTache', '$prioriteTache')");
			$reqTache-> execute();
			
			//$_SESSION['success'] = "Enregistrement de votre tâche réussie !";
			header('location: VotreListe.php');
			
		}		
	}

?>