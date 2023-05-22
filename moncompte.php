<?php
// Connexion à la base de données
$servername = "localhost";
$utilisateur = "root";
$mdp = "root";
$bdd = "skillzz1";

// Démarrer la session
session_start();

$conn = new mysqli($servername, $utilisateur, $mdp, $bdd);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les informations de l'utilisateur à partir de la base de données
$email = "paul.richard@gmail.com"; // Adresse e-mail de l'utilisateur
//$email = $_SESSION['mailE']; // Utiliser la variable de session pour récupérer l'email de l'utilisateur connecté
$sql = "SELECT * FROM elève WHERE mailE = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher les données de l'utilisateur dans les champs de saisie
    while ($row = $result->fetch_assoc()) {
        $nom = $row["nom"];
        $prenom = $row["prénom"];
        $ecole = $row["école"];
        $classe = $row["numClasse"];
        $mdp = $row["mdp"];

        echo '<div class="container">';
        echo '<h1>Mon compte</h1>';
        echo '<form action="modifier.php" method="POST">';
        echo '<label for="nom">Nom :</label>';
        echo '<input type="text" id="nom" name="nom" value="' . $nom . '" readonly>';

        echo '<label for="prenom">Prénom :</label>';
        echo '<input type="text" id="prenom" name="prenom" value="' . $prenom . '" readonly>';

        echo '<label for="adresse">Ecole :</label>';
        echo '<input type="text" id="adresse" name="adresse" value="' . $ecole . '" readonly>';

        echo '<label for="classe">Classe :</label>';
        echo '<input type="text" id="classe" name="classe" value="' . $classe . '" readonly>';

        echo '<label for="email">Email :</label>';
        echo '<input type="email" id="email" name="email" value="' . $email . '" readonly>';

        echo '<label for="mot_de_passe">Mot de passe :</label>';
        echo '<input type="password" id="mot_de_passe" name="mot_de_passe" value="' . $mot_de_passe . '" readonly>';
        echo '<br><br>';

        echo '<input type="button" value="Modifier mes informations" onclick="toggleEditMode()">';
        echo '<input type="submit" value="Enregistrer" style="display: none">';
        echo '</form>';
        echo '</div>';
    }
} else {
    echo "Aucune donnée d'utilisateur trouvée.";
}
$conn->close();
?>

<script>
    function toggleEditMode() {
        // Activer le mode d'édition des champs de saisie
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].readOnly = false;
        }

        // Afficher le bouton "Enregistrer"
        var saveButton = document.querySelector('input[type="submit"]');
        saveButton.style.display = "block";

        // Désactiver le bouton "Modifier mes informations"
        var editButton = document.querySelector('input[type="button"]');
        editButton.disabled = true;
    }
</script>