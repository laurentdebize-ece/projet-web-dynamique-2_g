<?php
$servername = "localhost";
$utilisateur = "root";
$mdp = "root";
$bdd = "skillzz";

$conn = new mysqli($servername, $utilisateur, $mdp, $bdd);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$nom = $_POST['nom'];
$prenom = $_POST['prénom'];
$ecole = $_POST['école'];
$classe = $_POST['numClasse'];
$email = $_POST['mailE'];
$mdp = $_POST['mdp'];

$sql = "UPDATE elève SET nom='$nom', prénom='$prenom', école='$ecole' WHERE mailE='$email'";


if ($conn->query($sql) === TRUE) {
    echo "Les informations de l'utilisateur ont été mises à jour avec succès.";
} else {
    echo "Erreur lors de la mise à jour des informations de l'utilisateur : " . $conn->error;
}
$conn->close();
?>