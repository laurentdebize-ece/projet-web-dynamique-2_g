<?php
if (isset($_SESSION['nom'])) {
	session_destroy();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<title>Skillzz</title>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
</head>

<body>

	<a href="administrateur.php">
		<header>
			<span class="admin">Administrateur</span>
		</header>
	</a>

	<div class="container" id="container">
		<div class="form-container loginP-container">
			<form method="post" action="traitementProf.php">
				<h1>Connexion professeur</h1>
				<span>Utiliser compte Professeur</span>
				<input type="email" placeholder="Email" name="emailProfesseur">
				<input type="password" placeholder="Mot de passe" name="mdpProfesseur">
				<button type="submit" name="envoyer">Se connecter</button>
			</form>
		</div>
		<div class="form-container loginE-container">
			<form method="post" action="traitementEtudiant.php">
				<h1>Connexion étudiant</h1>
				<span>Utiliser compte Etudiant</span>
				<input type="email" placeholder="Email" name="emailEtudiant">
				<input type="password" placeholder="Mot de passe" name="mdpEtudiant">
				<button>Se connecter</button>
			</form>
		</div>

		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-gauche">
					<h1>Bienvenue sur Skillzz.</h1>
					<p>Pour vous connecter avec votre compte étudiant, veuillez cliquer sur le bouton ci-dessous.</p>
					<button class="ghost" id="loginE">Etudiant</button>
				</div>
				<div class="overlay-panel overlay-droite">
					<h1>Bienvenue sur Skillzz.</h1>
					<p>Pour vous connecter avec votre compte professeur, veuillez cliquer sur le bouton ci-dessous. </p>
					<button class="ghost" id="loginP">Professeur</button>
				</div>
			</div>
		</div>
	</div>

	<script src="scriptConnexion.js" charset="utf-8"></script>
</body>

</html>