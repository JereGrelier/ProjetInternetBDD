var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("menuBouton");
var closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

/* Set the width of the side navigation to 250px */
function openNav() {
  sidenav.classList.add("active");
}

/* Set the width of the side navigation to 0 */
/**
 * It takes a random number from 1 to 898, and then uses that number to get a random pokemon from the
 * API. It then uses the data from the API to fill in the HTML elements
 * @returns The JSON object that is being returned is a dictionary of the pokemon's name, id, weight,
 * types, and moves.
 */
function closeNav() {
  sidenav.classList.remove("active");
}
