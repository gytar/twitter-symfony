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

document.addEventListener("DOMContentLoaded", () => {
  const itemsElements = document.querySelector("[data-items]");
  let data = JSON.parse(itemsElements.getAttribute("data-items")); 
  let likeBtns = document.querySelectorAll(".btn-likes")

  for (let i = 0; i < likeBtns.length; i++) {
    likeBtns[i].addEventListener("click", function() {
        alert(data[i].id);
        
    });
}

   

});
