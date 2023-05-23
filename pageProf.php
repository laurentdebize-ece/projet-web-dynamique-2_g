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
    <link rel="stylesheet" href="caroussel.css" />
</head>

<body>
    <?php include("header.php"); ?>
    <?php include("footer.php"); ?>


    <br>
    <br>
    <div class="container">
        <div class="welcome-section">
            <h1 class="animated-heading">Bienvenue sur <span class="highlight-text">Skills professeurs</span></h1>
            <div class="box">
                <p>Skills professeur est une plateforme qui vous permet de suivre evos élèves et de noter leurs compétences. Notre site vous offre un moyen simple et efficace de gérer vos classes et de mesurer leur progression.</p>
            </div>
        </div>

        <h2 class="animated-heading">Les nouvelles compétences ajoutées recemment:</h2>
        <div class="carousel-container">
            <div class="carousel">
                <div class="carousel-item">
                    <a href="page1.html">
                        <img src="images/image6.png" alt="Image 6">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="page2.html">
                        <img src="images/image7.png" alt="Image 7">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="page3.html">
                        <img src="images/image8.png" alt="Image 8">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="page1.html">
                        <img src="images/image1.png" alt="Image">
                    </a>
                </div>
            </div>
            <div class="carousel-controls">
                <button class="carousel-button prev-button">&larr;</button>
                <button class="carousel-button next-button">&rarr;</button>
            </div>
        </div>

        <div class="feature-container">
            <div class="feature">
                <img src="images/icone1e.png" alt="Icone 1">
                <h3>Suivi des compétences</h3>
                <p>Enregistrez de nouvelles compétences pour vos élèves et suivez leur progression au fil du temps.</p>
            </div>
            <div class="feature">
                <img src="images/icone1p.png" alt="Icone 3">
                <h3>Ressources et formations</h3>
                <p>Accédez à une bibliothèque de ressources pédagogiques et de formations en ligne pour développer vos compétences. </p>
            </div>
        </div>

        <p class="highlight">Prêt à développer vos compétences et à atteindre de nouveaux sommets ? Connectez-vous dès maintenant et commencez votre parcours de développement personnel.</p>
    </div>

    <script src="caroussel.js" charset="utf-8"></script>
</body>

</html>