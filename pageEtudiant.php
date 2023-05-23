<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillzz_etudiant</title>
    <link rel="stylesheet" href="carrousel.css" />
</head>

<body>
    <?php include("headerE.php"); ?>
    <?php include("footerE.php"); ?>

    <h2 class="animated-heading">Mes compétences les plus populaires:</h2>
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

    <div class="container container2">
        <h2>Bienvenue sur Skillzz</h2>
        <br>
        <span>Skillzz est une plateforme qui vous permet de suivre et d'améliorer vos compétences. Notre site vous offre un moyen simple et efficace de gérer vos compétences et de mesurer votre progression.</span>
        <h2>Les nouvelles compétences :</h2>
        <div class="carrousel carrousel2">
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