jQuery(document).ready(function( $ ) {
  "use strict";

/*********************
 *  Masonry Gallery  *
 *********************/
function initMasonry(targetGrid) {
  let msnry = targetGrid.masonry({
    itemSelector: '.grid-item',
    columnWidth: $(this).find('.grid-sizer')[0],
    percentPosition: true
  });

  // layout Masonry after each image loads
  msnry.imagesLoaded().progress( function() {
    msnry.masonry('layout');
  });
}

// Get the array of checkboxes
const galleryFilter = $('.gallery-categories-list input');
galleryFilter.change(function() {
        const boxValue = $(this).val(); // Input's value which is equal to a masonry wrapper's ID
        const targetGallery = $(boxValue);
        if(this.checked) {
            targetGallery.addClass('active'); //Make the wrapper visible
            const targetGrid = $(boxValue+' .grid');
            initMasonry(targetGrid);
        } else {
          targetGallery.removeClass('active');
        }
    });

// Gets the "select all" and "select none" toggles
const galleryToggle = $('.gallery-categories-options span');
galleryToggle.click(function() {
    const myVal = $(this).data('check'); // Returns true or false
    galleryFilter.each(function(){ // Go through checkboxes to either turn all on or off
      $(this).prop('checked', myVal).change();
    });
});

const urlGal = window.location.href.match(/gal=(.*?)([&#]|$)/); // Looks for this on URL: ?gal=gallery-post-name
if (urlGal) {
  $('#'+urlGal[1]).prop('checked', true).change(); // Turns on checkbox with same ID
} else {
  galleryFilter.first().prop('checked', true).change();
}

/**********************
 *  Lightbox Gallery  *
 **********************/
 //if ($(window).width() > 768) {
   // Initialize lightbox only on larger screen sizes
   $('.masonry-gallery').lightGallery({
     selector: '.img-wrap'
   });
   // Creates the all other images fade out effect
   const galImg = $('.masonry-gallery .img-wrap');
   galImg.mouseenter( function() {
     $(this).parent().addClass('hovered');
   });
   galImg.mouseleave( function() {
     $(this).parent().removeClass('hovered');
   });
 //}

 });
