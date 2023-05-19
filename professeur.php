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
    <link rel="stylesheet" href="style3.css" />
</head>

<body>
    <header>
        <ul class="menu">
            <li><a href="#" class="test">
                    <?php
                    echo $_SESSION['prénom'] . ' ' . $_SESSION['nom'];
                    ?>
                </a>
                <ul class="sousmenu">
                    <li><a href="#">Mon compte</a></li>
                    <li><a href="connexion.php">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <p>je suis sur la page prof</p>
</body>

</html>