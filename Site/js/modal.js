var modal = document.getElementById('mydialog');
var button = document.getElementById('openModal');

// When the user clicks anywhere outside of the modal, close it


button.onclick = function() {
    modal.style.visibility='visible'
}

window.onclick = function(event) {
   if (event.target != modal || event.target != button) {

      modal.style.visibility='hidden';

    }
}