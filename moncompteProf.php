<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
	<title>Mon compte professeur </title>
	<link rel="stylesheet" type="text/css" href="moncompteProf.css">
</head>

<body>

<?php include("headerP.php"); ?>
<?php include("footerP.php"); ?>
<?php

session_start();

$servername = "localhost";
$utilisateur = "root";
$mdp = "root";
$bdd = "skillzz";

$conn = new mysqli($servername, $utilisateur, $mdp, $bdd);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

//$email = "paul.richard@gmail.com"; // Adresse e-mail de l'utilisateur
$email = $_SESSION['mailP']; // Utiliser la variable de session pour récupérer l'email de l'utilisateur connecté
$sql = "SELECT * FROM prof WHERE mailP = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nom = $row["nom"];
        $prenom = $row["prénom"];
        $mdp = $row["mdp"];

        echo '<div class="container">';
        echo '<h1>Mon compte</h1>';
        echo '<form action="modifierProf.php" method="POST">';

        echo '<div class="field">';
        echo '<label for="nom">Nom :</label>';
        echo '<input type="text" id="nom" name="nom" value="' . $nom . '" readonly>';
        echo '</div>';

        echo '<div class="field">';
        echo '<label for="prenom">Prénom :</label>';
        echo '<input type="text" id="prenom" name="prenom" value="' . $prenom . '" readonly>';
        echo '</div>';

        echo '<div class="field">';
        echo '<label for="email">Email :</label>';
        echo '<input type="email" id="email" name="email" value="' . $email . '" readonly>';
        echo '</div>';

        echo '<div class="field">';
        echo '<label for="mot_de_passe">Mot de passe :</label>';
        echo '<input type="password" id="mot_de_passe" name="mot_de_passe" value="' . $mdp . '" readonly>';
        echo '</div>';

        echo '<div class="field edit-button">';
        echo '<input type="button" value="Modifier mes informations" onclick="toggleEditMode()">';
        echo '</div>';

        echo '<div class="field">';
        echo '<input type="submit" value="Enregistrer" style="display: none">';
        echo '</div>';

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
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].readOnly = false;
        }

        var saveButton = document.querySelector('input[type="submit"]');
        saveButton.style.display = "block";

        var editButton = document.querySelector('input[type="button"]');
        editButton.disabled = true;
    }
</script>
</body>
</html>