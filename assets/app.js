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

import $ from "jquery";

document.addEventListener("DOMContentLoaded", () => {
  const itemsElements = document.querySelector("[data-items]");
  let data = JSON.parse(itemsElements.getAttribute("data-items"));

  let likeBtns = document.querySelectorAll(".btn-likes");
  for (let i = 0; i < likeBtns.length; i++) {
    likeBtns[i].addEventListener("click", function (e) {
      let phpResponse = ""
      // add into database the like event
      $.ajax({
        type: "POST",
        url: "addlike/" + data[i].id,
        data: {
          id: data[i].id,
        },
        dataType: "json",
        success: function (response) {
          phpResponse = response
        },
      });

      console.log(phpResponse);
      // change the heart color and add 1 to the length
      let icon = likeBtns[i].firstElementChild;
      icon.className = "fas fa-heart";
      icon.ariaHidden = false;
      likeBtns[i].classList.add("fullHeart");
      
    });
  }
});
