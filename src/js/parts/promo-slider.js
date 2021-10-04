jQuery(document).ready(function( $ ) {
  "use strict";

$(".block-promo-slider").each(function(){
  let options = {};
  const thisSwiper = $(this).find(".swiper-container");
  // Checks the slider has more than one slide. If it doesn't, pagination is disabled for that slider.
  if ( $(this).find(".swiper-slide").length > 1 ) {
    options = {
      loop: true,
      slidesPerView: 1,
      autoplay: {
       delay: 5000,
      },
        navigation: {
          nextEl: $(this).find(".swiper-button-next"),
          prevEl: $(this).find(".swiper-button-prev"),
        }
    }
  } else {
    options = {
        loop: false,
        autoplay: false,
    }
    $(this).find(".swiper-button-next").remove();
    $(this).find(".swiper-button-prev").remove();
  }
  const swiper = new Swiper(thisSwiper, options);
});

$(".block-testimonial-slider").each(function(){
  let options = {};
  const thisSwiper = $(this).find(".swiper-container");
  // Checks the slider has more than one slide. If it doesn't, pagination is disabled for that slider.
  if ( $(this).find(".swiper-slide").length > 1 ) {
    options = {
      loop: true,
      slidesPerView: 3,
      autoplay: {
       delay: 5000,
      },
        navigation: {
          nextEl: $(this).find(".swiper-button-next"),
          prevEl: $(this).find(".swiper-button-prev"),
        },
      breakpoints: {
        1024: {
          slidesPerView: 1
        },
        1300: {
          slidesPerView: 2
        }
      }
    }
  } else {
    options = {
        loop: false,
        autoplay: false,
    }
    $(this).find(".swiper-button-next").remove();
    $(this).find(".swiper-button-prev").remove();
  }
  const swiper = new Swiper(thisSwiper, options);
});

$(".block-design-slider").each(function(){
  let options = {};
  const thisSwiper = $(this).find(".swiper-container");
  // Checks the slider has more than one slide. If it doesn't, pagination is disabled for that slider.
  if ( $(this).find(".swiper-slide").length > 1 ) {
    options = {
      loop: false,
      slidesPerView: 4,
        navigation: {
          nextEl: $(this).find(".swiper-button-next"),
          prevEl: $(this).find(".swiper-button-prev"),
        },
      breakpoints: {
        1024: {
          slidesPerView: 1
        },
        1300: {
          slidesPerView: 2
        }
      }
    }
  } else {
    options = {
      loop: false,
      slidesPerView: 4,
      breakpoints: {
        1024: {
          slidesPerView: 1
        },
        1300: {
          slidesPerView: 2
        }
      }
    }
    $(this).find(".swiper-button-next").remove();
    $(this).find(".swiper-button-prev").remove();
  }
  const swiper = new Swiper(thisSwiper, options);
});

});
