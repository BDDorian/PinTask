<!-- On inclut la page server.php afin d'envoyer tout à la base de données' -->
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pintask: Création du compte</title>
	<link rel="stylesheet" type="text/css" href="StyleInscription.css">
     <!-- Se connecter avec ma base sur phpMyAdmin 
    J'applique un try catch pour capturer l'erreur afin de la traiter ultèrieurement. 
    Et surtout ne pas afficher des informations comprométantes à l'utilisateur.-->
    <?php
    try
    {
        $bdd =  new PDO('mysql:host=localhost;dbname=minutepapillon;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur'. $e->getmessage());
    }
    ?>
</head>
<body>
	<div class="header">
		<h2>Création de votre compte</h2>
	</div>
	<!-- Formulaire composé de champs afin de créer un compte utilisateur -->
	<form method="post" action="Inscription.php">
        <!-- On vérifie si il n'y a pas d'erreurs-->
        <?php include('errors.php'); ?>

		<div class="input-group">
			<label>Nom:</label>
			<input type="text" name="nom">
		</div>
		<div class="input-group">
			<label>Prénom:</label>
			<input type="text" name="prenom">
		</div>
		<div class="input-group">
			<label>Pseudo:</label>
			<input type="text" name="pseudo">
		</div>
		<div class="input-group">
			<label>E-mail:</label>
			<input type="mail" name="mail">
		</div>
        <div class="input-group">
			<label>Mot de passe:</label>
			<input type="password" name="motDePasse">
		</div>
		<div class="input-group">
			<button type="submit" class="bouton" name="validation_compte">S'inscrire</button>
		</div>
		
	</form>

    
           <!-- $errors = array();

            if(isset($_POST['Envoyer'])){
            //récupération des valeurs saisies par l'utilisateur
            $nom= $_POST['nom'];
            $prenom = $_POST['prenom'];
            $pseudo = $_POST['pseudo'];
            $mail = $_POST['mail'];
            $motDePasse = $_POST['motDePasse'];
            

            // Vérification de chaque champ si il est bien rempli.
            
            /*if(empty($nom)){
                array_push($errors, "Votre nom est requis");
            }
             if(empty($prenom)){
                array_push($errors, "Votre prénom est requis");
            }
             if(empty($pseudo)){
                array_push($errors, "Votre pseudo est requis");
            }
             if(empty($mail)){
                array_push($errors, "Votre e-mail est requis");
            }
             if(empty($motDePasse)){
                array_push($errors, "Votre mot de passe est requis");
            }
            */
            // Condition pour vérifier qu'il n'y a pas d'erreurs afin d'exécuter la requête.
            //if(count($errors) == 0) {

            // Encryptage via le md5 du mot de passe. Afin qu'il soit crypté pour être stocké tel quel dans la BDD.
            //$motDePasse = md5($motDePasse);

            // Requête SQL pour insérer le compte dans la table utilisateur.
            /*$req = $bdd->prepare("INSERT INTO utilisateur(nomUtilisateur, prenomUtilisateur, pseudoUtilisateur, mailUtilisateur, motDePasseUtilisateur)
            VALUES(:nom, :prenom ,:pseudo, :mail, :motDePasse) ");
             
            $req->execute(array(

            'nom' => $nom,

            'prenom' => $prenom,

            'pseudo' => $pseudo,

            'mail' => $mail,

            'motDePasse' => $motDePasse

             ));
            // Notification d'erreur.
             $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

             // fermeture de la connection à la bdd
            if ($bdd) {
            $bdd = NULL;
            }
             
            }
            
            ?>
            -->
            
</body>
</html>