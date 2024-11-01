// Sélectionnez les éléments du DOM
const verticalNavbar = document.getElementById("vertical-navbar");
const closeButton = document.getElementById("close-button");
const adminLink = document.querySelector(".admin");
const loginForm = document.querySelector(".login-form");
const imageElement = document.getElementById("main-image");
const form = document.getElementById("avis_form");

// Variables pour le suivi des états
let isNavbarVisible = false;
let currentIndex = 0;

// Fonction pour masquer la barre de navigation en mode bureau
function hideVerticalNavbarOnDesktop() {
  if (window.innerWidth > 834) {
    verticalNavbar.style.display = "none";
    isNavbarVisible = false;
  }
}

window.addEventListener("resize", hideVerticalNavbarOnDesktop);
document.addEventListener("DOMContentLoaded", hideVerticalNavbarOnDesktop);

// Fonction pour basculer le formulaire de connexion admin
function toggleAdminLoginForm() {
  const isFormVisible = loginForm.style.display === "block";
  loginForm.style.display = isFormVisible ? "none" : "block";
}

adminLink?.addEventListener("click", (event) => {
  event.preventDefault();
  toggleAdminLoginForm();
});

// Liste des chemins d'accès des images
const imagePaths = [
  "public/assets/jungle/tigre.jpg",
  "public/assets/savane/elephant.jpg",
  "public/assets/marais/hipopotame.jpg",
  "public/assets/savane/lion.jpg",
];

// Fonction pour changer l'image toutes les 5 secondes
function changeImage() {
  currentIndex = (currentIndex + 1) % imagePaths.length;
  imageElement.src = imagePaths[currentIndex];
}

setInterval(changeImage, 5000);

// Fonction pour basculer l'affichage des informations supplémentaires
function toggleInfo(button) {
  const moreInfo = button.parentElement.nextElementSibling;
  const isVisible = moreInfo.style.display === "block";
  moreInfo.style.display = isVisible ? "none" : "block";
  button.textContent = isVisible ? "En savoir plus..." : "Afficher moins...";
}

// Envoi AJAX du formulaire d'avis
form?.addEventListener("submit", function (event) {
  event.preventDefault();
  console.log("Formulaire soumis");

  fetch("../../actions/avis/traitement_avis.php", {
    method: "POST",
    body: new FormData(form),
  })
    .then((response) => response.json())
    .then((data) => {
      const messageDiv = document.getElementById("message");
      messageDiv.style.color = data.status === "success" ? "green" : "red";
      messageDiv.textContent = data.message;
      messageDiv.style.display = "block";
    })
    .catch((error) => {
      console.error("Erreur lors de la soumission du formulaire :", error);
    });
});

// Gestion des clics "J'aime" pour chaque animal
document.querySelectorAll(".jaime-btn").forEach((button) => {
  button.addEventListener("click", async () => {
    const animalName = button.getAttribute("data-animal") || button.id.split("-")[1];

    try {
      const response = await fetch(`mongodb://127.0.0.1:27017/animal/${animalName}/click`, {
        method: "POST",
      });

      if (response.ok) {
        const data = await response.json();
        console.log(`${animalName} compteur incrémenté :`, data.animal.views);

        // Met à jour le compteur sur la page
        const resultDiv = document.querySelector(`#result-${animalName}`);
        if (resultDiv) {
          resultDiv.textContent = `${animalName}: ${data.animal.views}`;
        }
      } else {
        console.error("Erreur lors de l'incrémentation du compteur");
      }
    } catch (error) {
      console.error("Erreur lors de l'incrémentation:", error);
    }
  });
});
