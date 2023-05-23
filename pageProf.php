<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillzz_professeur</title>
    <link rel="stylesheet" href="carrousel.css" />
</head>

<body>
    <?php include("headerP.php"); ?>
    <?php include("footerP.php"); ?>


    <h2 class="animated-heading">Bienvenue sur Skillzz professeur</h2>
    <br>
    <span>Skillzz professeur est une plateforme qui vous permet de suivre evos élèves et de noter leurs compétences. Notre site vous offre un moyen simple et efficace de gérer vos classes et de mesurer leur progression.</span>
    <h2 class="animated-heading">Les nouvelles compétences ajoutées recemment:</h2>
    <div class="container container1">
        <div class="carrousel">
            <?php
            $serveur = "localhost";
            $utilisateur = "root";
            $motdepasse = "root";
            $bdd = "Skillzz";
            try {

                $connexion = new PDO("mysql:host=$serveur;dbname=$bdd", $utilisateur, $motdepasse);

                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                $query = "SELECT * FROM compétence";
                $stmt = $connexion->query($query);


                if ($stmt->rowCount() > 0) {

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<article class="bloc">';
                        echo '<p>' . $row['descriptions'] . '</p>';
                        echo '</article>';
                    }
                } else {
                    echo "Aucune compétence trouvée dans la base de données.";
                }


                $connexion = null;
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
            ?>
        </div>
    </div>

    <script src="carrousel.js" charset="utf-8"></script>
</body>

</html>