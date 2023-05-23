<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="headerE.css" />
</head>

<header>
  <div class="logo">
    <img src="images/logo_Skillzz.png" alt="logo">
  </div>
  <nav>
    <ul class="menu">
      <li class="centered"><a href="pageProf.php">Accueil</a></li>
      <li class="centered"><a href="matiereP.php">Mes matières</a></li>
      <li class="centered"><a href="competenceP.php">Mes compétences</a></li>
      <li class="centered"><a href="quisommesnousP.php"> Qui sommes nous ?</a></li>
      <li class="test">
        <a href="#">
          <svg width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg" color="#000000">
            <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z" stroke="#00203f"
              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M4.271 18.346S6.5 15.5 12 15.5s7.73 2.846 7.73 2.846M12 12a3 3 0 100-6 3 3 0 000 6z"
              stroke="#00203f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
          <?php
          echo $_SESSION['prénom'] . ' ' . $_SESSION['nom'];
          ?>
        </a>
        <ul class="sousmenu">
          <li><a href="moncompteProf.php">Mon compte</a></li>
          <li><a href="connexion.php">Déconnexion</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</header>