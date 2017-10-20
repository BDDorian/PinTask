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
        $bdd =  new PDO('mysql:host=localhost;dbname=minutepapillon;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur'. $e->getmessage());
    }
    ?>
    
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="StyleInscription.css">
</head>   
<title> Minute Papillon : Organiser votre travail.</title>
<body>
    <!-- Division des principaux éléments en conteneur. Cela tendra à disparaître mais c'était pour m'habituer à bien utiliser flexbox. -->
    <div>
        <div class ="header">
            <h2> Bienvenue sur Minute Papillon ! </h2>
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

        <!-- vérificarion du login et du mot de passe -->
        <?php

        $errors = array();
        
         if(isset($_POST['Envoyer'])){
            //récupération des valeurs saisies par l'utilisateur
            $registerPseudo= $_POST['pseudo'];
            $registerPwd = $_POST['motDePasse'];

            // Vérification que tous les champs sont remplis.
             if(empty($registerPseudo)){
                array_push($errors, "Votre pseudo est requis");
            }
             if(empty($registerPwd)){
                array_push($errors, "Votre mot de passe est requis");
            }

            // Condition vérifiant qu'il n'y a aucune erreur.

            //if(count($errors)== 0){
            //Encryptage du mot de passe en md5 avant de le vérifier dans la BDD. 

            //$registerPwd = md5($registerPwd);   
            
       // Envoie de la requête pour comparer si le pseudo et le mot de passe entrés existent dans la BDD.
        $req = $bdd->prepare('SELECT * from utilisateur WHERE pseudoUtilisateur = :registerPseudo AND motDePasseUtilisateur = :registerPwd');
       
        $req ->execute(array(

            'registerPseudo' => $registerPseudo,

            'registerPwd' => $registerPwd));  

        $resultat = $req->fetch();

        if(!$resultat)
        {
        echo "Mauvais mot de passe";
        }
        else
        {
            echo "Bon mot de passe";
        }   
        

         }    
        
       // $req->closeCursor(); // Termine le traitement de la requête
        
        
     ?>
   </div>
</body>
</html>
