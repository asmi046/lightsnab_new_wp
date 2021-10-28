<section class="about">
  <div class="container">
    <div class="about__wrap-flex">
      <div class="about-title">
        <h1><span class="color-light">LIGHTSNAB.RU</span> — у нас есть люстры <br/>на любой вкус и кошелек!</h1>
      </div>
      <div class="about-text">
      <?
				echo apply_filters( 'the_content', carbon_get_theme_option( "main_fulltext_top" ) );
			?>  
      <!-- <p>Мы рады видеть Вас в нашем магазине дизайнерского света LIGHTSNAB.RU! </p> 
        <p>У нас в каталоге более 5000 наименований люстр, светильников, бра, настольных ламп и аксесуаров. Наша команда постоянно работает над пополнением каталога, мы выбираем только самые лучшие позиции для Вас от лучших поставщиков со всего мира. </p>
        <p> Мы внимательно следим за качеством продукции которую предлагаем нашим покупателям. Все товары имеют сертификат технической и экологической безопасности.</p>
        <p> Ваше удобство это наша основная цель! Мы делаем все чтобы Вы получили свой заказ в миниимальные сроки где бы Вы не находились. Наша служба контроля качества проверяет каждую позицию перед проверкой и при необходимости перепаковывает для обеспечения безопасности при пересылке.</p>
        <p> Все наши менеджеры имеют за плечами большой опыт в подборе дизайнерского освещения, если у Вас возникли вопросы свяжитесь с нами любым удобным способом и мы поможем!</p>
        <p><span class="color-light">Приятных покупок!</span></p> -->
      </div>
    </div>

    <div class="project-calc">
      <div class="project-calc__img">
        <img src="<?php echo get_template_directory_uri();?>/img/project-calc/01.jpg" alt="Картинка, проект на расчет">
      </div>
      <div class="project-calc__img">
        <img src="<?php echo get_template_directory_uri();?>/img/project-calc/02.jpg" alt="Картинка, проект на расчет">
      </div>
      <div class="project-calc__img">
        <img src="<?php echo get_template_directory_uri();?>/img/project-calc/03.jpg" alt="Картинка, проект на расчет">
      </div>
      <div class="project-calc__text">
        <h3 class="project-calc__title">Есть проект на рассчет?</h3>
        <p class="project-calc__subtitle">Отправьте проект и мы постараемся сделать цену ниже.</p>
        <a href="#callback" class="project-calc__btn _popup-link">Отправить проект…</a>
      </div>
    </div>

  </div> 
</section>