/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.sass";
import "bootstrap";

// start the Stimulus application
import "./bootstrap";


document.addEventListener('DOMContentLoaded', () => {
    const entryInfoElements = document.querySelector('[data-entry-info]');
    console.log(entryInfoElements.dataset.entryInfo);
    const entryInfoObjects =  Array.from(entryInfoElements).map(
        item => JSON.parse(item.dataset.entryInfo)
    )
    console.log(entryInfoObjects);
})