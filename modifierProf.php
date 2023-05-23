<?php
$servername = "localhost";
$utilisateur = "root";
$mdp = "root";
<<<<<<< HEAD
$bdd = "skillzz";
=======
$bdd = "Skillzz";
>>>>>>> origin

$conn = new mysqli($servername, $utilisateur, $mdp, $bdd);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$nom = $_POST['nom'];
$prenom = $_POST['prénom'];
$email = $_POST['mailP'];
$mdp = $_POST['mdp'];

$sql = "UPDATE prof SET nom='$nom', prénom='$prenom' WHERE mailP='$email'";


if ($conn->query($sql) === TRUE) {
    echo "Les informations de l'utilisateur ont été mises à jour avec succès.";
} else {
    echo "Erreur lors de la mise à jour des informations de l'utilisateur : " . $conn->error;
}
$conn->close();
?>