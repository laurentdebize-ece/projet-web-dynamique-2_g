<?php
// Connexion à la base de données
$servername = "localhost";
$utilisateur = "root";
$mdp = "root";
$bdd = "skillzz1";

$conn = new mysqli($servername, $utilisateur, $mdp, $bdd);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les données soumises par le formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$ecole = $_POST['ecole'];
$classe = $_POST['numClasse'];
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Mettre à jour les informations de l'utilisateur dans la base de données
$sql = "UPDATE elève SET nom='$nom', prénom='$prenom', école='$ecole', numClasse='$classe', mdp='$mdp' WHERE mailE='$email'";

if ($conn->query($sql) === TRUE) {
    echo "Les informations de l'utilisateur ont été mises à jour avec succès.";
} else {
    echo "Erreur lors de la mise à jour des informations de l'utilisateur : " . $conn->error;
}

$conn->close();
?>