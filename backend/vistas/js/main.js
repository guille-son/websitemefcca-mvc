$(document).ready(function () {
    // Get the container element
    var btnContainer = document.getElementById("ulBotonesMenu");

    // Get all buttons with class="btn" inside the container
    var btns = btnContainer.getElementsByClassName("nav-link");

    var pantalla = document.getElementById("pantalla").innerHTML;

    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < btns.length; i++) {

        if(btns[i].getAttribute("pantalla") == pantalla) {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            btns[i].className += " active";
        }
    }
});