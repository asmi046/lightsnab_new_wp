
	<footer class="footer">
    <div class="container">
      <div class="footer-block">
        <ul class="ul-clean">
          <li><a href="<?echo get_category_link(11); ?>">Люстры и дизайнерские светильники</a></li>
          <li><a href="<?echo get_category_link(13); ?>">Люстры для низких потолков</a></li>
          <li><a href="<?echo get_category_link(16); ?>">Бра и настенное освещение</a></li>
          <li><a href="<?echo get_category_link(17); ?>">Торшеры</a></li>
          <li><a href="<?echo get_category_link(19); ?>">Точечный свет</a></li>
          <li><a href="<?echo get_category_link(20); ?>">Детский свет</a></li>
        </ul>
      </div>
      <div class="footer-block">
        <ul class="ul-clean">
          <li><a href="<?echo get_the_permalink(436)?>">Оптовым покупателям</a></li>
          <li><a href="<?echo get_the_permalink(393)?>">Доставка и оплата </a></li>
          <li><a href="<?echo get_the_permalink(396)?>">Возврат и обмен товара </a></li>
          <li><a href="<?echo get_the_permalink(438)?>">Договор оферты </a></li>
          <li><a href="<?echo get_the_permalink(3)?>">Пользовательское соглашение </a></li>
          <li><a href="<?echo get_the_permalink(440)?>">Условия использования Сайта</a></li>
        </ul>
      </div>
      <div class="footer-block footer-block-last">
        <div class="">© Lightsnab.ru, 2014—<?echo date("Y")?> </div>
        <div class="">Телефон: <?echo SITE_PHONE;?></div>
        <div class="">E-mail: <?echo SITE_MAIL;?></div>
        <div class="soc-block">
          <a class = "soc_btn_insta" href="#"></a>
          <a class = "soc_btn_fb" href="#" ></a>
        </div>
      </div>
    </div>
	</footer>
<!-- </div> -->

  <div class="top-btn"></div>

  <?php wp_footer(); ?>

</body>

</html>
