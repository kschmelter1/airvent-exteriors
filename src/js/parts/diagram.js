jQuery(document).ready(function( $ ) {
  "use strict";

  $(".block-diagram").each(function(){
    let options = {};
    const thisSwiper = $(this).find(".swiper-container");
    const hotspots = $(this).find(".hotspot");
    // Checks the slider has more than one slide. If it doesn't, pagination is disabled for that slider.
    if ( $(this).find(".swiper-slide").length > 1 ) {
      options = {
        loop: false,
        slidesPerView: 1,
        navigation: {
          nextEl: $(this).find(".button-next"),
          prevEl: $(this).find(".button-prev"),
        },
        fadeEffect: {
          crossFade: true
        },
        effect: 'fade'
      }
    } else {
      options = {
          loop: false,
          autoplay: false,
      }
      $(this).find(".button-next").remove();
      $(this).find(".button-prev").remove();
    }
    const swiper = new Swiper(thisSwiper, options);

    hotspots.click(swiper, function(){
      const targetSlide = $(this).data("number");
      swiper.slideTo(targetSlide);
    });

    swiper.on('slideChange', function () {
      const targetSpot = swiper.realIndex;
      hotspots.removeClass('active');
      hotspots.each( function() {
        if ($(this).data("number") == targetSpot) {
          $(this).addClass('active');
        }
      });

    });
  });

});
