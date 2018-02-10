public function load(){
  $host = "localhost"; // nom du serveur MySQL
  $user = "root";
  $password = "";
  $db_name = "tutoriel_supinfo"; // nom de la base de donnée

      $this->_connection = mysqli_connect($host, $user, $password, $db_name);
      
      // Vérification de la connexion
      if (mysqli_connect_errno()) 
      {
        // afficher l'erreur en cas d'exception
          printf("Échec de la connexion : %s\n", mysqli_connect_error()); 
          exit();
      }   
}
}