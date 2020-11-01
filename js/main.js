let naviSlider = null;

let cart = [];
let cartCount = 0;

jQuery(document).ready(function ($) {
  function top_btn() {
    var button = $('.top-btn');
    $(window).scroll(function () {
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

naviSlider = $('.slider-nav').slick({
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


function number_format () {
  let elements = document.querySelectorAll('.price_formator');
  for (let elem of elements) {
    elem.dataset.realPrice = elem.innerHTML; 
    elem.innerHTML = Number(elem.innerHTML).toLocaleString('ru-RU');
  }
}

function cart_recalc () {
  cart = JSON.parse(localStorage.getItem("cart"));
  if (cart == null) cart = [];
  cartCount = 0;
  cartSumm = 0;
  for (let i = 0; i<cart.length; i++){
    cartCount += Number(cart[i].count);

    cartSumm += Number(cart[i].count) * parseFloat(cart[i].price);
  }

  localStorage.setItem("cartcount", cartCount);
  localStorage.setItem("cartsumm", cartSumm);

  let elements = document.querySelectorAll('.cart_count_input');
  for (let elem of elements) {
    elem.innerHTML = cartCount;
  }

}

function add_tocart() {
    let pictureUrl = document.getElementById(mod_product_selector.options[mod_product_selector.selectedIndex].dataset.pictureid);
    pictureUrl = (pictureUrl != undefined)?pictureUrl.src:nophoto_page;
    let cartElem = {
      sku: product_current_sku.innerHTML,
      lnk:window.location.href,
      price: product_current_price.dataset.realPrice,
      subtotal:product_current_price.dataset.realPrice,
      name: tovar_title.innerHTML,
      count: 1,
      picture: pictureUrl 
    };

    if (cart.length == 0)
    {
      cart.push(cartElem);
    } else {
      let addet = true;
      for (let i = 0; i<cart.length; i++){
        if (cart[i].sku == cartElem.sku) {
          cart[i].count++;
          cart[i].subtotal = Number(cart[i].count) * parseFloat(cart[i].price);
          addet = false;
          break;
        }
      }

      if (addet)
        cart.push(cartElem);
    }
    
    localStorage.setItem("cart", JSON.stringify (cart) );
    to_bascet_msg.style.display = "block";
    cart_recalc ();

    console.log(cartElem);
}

document.addEventListener("DOMContentLoaded", ()=>{

  cart = JSON.parse(localStorage.getItem("cart"));
  if (cart == null) cart = [];
  
  cart_recalc ();

  number_format ();

  let modSelector =  document.getElementById('mod_product_selector');
  
  if (modSelector != undefined)
  modSelector.onchange = function (e) {
    product_current_price.innerHTML = this.options[this.selectedIndex].dataset.price;
    product_current_sku.innerHTML = this.options[this.selectedIndex].dataset.sku;
    

    if (naviSlider != undefined) {
      naviSlider.slick('slickGoTo',document.getElementById(this.options[this.selectedIndex].dataset.pictureid).dataset.indexelem);
    }

    number_format ();
  }

  let addToCart =  document.getElementById('add_to_cart');

  if (addToCart != undefined) 
    addToCart.onclick = function (e) {
      add_tocart();
    }

  let openMenu =  document.getElementById('hamburger');

  if (openMenu != undefined) 
    openMenu.onclick = function (e) {
      block_menu.classList.add("block-menu-open");
    } 

  let closeMenu =  document.getElementById('close_menu');

  if (closeMenu != undefined) 
    closeMenu.onclick = function (e) {
        block_menu.classList.remove("block-menu-open");
    }

});

