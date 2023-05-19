<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page d'accueil - Myskills</title>
  <style>
    /* CSS général */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    header {
      background-color: #333;
      padding: 20px;
      color: #fff;
    }

    nav ul {
      list-style: none;
      display: flex;
    }

    nav ul li {
      margin-right: 10px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
    }

    .carousel-container {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 400px;
      background-color: #fff;
      overflow: hidden;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .carousel {
      display: flex;
      transition: transform 0.5s;
    }

    .carousel-item {
      flex-shrink: 0;
      width: 200px;
      height: 300px;
      margin: 0 10px;
      border-radius: 5px;
      overflow: hidden;
      background-color: #fff;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }

    .carousel-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .carousel-item a {
      display: block;
      width: 100%;
      height: 100%;
    }

    .carousel-controls {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
    }

    .carousel-button {
      background: none;
      border: none;
      font-size: 24px;
      color: #fff;
      cursor: pointer;
    }

    footer {
      background-color: #333;
      padding: 20px;
      color: #fff;
      display:flex;
      justify-content : center;    
    }

    .container {
      max-width: 960px;
      margin: 0 auto;
      padding: 40px;
      background-color: #fff;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    h1 {
      font-size: 28px;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    p {
      font-size: 18px;
      line-height: 1.5;
      margin-bottom: 20px
    }

.highlight {
  color: #C7DDC5;
  font-weight: bold;
}

.feature-container {
  display: flex;
  justify-content: space-between;
  margin-bottom: 40px;
}

.feature {
  flex-basis: 30%;
  text-align: center;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  transition: box-shadow 0.3s;
}

.feature img {
  width: 80px;
  height: 80px;
  margin-bottom: 10px;
}

.feature h3 {
  font-size: 20px;
  margin-bottom: 10px;
}

.feature p {
  font-size: 16px;
}

.feature:hover {
  box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
}

.cta-button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #f0cb64;
  color: #000;
  text-decoration: none;
  font-size: 18px;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.cta-button:hover {
  background-color: #e0b352;
}

/* Additional Styles */

.animated-heading {
  position: relative;
  display: inline-block;
}

.animated-heading::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 2px;
  background-color: #f0cb64;
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.3s ease-in-out;
}

.animated-heading:hover::after {
  transform: scaleX(1);
}

/* Custom Styles */

.welcome-section {
  margin-bottom: 40px;
  background-color: #c7ddc5;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
}

.welcome-section h1 {
  color: #fff;
  text-shadow: none;
}

.highlight-text {
  display: inline-block;
  background-color: #c7ddc5;
  color: #000;
  padding: 5px 10px;
  border-radius: 5px;
  font-weight: bold;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
}

/* Responsive Styles */

@media (max-width: 768px) {
  .feature-container {
    flex-wrap: wrap;
  }

  .feature {
    flex-basis: 100%;
    margin-bottom: 20px;
  }
}
</style>
</head>

<body>
<?php include("header.php"); ?>
<?php include("footer.php"); ?>

<br>
<br>
<br>

<h2 class="animated-heading">Mes compétences les plus populaires:</h2>
<div class="carousel-container">
<div class="carousel">
  <div class="carousel-item">
    <a href="page1.html">
    <img src="image1.png" alt="Image 1">
        </a>
      </div>
      <div class="carousel-item">
        <a href="page2.html">
          <img src="image2.png" alt="Image 2">
        </a>
      </div>
      <div class="carousel-item">
        <a href="page3.html">
          <img src="image3.png" alt="Image 3">
        </a>
      </div>
      <div class="carousel-item">
        <a href="page4.html">
          <img src="image4.png" alt="Image 4">
        </a>
      </div>
      <div class="carousel-item">
        <a href="page5.html">
          <img src="image5.png" alt="Image 5">
        </a>
      </div>
      <div class="carousel-item">
        <a href="page1.html">
          <img src="image1.png" alt="Image 6">
        </a>
      </div>
    </div>

    <div class="carousel-controls">
      <button class="carousel-button prev-button">&larr;</button>
      <button class="carousel-button next-button">&rarr;</button>
    </div>
  </div>

  <br>
  <br>
  <div class="container">
    <div class="welcome-section">
      <h1 class="animated-heading">Bienvenue sur <span class="highlight-text">Skills</span></h1>
      <div class="box">
        <p>Skills est une plateforme qui vous permet de suivre et d'améliorer vos compétences. Notre site vous offre un moyen simple et efficace de gérer vos compétences et de mesurer votre progression.</p>
      </div>
    </div>

    <h2 class="animated-heading">Les nouvelles compétences:</h2>
    <div class="carousel-container">
      <div class="carousel">
        <div class="carousel-item">
          <a href="page1.html">
            <img src="image6.png" alt="Image 6">
          </a>
        </div>
        <div class="carousel-item">
          <a href="page2.html">
            <img src="image7.png" alt="Image 7">
          </a>
        </div>
        <div class="carousel-item">
          <a href="page3.html">
            <img src="image8.png" alt="Image 8">
          </a>
        </div>
        <div class="carousel-item">
          <a href="page1.html">
            <img src="image1.png" alt="Image">
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
        <img src="icone1p.png" alt="Icone 1">
        <h3>Suivi des compétences</h3>
        <p>Enregistrez vos compétences et suivez votre progression au fil du temps. Obtenez une vue d'ensemble claire de vos points forts et identifiez les domaines dans lesquels vous pouvez vous améliorer.</p>
      </div>
      <div class="feature">
        <img src="icone1e.png" alt="Icone 3">
        <h3>Ressources et formations</h3>
        <p>Accédez à une bibliothèque de ressources pédagogiques et de formations en ligne pour développer vos compétences. Améliorez vos connaissances et restez à jour avec les dernières avancées dans votre domaine.</p>
      </div>
    </div>

    <p class="highlight">Prêt à développer vos compétences et à atteindre de nouveaux sommets ? Connectez-vous dès maintenant et commencez votre parcours de développement personnel.</p>
  </div>

  <footer>
    <!-- Footer -->
    &copy; 2023 | Tous droits réservés.
  </footer>

  <script>
    const carousel = document.querySelector('.carousel');
    const prevButton = document.querySelector('.prev-button');
    const nextButton = document.querySelector('.next-button');
    const carouselItems = document.querySelectorAll('.carousel-item');
    const totalItems = carouselItems.length;
    const itemWidth = carouselItems[0].offsetWidth + 10; // Largeur de chaque élément du carrousel + marge
    const visibleItems = 3; // Nombre d'éléments visibles à la fois
    const step = itemWidth;
    let currentIndex = 0;

    prevButton.addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex--;
      }
      updateCarousel();
    });

    nextButton.addEventListener('click', () => {
      if (currentIndex < totalItems - visibleItems) {
        currentIndex++;
      }
      updateCarousel();
    });

    function updateCarousel() {
      const translateValue = -currentIndex * step;
      carousel.style.transform = `translateX(${translateValue}px)`;
    }

    updateCarousel(); // Appel initial pour afficher les premiers éléments
  </script>
</body>
</html>


     

