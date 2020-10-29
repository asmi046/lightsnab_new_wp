document.addEventListener("DOMContentLoaded", ()=>{
  let elements = document.querySelectorAll('.price_formator');
  for (let elem of elements) {
    elem.dataset.realPrice = elem.innerHTML; 
    elem.innerHTML = Number(elem.innerHTML).toLocaleString('ru-RU');
  }
});

jQuery(document).ready(function ($) {
  function top_btn() {
    var button = $('.top-btn');
    var height_page = $(document).outerHeight(true);
    var delay = 1000;
    $(window).scroll(function () {
      if ($(this).scrollTop() > (height_page / 2)) {
        button.fadeIn();
      } else {
        button.fadeOut();
      }
    });
    button.click(function () {
      $('body, html').animate({
        scrollTop: 0
      }, delay);
    });
  }   
  top_btn();
  $('.hamburger').click(function (e) {
    $('.block-menu').show();
  });
  $('.close-menu').click(function () {
    $('.block-menu').hide();

  });
  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    prevArrow: '<div class="slider-arrow slider-arrow-prev"></div>',
    nextArrow: '<div class="slider-arrow slider-arrow-next"></div>',
    asNavFor: '.slider-nav'
  });
  $('.slider-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    centerPadding: '10px',
    dots: true,
    centerMode: true,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
        }
    },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
    }
  ]
  });
});
