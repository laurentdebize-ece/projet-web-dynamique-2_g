<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillzz_connexion_administrateur</title>
    <link rel="stylesheet" href="connexionAdmin.css" />
</head>
<body>
<div class="container" id="container">
        <div class="form-container loginA-container">
            <form method="post" action="traitementAdmin.php">
                <h1>Connexion administrateur</h1>
                <span>Utiliser compte Administrateur</span>
                <input type="email" placeholder="Email" name="emailAdmin">
                <input type="password" placeholder="Mot de passe" name="mdpAdmin">
                <button type="submit">Se connecter</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-droite">
                    <h1>Bienvenue sur Skillzz.</h1>
                    <p>Pour vous connecter avec votre compte administrateur, veuillez utiliser votre email et votre mot de passe. </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>