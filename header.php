<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="header.css" />
</head>
<header>
  <div class="logo">
    <img src="logo-du-site.png" alt="Logo du site">
  </div>
  <nav>
    <ul class="menu">
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Mes matières</a></li>
      <li><a href="#">Mes compétences</a></li>
      <li><a href="quisommesnous.php"> Qui sommes nous?</a></li>
      <li class="test"><a href="#">
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
  </nav>
</header>