const carrousel = document.querySelector('.carrousel');
let articleSelectionne = null;

carrousel.addEventListener('click', (event) => {
  const articleClique = event.target.closest('.bloc');
  if (articleClique && carrousel.contains(articleClique)) {
    if (articleSelectionne) {
      articleSelectionne.classList.remove('selected');
    }
    articleSelectionne = articleClique;
    articleSelectionne.classList.add('selected');
  } else {
    if (articleSelectionne) {
      articleSelectionne.classList.remove('selected');
      articleSelectionne = null;
    }
  }
});
