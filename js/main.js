let naviSlider = null;

let cart = [];
let cartCount = 0;

// jQuery ======================================================================================

$ = jQuery;

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


  // Отправка Заказать звонок
  $('.callbackBtn').click(function (e) {

    e.preventDefault();
    const name = $("#form-callback-name").val();
    const tel = $("#form-callback-tel").val();
    const email = $("#form-callback-email").val();

    if (jQuery("#form-callback-tel").val() == "") {
      jQuery("#form-callback-tel").css("border", "1px solid red");
      return;
    }

    // if (jQuery("#sig-inp-e").val() == ""){
    // 	jQuery("#sig-inp-e").css("border","1px solid red");
    // 	return;
    // }

    else {
      var jqXHR = jQuery.post(
        allAjax.ajaxurl,
        {
          action: 'sendphone',
          nonce: allAjax.nonce,
          name: name,
          tel: tel,
          email: email,
        }
      );

      jqXHR.done(function (responce) {
        jQuery(".headen_form_blk").hide();
        jQuery('.SendetMsg').show();
      });

      jqXHR.fail(function (responce) {
        alert("Произошла ошибка. Попробуйте позднее.");
      });

    }
  });


});


  // Отправка Проект на расчет ===============================
// jQuery('.projectBtn').click(function(e){ 

//   e.preventDefault();
//   var name = $("#form-project-name").val();
//   var tel = $("#form-project-tel").val();
//   var files = $("#input__file").val(); 
//   var file_path = $("#file-path-serv").val(); 
//   console.log(file_path);
//   // var file_path = $(this).siblings('.file-path').val();

//   if (jQuery("#form-name").val() == "") {
//     jQuery("#form-name").css("border","1px solid red");
//     return;
//   }

//   if (jQuery("#form-project-tel").val() == ""){
//     jQuery("#form-project-tel").css("border","1px solid red"); 
//     return;
//   }

//   // if (jQuery("#form-message").val() == ""){
//   //   jQuery("#form-message").css("border","1px solid red");
//   //   return;
//   // }

//   else {
    
//     var  jqXHR = jQuery.post(
//       allAjax.ajaxurl,
//       {
//         action: 'sendproject',        
//         nonce: allAjax.nonce,
//         name: name,
//         tel: tel,
//         // img1:files,
//         file: file_path,
//         picture: jQuery("#file-path").html(),
//       }   
//       );

//         jqXHR.done(function (responce) {
//           jQuery(".headen_form_blk").hide();
//           jQuery('.SendetMsg').show();
//         });

//             jqXHR.fail(function (responce) {
//               alert("Произошла ошибка. Попробуйте позднее."); 
//         }); 

//      }
// });

// // Загрузчик файла ================================
// jQuery('input[type=file]').change(function(){
//       var file_data = jQuery(this).prop('files')[0]; 
//       var form_data = new FormData();
//       var file_span = $(this).parent().siblings('.file-path');
//       form_data.append('file', file_data);
//       form_data.append('action', "main_load_file");
//       form_data.append('nonce', allAjax.nonce);


//       var  jqXHR = jQuery.ajax({      
//           url: allAjax.ajaxurl,
//           dataType: 'text',
//           cache: false,
//           contentType: false,
//           processData: false,
//           data: form_data, 
//           type: 'post'    
//       });

//       jqXHR.done(function (responce) {
//           file_span.val(responce);
//           elems = responce.split('|');
//           console.log(elems[0].split("/").pop());

//       jQuery("#file-path").html(elems[0].split("/").pop());
//       jQuery("#file-path-serv").val(elems[0]);
//       });
              
//       jqXHR.fail(function (responce) {
//           spiner.hide();
//           if (responce.responseText == "0")
//               file_span.html("<span style = 'color:red;'>Большой файл!</span>");
//           else
//               file_span.html(responce.responseText);
//       });
//   });

$('.projectBtn').click(function(e){  

  e.preventDefault();
  var nameM = $("#form-project-name").val(); 
  var telM = $("#form-project-tel").val();  
  let prfile = jQuery('#input__file').prop('files');
  console.log(prfile);
  var designFile = (prfile != undefined)?prfile[0]:"";

  if (jQuery("#form-name").val() == "") {
    jQuery("#form-name").css("border","1px solid red");
    return;
  }

  if (jQuery("#form-project-tel").val() == ""){
    jQuery("#form-project-tel").css("border","1px solid red"); 
    return;
  }


  else {
    var params = new FormData();
            params.append('action', 'sendpay');
            params.append('nonce', allAjax.nonce);
      params.append('nameM', nameM);
      params.append('telM', telM);
      params.append('design', designFile);

      var  jqXHR = jQuery.ajax({      
        url: allAjax.ajaxurl,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: params, 
        type: 'post'    
      });

    // var  jqXHR = jQuery.post(
    //  allAjax.ajaxurl,
    //  params   
    //  );

        jqXHR.done(function (responce) {
          jQuery(".headen_form_blk").hide();
          jQuery('.SendetMsg').show();
        });

            jqXHR.fail(function (response) {
              alert("Произошла ошибка. Попробуйте позднее."); 
        }); 

     }
});
// ==============================================================================================================


// Java Script ==================================================================================================
function number_format() {
  let elements = document.querySelectorAll('.price_formator');
  for (let elem of elements) {
    elem.dataset.realPrice = elem.innerHTML;
    elem.innerHTML = Number(elem.innerHTML).toLocaleString('ru-RU');
  }
}

function cart_recalc() {
  cart = JSON.parse(localStorage.getItem("cart"));
  if (cart == null) cart = [];
  cartCount = 0;
  cartSumm = 0;
  for (let i = 0; i < cart.length; i++) {
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
  pictureUrl = (pictureUrl != undefined) ? pictureUrl.src : nophoto_page;
  let cartElem = {
    sku: product_current_sku.innerHTML,
    lnk: window.location.href,
    modtext: mod_product_selector.options[mod_product_selector.selectedIndex].innerHTML,
    price: product_current_price.dataset.realPrice,
    subtotal: product_current_price.dataset.realPrice,
    name: tovar_title.innerHTML,
    count: 1,
    picture: pictureUrl
  };

  if (cart.length == 0) {
    cart.push(cartElem);
  } else {
    let addet = true;
    for (let i = 0; i < cart.length; i++) {
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

  localStorage.setItem("cart", JSON.stringify(cart));
  to_bascet_msg.style.display = "block";
  cart_recalc();

  console.log(cartElem);
}

document.addEventListener("DOMContentLoaded", () => {

  //работа с корзиной
  cart = JSON.parse(localStorage.getItem("cart"));
  if (cart == null) cart = [];

  cart_recalc();

  number_format();


  // Селекторы на мобильной версии =============================================================

  let subcatSelector = document.getElementById('mobile_type_selector');

  if (subcatSelector != undefined)
    subcatSelector.onchange = function (e) {
      console.log(this.options[this.selectedIndex].value);
      window.location.href = this.options[this.selectedIndex].value;
    }

  let designSelector = document.getElementById('mobile_style_selector');

  if (designSelector != undefined)
    designSelector.onchange = function (e) {
      window.location.href = this.options[this.selectedIndex].value;
    }


  let modSelector = document.getElementById('mod_product_selector');

  if (modSelector != undefined)
    modSelector.onchange = function (e) {
      product_current_price.innerHTML = this.options[this.selectedIndex].dataset.price;
      product_current_sku.innerHTML = this.options[this.selectedIndex].dataset.sku;


      if (naviSlider != undefined) {
        if (document.getElementById(this.options[this.selectedIndex].dataset.pictureid) != null)
          naviSlider.slick('slickGoTo', document.getElementById(this.options[this.selectedIndex].dataset.pictureid).dataset.indexelem);
      }

      number_format();
    }

  let addToCart = document.getElementById('add_to_cart');

  if (addToCart != undefined)
    addToCart.onclick = function (e) {
      add_tocart();
    }

  let openMenu = document.getElementById('hamburger');

  if (openMenu != undefined)
    openMenu.onclick = function (e) {
      block_menu.classList.add("block-menu-open");
    }

  let closeMenu = document.getElementById('close_menu');

  if (closeMenu != undefined)
    closeMenu.onclick = function (e) {
      block_menu.classList.remove("block-menu-open");
    }

  let optSendBtn = document.getElementById('opt_send_btn');
  let otzSendBtn = document.getElementById('otz_send_btn');

  //Маска для телефона
  let mascedPhoneElem = document.getElementById('id_phone');
  if (mascedPhoneElem != undefined)
    var phoneMask = IMask(mascedPhoneElem, {
      mask: '+{7}(000)000-00-00',
      lazy: true,  // make placeholder always visible
      placeholderChar: '_'     // defaults to '_'
    });


  // Отправка формы =============================================================================================
  if (otzSendBtn != undefined)
    otzSendBtn.onclick = function (e) {
      let name = document.querySelector('.rev-form__form input[name="otz_fio"]').value;
      let tovID = document.querySelector('.rev-form__form input[name="otz_tovid"]').value;
      let tovName = document.querySelector('.rev-form__form input[name="otz_tovname"]').value;
      let mail = document.querySelector('.rev-form__form input[name="otz_email"]').value;
      let reiting = document.querySelector('.rev-form__form input[name="reiting"]').value;
      let comment = document.querySelector('.rev-form__form textarea[name="otz_comment"]').value;

      document.getElementById("otz_no_feild").style.display = 'none';

      console.log(reiting);
      console.log(name);
      console.log(mail);
      console.log(tovID);

      if ((reiting == "") || (name == "") || (mail == "") || (comment == "")) {
        document.getElementById("otz_no_feild").style.display = 'block';
        return;
      }

      var params = new URLSearchParams();
      params.append('action', 'send_otz');
      params.append('nonce', allAjax.nonce);
      params.append('name', name);
      params.append('mail', mail);
      params.append('tovname', tovName);
      params.append('tovid', tovID);
      params.append('comment', comment);
      params.append('reiting', reiting);

      axios.post(allAjax.ajaxurl, params)
        .then(function (response) {
          window.location.href = thencs_page;
        })
        .catch(function (error) {
          alert(error);
        });

    }


  if (optSendBtn != undefined)
    optSendBtn.onclick = function (e) {
      let who = document.querySelector('.opt-form__form input[name="who"]:checked').value;
      let name = document.querySelector('.opt-form__form input[name="fio"]').value;
      let mail = document.querySelector('.opt-form__form input[name="email"]').value;
      let phone = document.querySelector('.opt-form__form input[name="phone"]').value;
      let comment = document.querySelector('.opt-form__form textarea[name="comment"]').value;

      document.getElementById("opt_no_feild").style.display = 'none';
      if ((who == "") || (name == "") || (mail == "") || (phone == "")) {
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

  let subTypeSelect = document.getElementById('id_sub_type');
  let typeSelect = document.getElementById('id_prod_type');

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
// ========================================================================================================


//BodyLock для Popup на JS
function body_lock(delay) {
  let body = document.querySelector("body");
  if (body.classList.contains('lock')) {
    body_lock_remove(delay);
  } else {
    body_lock_add(delay);
  }
}
function body_lock_remove(delay) {
  let body = document.querySelector("body");
  if (unlock) {
    let lock_padding = document.querySelectorAll("._lp");
    setTimeout(() => {
      for (let index = 0; index < lock_padding.length; index++) {
        const el = lock_padding[index];
        el.style.paddingRight = '0px';
      }
      body.style.paddingRight = '0px';
      body.classList.remove("lock");
    }, delay);

    unlock = false;
    setTimeout(function () {
      unlock = true;
    }, delay);
  }
}
function body_lock_add(delay) {
  let body = document.querySelector("body");
  if (unlock) {
    let lock_padding = document.querySelectorAll("._lp");
    for (let index = 0; index < lock_padding.length; index++) {
      const el = lock_padding[index];
      el.style.paddingRight = window.innerWidth - document.querySelector('.body').offsetWidth + 'px';
    }
    body.style.paddingRight = window.innerWidth - document.querySelector('.body').offsetWidth + 'px';
    body.classList.add("lock");

    unlock = false;
    setTimeout(function () {
      unlock = true;
    }, delay);
  }
}


// Popup JS
let unlock = true;
let popup_link = document.querySelectorAll('._popup-link');
let popups = document.querySelectorAll('.popup');
for (let index = 0; index < popup_link.length; index++) {
  const el = popup_link[index];
  el.addEventListener('click', function (e) {
    if (unlock) {
      let item = el.getAttribute('href').replace('#', '');
      let video = el.getAttribute('data-video');
      popup_open(item, video);
    }
    e.preventDefault();
  })
}
for (let index = 0; index < popups.length; index++) {
  const popup = popups[index];
  popup.addEventListener("click", function (e) {
    if (!e.target.closest('.popup__body')) {
      popup_close(e.target.closest('.popup'));
    }
  });
}
function popup_open(item, video = '') {
  let activePopup = document.querySelectorAll('.popup._active');
  if (activePopup.length > 0) {
    popup_close('', false);
  }
  let curent_popup = document.querySelector('.popup_' + item);
  if (curent_popup && unlock) {
    if (video != '' && video != null) {
      let popup_video = document.querySelector('.popup_video');
      popup_video.querySelector('.popup__video').innerHTML = '<iframe src="https://www.youtube.com/embed/' + video + '?autoplay=1"  allow="autoplay; encrypted-media" allowfullscreen></iframe>';
    }
    if (!document.querySelector('.menu__body._active')) {
      body_lock_add(500);
    }
    curent_popup.classList.add('_active');
    history.pushState('', '', '#' + item);
  }
}
function popup_close(item, bodyUnlock = true) {
  if (unlock) {
    if (!item) {
      for (let index = 0; index < popups.length; index++) {
        const popup = popups[index];
        let video = popup.querySelector('.popup__video');
        if (video) {
          video.innerHTML = '';
        }
        popup.classList.remove('_active');
      }
    } else {
      let video = item.querySelector('.popup__video');
      if (video) {
        video.innerHTML = '';
      }
      item.classList.remove('_active');
    }
    if (!document.querySelector('.menu__body._active') && bodyUnlock) {
      body_lock_remove(500);
    }
    history.pushState('', '', window.location.href.split('#')[0]);
  }
}
let popup_close_icon = document.querySelectorAll('.popup__close,._popup-close');
if (popup_close_icon) {
  for (let index = 0; index < popup_close_icon.length; index++) {
    const el = popup_close_icon[index];
    el.addEventListener('click', function () {
      popup_close(el.closest('.popup'));
    })
  }
}
document.addEventListener('keydown', function (e) {
  if (e.code === 'Escape') {
    popup_close();
  }
});


