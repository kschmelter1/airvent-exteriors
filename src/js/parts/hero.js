jQuery(document).ready(function( $ ) {
  "use strict";

  const hero = document.getElementById("hero-cols");
  if (hero) {
    const btns = hero.getElementsByClassName('btn');

    for (let i = 0; i < btns.length; i++) {
      btns[i].addEventListener('mouseenter', function(){
        const panel = this.parentElement.dataset.number;
        if (panel > 0) {
          hero.classList.remove("active-left");
          hero.classList.add("active-right");
        } else {
          hero.classList.remove("active-right");
          hero.classList.add("active-left");
        }
      });
    }

    hero.addEventListener('mouseleave', function() {
      hero.classList.remove("active-left");
      hero.classList.remove("active-right");
    });
  }

});
