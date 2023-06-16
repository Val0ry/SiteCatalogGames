let x = document.getElementById("errorUsername");

// Ajouter la classe "show" à l'élément DIV
x.className = "show";

// Après 3 secondes, retirer la classe "show" de l'élément DIV
setTimeout(function () {
  x.className = x.className.replace("show", "");
}, 3000);
