var images_modal = document.getElementById('mydialog');

// When the user clicks anywhere outside of the modal, close it

window.onclick = function(event) {
   if (event.target == images_modal) {

      images_modal.style.visibility='hidden';

    }
}