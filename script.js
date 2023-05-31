/*  fonction affichage mot de passe Login   */
let eyeandoff = document.querySelector(".bi");
const passwordField = document.querySelector("input[type=password]");

if (eyeandoff != undefined) {
  eyeandoff.addEventListener("click", () => {
    eyeandoff.classList.toggle("bi-eye");
    eyeandoff.classList.toggle("bi-eye-slash");

    if (passwordField.type == "text") {
      passwordField.type = "password";
    } else {
      passwordField.type = "text";
    }
  });
}
