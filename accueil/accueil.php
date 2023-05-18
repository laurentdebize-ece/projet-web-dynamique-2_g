

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Page d'accueil - OmnesMyskills</title>
<style>
/* CSS général */
* {
box-sizing: border-box;
margin: 0;
padding: 0;
}

body {
font-family: Arial, sans-serif;
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
}

.carousel {
display: flex;
transition: transform 0.5s;
}

.carousel-item {
flex-shrink: 0;
width: 300px;
height: 300px;
margin: 0 10px;
border-radius: 5px;
overflow: hidden;
background-color: #fff;
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
text-align: center;
}

.container {
max-width: 960px;
margin: 0 auto;
padding: 40px;
}

h1 {
font-size: 28px;
margin-bottom: 20px;
}

p {
font-size: 18px;
line-height: 1.5;
margin-bottom: 20px;
}

.highlight {
color: #f0cb64;
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
</style>
</head>

<body>
<header>
<!-- Bandeau de menu -->
<nav>
<ul>
<li><a href="#">Accueil</a></li>
<li><a href="#">Produits</a></li>
<li><a href="#">Services</a></li>
<li><a href="#">Support</a></li>
</ul>
</nav>
</header>

<div class="carousel-container">
<div class="carousel">
<div class="carousel-item">
<a href="page1.html">
<img src="image1.jpg" alt="Image 1">
</a>
</div>
<div class="carousel-item">
<a href="page2.html">
<img src="image2.jpg" alt="Image 2">
</a>
</div>
<div class="carousel-item">
<a href="page3.html">
<img src="image3.jpg" alt="Image 3">
</a>
</div>
<div class="carousel-item">
<a href="page4.html">
<img src="image4.jpg" alt="Image 4">
</a>
</div>
<div class="carousel-item">
<a href="page5.html">
<img src="image5.jpg" alt="Image 5">
</a>
</div>
<div class="carousel-item">
<a href="page1.html">
<img src="image1.jpg" alt="Image 6">
</a>
</div>
</div>

<div class="carousel-controls">
<button class="carousel-button prev-button">&larr;</button>
<button class="carousel-button next-button">&rarr;</button>
</div>
</div>

<div class="container">
<h1>Bienvenue sur OmnesMyskills</h1>
<p>OmnesMyskills est une plateforme qui vous permet de suivre et d'améliorer vos compétences. Que vous soyez étudiant, professionnel ou passionné, notre site vous offre un moyen simple et efficace de gérer vos compétences et de mesurer votre progression.</p>

<div class="feature-container">
<div class="feature">
<img src="icon1.png" alt="Icone 1">
<h3>Suivi des compétences</h3>
<p>Enregistrez vos compétences et suivez votre progression au fil du temps. Obtenez une vue d'ensemble claire de vos points forts et identifiez les domaines dans lesquels vous pouvez vous améliorer.</p>
</div>
<div class="feature">
<img src="icon2.png" alt="Icone 2">
<h3>Communauté active</h3>
<p>Rejoignez une communauté d'apprenants et partagez vos expériences, vos réalisations et vos conseils. Connectez-vous avec des personnes partageant les mêmes intérêts et apprenez les uns des autres.</p>
</div>
<div class="feature">
<img src="icon3.png"
alt="Icone 3">
<h3>Ressources et formations</h3>
<p>Accédez à une bibliothèque de ressources pédagogiques et de formations en ligne pour développer vos compétences. Améliorez vos connaissances et restez à jour avec les dernières avancées dans votre domaine.</p>
</div>
</div>

<p class="highlight">Prêt à développer vos compétences et à atteindre de nouveaux sommets ? Inscrivez-vous dès maintenant et commencez votre parcours de développement personnel.</p>
</div>

<footer>
<!-- Footer -->
<p>&copy; 2023 | Tous droits réservés.</p>
</footer>

<script>
const carousel = document.querySelector('.carousel');
const prevButton = document.querySelector('.prev-button');
const nextButton = document.querySelector('.next-button');
const carouselItems = document.querySelectorAll('.carousel-item');
const totalItems = carouselItems.length;
const itemWidth = carouselItems[0].offsetWidth + 20; // Largeur de chaque élément du carrousel + marge
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

