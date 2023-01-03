/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import 'tw-elements';

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

document.querySelector("#theme").addEventListener("click", function() {
    if(localStorage.getItem("checkedbox") == 'true') {
        localStorage.setItem("checkedbox", 'false');
        localStorage.theme = 'light'
        document.querySelector("html").classList.remove("dark");
    }
    else {
        localStorage.setItem("checkedbox", 'true');
        localStorage.theme = 'dark'
        document.querySelector("html").classList.add("dark")
    }
})