var sidenav = document.getElementById("mySidenav");
var closeBtn = document.getElementById("closeBtn");

closeBtn.onclick = openNav;


function openNav() {
  if (sidenav.classList.contains("active")){
    sidenav.classList.remove("active");
  }
  else
    sidenav.classList.add("active");
}