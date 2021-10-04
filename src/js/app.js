jQuery(document).ready(function( $ ) {
  "use strict";

  const awningComposer = $('.cocoen');

  if (awningComposer.length) {

    document.querySelectorAll('.cocoen').forEach(function(element){
      new Cocoen(element);
    });
    console.log('ran cocoen');
  }

/*
 * Multilevel Dropdown
*/
const bp = 1199.98;

function toggleDropdown(tar, e) {
  if (!tar.next().hasClass('show')) {
    tar.parents('.dropdown-menu').first().find('.show').removeClass('show');
  }
  const $subMenu = tar.next('.dropdown-menu');
  //$subMenu.toggleClass('show');
  $subMenu.addClass('show');

  tar.parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass('show');
  });

  return false;
}

$('.navbar .dropdown-toggle-btn').on('click', function(e) {
  e.preventDefault();
  const tar = $(this).parent();
  toggleDropdown(tar, e);
});

if ($(window).width() > bp) {
  $('.navbar .dropdown-toggle').on('mouseenter', function(e) {
    //const tar = $(this).parent();
    const tar = $(this);
    toggleDropdown(tar, e);
  });

  $('.navbar .dropdown-menu').on('mouseleave', function(e) {
    //const tar = $(this).parent();
    const tar = $(this);
    tar.removeClass('show');
  });
}

$('.navbar .dropdown-toggle-link').click(function(e) {
  //location.href = this.href;
  const tar = $(this).parent().attr('href');
  location.href = tar;
});

/********************
 *   Sidebar Menu   *
 ********************/
 const sidebar = $('.navbar-primary .navbar-collapse');

 $('.navbar-toggler').click(function(){
   sidebar.addClass('show');
   $('body').css('overflow', 'hidden');
 });

 $('.navbar-close').click(function(){
   sidebar.removeClass('show');
   $('body').css('overflow', 'auto');
 });


 /* Fades in the button when you scroll down */
  var link = document.getElementById("back-to-top");
  var amountScrolled = 250;

  window.addEventListener('scroll', function(e) {
      if ( window.pageYOffset > amountScrolled ) {
          link.classList.add('show');
      } else {
          link.className = 'back-to-top';
      }
  });

/* Scrolls to Top */
  link.addEventListener('click', function(e) {
      e.preventDefault();

      var distance = 0 - window.pageYOffset;
      var increments = distance/(500/16);
      function animateScroll() {
          window.scrollBy(0, increments);
          if (window.pageYOffset <= document.body.offsetTop) {
              clearInterval(runAnimation);
          }
      };
      // Loop the animation function
      var runAnimation = setInterval(animateScroll, 16);
  });

  /* Remove duplicate ids from ajax search box */
  $(".probox").each(function(){
    $(this).find("path").each(function() {
      $(this).removeAttr("id");
    });
    $(this).find("polygon").each(function() {
      $(this).removeAttr("id");
    });
  });

  /*$(".frm_button_submit").click(function() {
    $(this).addClass('disabled');
  });*/

  var loaded = false;
  $( window ).scroll(function() {
    if (!loaded) {
      loadscript();
      loaded = true;
    }
  });

  function loadscript(){
        $('footer')
            .append('<script src="//www.apex.live/scripts/invitation.ashx?company=airventext" defer></script>');
      }

});
