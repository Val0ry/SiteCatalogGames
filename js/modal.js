// Récupérer tous les éléments d'image avec l'attribut data-image-source
const imageElements = document.querySelectorAll('[data-image-source]');

// Récupérer le modal et l'image à l'intérieur
const modal = document.getElementById('defaultModal');
const modalImage = modal.querySelector('[data-carousel-item] img');

// Variables pour stocker les informations sur l'image actuellement affichée
let currentImageIndex = 0;

// Fonction pour ouvrir le modal avec l'image spécifiée
function openModal(imageIndex) {
  modalImage.src = imageElements[imageIndex].getAttribute('data-image-source');
  currentImageIndex = imageIndex;
  modal.classList.remove('hidden');
}

// Parcourir tous les éléments d'image et ajouter les écouteurs d'événements
imageElements.forEach((imageElement, index) => {
  // Ajouter un écouteur d'événement au clic de l'image
  imageElement.addEventListener('click', () => {
    openModal(index);
  });
});

// Fermer le modal lorsqu'on clique en dehors de l'image
modal.addEventListener('click', (event) => {
  if (event.target === modal) {
    modal.classList.add('hidden');
  }
});

// Fermer le modal lorsque la touche Échap est pressée
document.addEventListener('keydown', (event) => {
  if (event.key === 'Escape') {
    modal.classList.add('hidden');
  }
});

// Fonction pour afficher l'image suivante dans le carrousel modal
function showNextImage() {
  const nextImageIndex = (currentImageIndex + 1) % imageElements.length;
  openModal(nextImageIndex);
}

// Fonction pour afficher l'image précédente dans le carrousel modal
function showPreviousImage() {
  const previousImageIndex = (currentImageIndex - 1 + imageElements.length) % imageElements.length;
  openModal(previousImageIndex);
}