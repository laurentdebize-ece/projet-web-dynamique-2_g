<head>
    <title>Mon Compte </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="monCompte.css" />
</head>
<body>
    <?php include("header.php"); ?>
    <?php include("footer.php"); ?>
    <div class="container">
        <h1>Mon compte</h1>
        <form>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="Dupont" readonly>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="Jean" readonly>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="15 rue de la Paix" readonly>

            <label for="classe">Classe :</label>
            <input type="text" id="classe" name="classe" value="2nde" readonly>

            <label for="promotion">Promotion :</label>
            <input type="text" id="promotion" name="promotion" value="2025" readonly>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="jean.dupont@example.com" readonly>

            <input type="button" value="Modifier mes informations" onclick="toggleEditMode()">
            <input type="submit" value="Enregistrer" style="display: none">
        </form>
    </div>
</body>