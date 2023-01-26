/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
// import './bootstrap';

import 'tw-elements';

require('@fortawesome/fontawesome-free/css/all.min.css');
// require('@fortawesome/fontawesome-free/js/all.js');

    const element = document.getElementById("icon-sun-moon");

    if(localStorage.getItem("checkedbox") == 'true') {
        element.classList.add("fas","fa-sun");
    } else {
        element.classList.add("fas","fa-moon");
    }

document.querySelector("#button-switch-theme-icon").addEventListener("click", function() {
    const element = document.getElementById("icon-sun-moon");

    if(localStorage.getItem("checkedbox") == 'true') {
        localStorage.setItem("checkedbox", 'false');
        localStorage.theme = 'light'
        document.querySelector("html").classList.remove("dark");
        element.classList.add("fas","fa-moon");
    }
    else {
        localStorage.setItem("checkedbox", 'true');
        localStorage.theme = 'dark'
        document.querySelector("html").classList.add("dark");
        element.classList.add("fas","fa-sun");
    }
})