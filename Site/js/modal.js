var modal = document.getElementById('mydialog');
var button = document.getElementsById('openModal')

// When the user clicks anywhere outside of the modal, close it

window.onclick = function(event) {
   if (event.target != modal && event.target != button) {

      modal.style.visibility='hidden';

    }
}