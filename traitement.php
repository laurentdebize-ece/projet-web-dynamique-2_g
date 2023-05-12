<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Vérifier si les champs requis ont été remplis
  if (empty($_POST["emailProfesseur"]) || empty($_POST["mdpProfesseur"])) {
    echo "Tous les champs sont obligatoires.";
  } else {
    
    // Nettoyer les données entrées par l'utilisateur
    $emailProfesseur = htmlspecialchars($_POST["emailProfesseur"]);
    $mdpProfesseur = htmlspecialchars($_POST["mdpProfesseur"]);
    
    // Vérifier si l'adresse email est valide
    if (!filter_var($emailProfesseur, FILTER_VALIDATE_EMAIL)) {
      echo "Adresse email invalide.";
    } else {
      
      // Connexion à la base de données
      $serveur = "localhost";
      $utilisateur = "root";
      $motdepasse = "root";
      $bdd = "skillzz";
      
      $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $bdd);
      
      // Vérifier si la connexion a réussi
      if ($connexion->connect_error) {
        die("La connexion à la base de données a échoué : " . $connexion->connect_error);
      }
      
      // Éviter les injections SQL
      $emailProfesseur = mysqli_real_escape_string($connexion, $emailProfesseur);
      $mdpProfesseur = mysqli_real_escape_string($connexion, $mdpProfesseur);
      
      // Requête SQL pour vérifier si l'utilisateur existe
      $requete = "SELECT * FROM prof WHERE mailP='$emailProfesseur' AND mdp='$mdpProfesseur'";
      $resultat = $connexion->query($requete);
      
      // Vérifier si la requête a renvoyé un résultat
      if ($resultat == false) {
        // la requête a échoué
        echo "Erreur SQL : " .$connexion->error;
      }
      else if ($resultat->num_rows > 0) {
        // L'utilisateur est connecté avec succès
        echo "Connexion réussie";
        header("Location: professeur.php");
      }
      else {
        // L'utilisateur n'existe pas ou les informations sont incorrectes
        echo "Adresse email ou mot de passe incorrect.";
        header("Location:index.php");
      }
      
      // Fermer la connexion à la base de données
      $connexion->close();
      
    }
    
  }
  
}
?>