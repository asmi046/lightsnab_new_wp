<footer class="footer">
  <div class="container">
    <div class="footer-block">
      <ul class="ul-clean">
        <li><a href="<? echo get_category_link(11); ?>">Люстры и дизайнерские светильники</a></li>
        <li><a href="<? echo get_category_link(53); ?>">Скандинавские люстры</a></li>
        <li><a href="<? echo get_category_link(16); ?>">Бра и настенное освещение</a></li>
        <li><a href="<? echo get_category_link(17); ?>">Торшеры</a></li>
        <li><a href="<? echo get_category_link(18); ?>">Настольные лампы</a></li>
        <li><a href="<? echo get_category_link(12); ?>">Светильники и подвесной свет</a></li>
      </ul>
    </div>
    <div class="footer-block">
      <ul class="ul-clean">
        <li><a href="<? echo get_the_permalink(447) ?>">Оптовым покупателям</a></li>
        <li><a href="<? echo get_the_permalink(393) ?>">Доставка и оплата </a></li>
        <li><a href="<? echo get_the_permalink(396) ?>">Возврат и обмен товара </a></li>
        <li><a href="<? echo get_the_permalink(452) ?>">Политика конфиденциальности</a></li>
      </ul>
    </div>
    <div class="footer-block footer-block-last">
      <div class="">© Lightsnab.ru, 2014—<? echo date("Y") ?> </div>
      <div class="">Телефон: <? echo SITE_PHONE; ?></div>
      <!-- <div class="">Телефон: <? echo SITE_PHONE_DOP; ?></div> -->
      <div class="">E-mail: <? echo SITE_MAIL; ?></div>
      <div class="soc-block">
        <a class="soc_btn_fb" href="<? echo FB_LNK; ?>"></a>
        <a class="soc_btn_telegram" href="<?php echo carbon_get_theme_option('as_telegr'); ?>"></a>
        
      </div>
      <div class="soc-block soc-block-bottom">
        <a class="soc_btn_twitter" href="<?php echo carbon_get_theme_option('as_twiter'); ?>"></a>
        <a class="soc_btn_ok" href="<?php echo carbon_get_theme_option('as_ok'); ?>"></a>
        <a class="soc_btn_vk" href="<?php echo carbon_get_theme_option('as_vk'); ?>"></a>
      </div>
      <!-- <a class = "workerlnk" href = "https://asmi-studio.ru/">Разработка сайта <span>Asmi-Studio</span></a> -->
    </div>
  </div>
</footer>
<!-- </div> -->

<div class="top-btn"></div>

<?php wp_footer(); ?>

</body>

</html>