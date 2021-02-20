/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './scss/main.scss';

// start the Stimulus application
import './bootstrap';

let app = {
    init: function () {
        // Handle navbar menu on mobile
        let navbarToggleElement = document.querySelector('.js-navbar-toggle');
        navbarToggleElement.addEventListener('click', app.handleNavbarToggleClick);

        // Handle alert closes
        let alertCloseElements = document.querySelectorAll('.alert__close');
        for (let element of alertCloseElements) {
            element.addEventListener('click', app.handleAlertCloseClick);
        }
    },

    handleNavbarToggleClick: function () {
        let navbarMenuElement = document.querySelector('.js-navbar-menu');
        navbarMenuElement.classList.toggle('visible');
    },

    handleAlertCloseClick: function (event) {
        let parentElement = event.currentTarget.parentNode;

        parentElement.classList.add('hidden');
        setTimeout(function () {
            parentElement.remove();
        }, 300)
    }
};

document.addEventListener('DOMContentLoaded', app.init);
