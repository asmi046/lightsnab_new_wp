function number_format () {
  let elements = document.querySelectorAll('.price_formator');
  for (let elem of elements) {
    elem.dataset.realPrice = elem.innerHTML; 
    elem.innerHTML = Number(elem.innerHTML).toLocaleString('ru-RU');
  }
}
document.addEventListener("DOMContentLoaded", ()=>{
  number_format ();

  let modSelector =  document.getElementById('mod_product_selector');
  modSelector.onchange = function (e) {
    product_current_price.innerHTML = this.options[this.selectedIndex].dataset.price;
    product_current_sku.innerHTML = this.options[this.selectedIndex].dataset.sku;
    number_format ();
  }
});

jQuery(document).ready(function ($) {
  function top_btn() {
    var button = $('.top-btn');
    $(window).scroll(function () {
     console.log($(this).scrollTop() );
      if ($(this).scrollTop() > 300) {
        button.fadeIn();
      } else {
        button.fadeOut();
      }
    });
    button.click(function () {
      $('body, html').animate({
        scrollTop: 0
      }, 1000);
    });
  } 

  top_btn();
  
  $('.hamburger').click(function (e) {
    $('.block-menu').fadeIn();
  });
  $('.close-menu').click(function () {
    $('.block-menu').fadeOut();

  });
  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    infinite: true,
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
    infinite: true,
    centerMode: false,
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
