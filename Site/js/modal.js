var modal = document.getElementById('mydialog');
var button = document.getElementById('openModal');

// When the user clicks anywhere outside of the modal, close it


button.onclick = function() {
    modal.style.visibility='visible'
}

window.onclick = function(event) {
   if (event.target != modal && event.target != button && event.target.parentNode != modal && event.target.parentNode.parentNode != modal && event.target.parentNode.parentNode.parentNode != modal) {
        console.log(event.target.parentNode.parentNode.parentNode);
        console.log("On ferme");
        modal.style.visibility='hidden';
    }
}