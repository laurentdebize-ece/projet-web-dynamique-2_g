<?php

session_start();

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
      $bdd = "skillzz1";

      try {
        $connexion = new PDO("mysql:host=$serveur;dbname=$bdd", $utilisateur, $motdepasse);
        // Activer les exceptions pour les erreurs PDO
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        die("La connexion à la base de données a échoué : " . $e->getMessage());
      }

      // Éviter les injections SQL
      $emailProfesseur = $connexion->quote($emailProfesseur);
      $mdpProfesseur = $connexion->quote($mdpProfesseur);

      // Requête SQL pour vérifier si l'utilisateur existe
      $requete = "SELECT * FROM prof WHERE mailP=$emailProfesseur AND mdp=$mdpProfesseur";
      try {
        $resultat = $connexion->query($requete);
      } catch(PDOException $e) {
        echo "Erreur SQL : " .$e->getMessage();
        exit;
      }

      // Vérifier si la requête a renvoyé un résultat
      if ($resultat->rowCount() > 0) {
        // L'utilisateur est connecté avec succès
        echo "Connexion réussie";

        while($donnees = $resultat->fetch())  {
          $_SESSION['nom'] = $donnees['nom'];
          $_SESSION['prénom'] = $donnees['prénom'];
          $_SESSION['mailP'] = $donnees['mailP'];
        }

        header("Location: pageProf.php");
      }
      else {
        // L'utilisateur n'existe pas ou les informations sont incorrectes
        echo "Adresse email ou mot de passe incorrect.";
        header("Location:connexion.php");
      }

      // Fermer la connexion à la base de données
      $connexion = null;

    }

  }

}
?>
