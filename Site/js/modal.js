var modal = document.getElementById('mydialog');
var button = document.getElementsByClassName('openModal')

// When the user clicks anywhere outside of the modal, close it

window.onclick = function(event) {
   if (event.target != modal && event.target != button.item(0)) {

      modal.style.visibility='hidden';

    }
}