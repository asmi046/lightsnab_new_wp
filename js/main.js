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
  arrows: false,
  responsive: [
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
      }
  },
    {
      breakpoint: 320,
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
      modtext:mod_product_selector.options[mod_product_selector.selectedIndex].innerHTML,
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
      if (document.getElementById(this.options[this.selectedIndex].dataset.pictureid) != null)
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

  let optSendBtn =  document.getElementById('opt_send_btn');

  //Маска для телефона
  var phoneMask = IMask(document.getElementById('id_phone'), {
    mask: '+{7}(000)000-00-00',
    lazy: true,  // make placeholder always visible
    placeholderChar: '_'     // defaults to '_'
  });
  
  //______________Отправка формы



  if (optSendBtn != undefined) 
  optSendBtn.onclick = function (e) {
    let who = document.querySelector('.opt-form__form input[name="who"]:checked').value;
    let name = document.querySelector('.opt-form__form input[name="fio"]').value;
    let mail = document.querySelector('.opt-form__form input[name="email"]').value;
    let phone = document.querySelector('.opt-form__form input[name="phone"]').value;
    let comment = document.querySelector('.opt-form__form textarea[name="comment"]').value;
     
    document.getElementById("opt_no_feild").style.display = 'none';
    if ((who == "")||(name == "")||(mail == "")||(phone == "")) 
    {
        document.getElementById("opt_no_feild").style.display = 'block';
        return;
    }
    
    var params = new URLSearchParams();
    params.append('action', 'send_opt');
    params.append('nonce', allAjax.nonce);
    params.append('name', name);
    params.append('mail', mail);
    params.append('phone', phone);
    params.append('comment', comment);
    params.append('who', who);


    axios.post(allAjax.ajaxurl, params)
      .then(function (response) {
        window.location.href = thencs_page;
      })
      .catch(function (error) {
        alert(error);
      });

  }
  
    let subTypeSelect =  document.getElementById('id_sub_type');
    let typeSelect =  document.getElementById('id_prod_type');

    if (typeSelect != null) {
      typeSelect.onchange = function (e) { 
        var params = new URLSearchParams();
        params.append('action', 'get_subcat');
        params.append('nonce', allAjax.nonce);
        params.append('catid', typeSelect.value);
        

        axios.post(allAjax.ajaxurl, params)
          .then(function (response) {
            console.log(response);
            subTypeSelect.innerHTML = response.data;
          })
          .catch(function (error) {
            alert(error);
          });
      }
    }

});

