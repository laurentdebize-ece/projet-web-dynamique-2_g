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