var modal = document.getElementById('mydialog');
var button = document.getElementById('openModal');

// When the user clicks anywhere outside of the modal, close it


button.onclick = function () {
    modal.style.visibility = 'visible'
}

window.onclick = function (event) {
    if (event.target != modal && event.target != button && event.target.parentNode != modal) {
        if (event.target.parentNode.parentNode != modal &&
            event.target.parentNode.parentNode.parentNode != modal && event.target.parentNode.parentNode.parentNode.parentNode != modal &&
            event.target.parentNode.parentNode.parentNode.parentNode.parentNode != modal) {
            modal.style.visibility = 'hidden';
        }
    }
}