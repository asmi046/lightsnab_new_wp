<?php 

/*
Template Name: Страница Контакты
Template Post Type: page
*/

get_header(); ?>

<?php get_template_part('template-parts/block-menu');?>
<?php get_template_part('template-parts/header-category');?>

  <section class="contacts content">
  <div class="container">

  <?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );  
			}
			?> 

	<h1><? the_title();?></h1> 

		<ul>
      <li>Организация: <? echo carbon_get_theme_option("as_company"); ?></li>
			<li>Адрес: <? echo carbon_get_theme_option("as_address"); ?></li>
			<li>ИНН: <? echo carbon_get_theme_option("as_inn"); ?></li>
			<li>КПП: <? echo carbon_get_theme_option("as_kpp"); ?></li>
			<li>ОРГН: <? echo carbon_get_theme_option("as_orgn"); ?></li>
			<li>Р/С: <? echo carbon_get_theme_option("as_rs"); ?></li>
			<li>К/С: <? echo carbon_get_theme_option("as_ks"); ?></li>
      <li>БИК: <? echo carbon_get_theme_option("as_bik"); ?></li>
			<li>Email: <a href="mailto:<? echo $mail = carbon_get_theme_option("as_email"); ?>"><? echo $mail; ?></a></li>
			<li>Тел: <a href="tel:<? echo preg_replace('/[^0-9]/', '', $tel); ?>"><? echo $tel = carbon_get_theme_option("as_phones_1"); ?></a></li>
			<li>Тел.доп: <a href="tel:<? echo preg_replace('/[^0-9]/', '', $tel); ?>"><? echo $tel = carbon_get_theme_option("as_phone_2"); ?></a></li>
		</ul>

		<div class="block__map" id="map"></div>
		<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script> 

		<script>
			ymaps.ready(init); 

			function init () {
				var myMap = new ymaps.Map("map", {
        // Координаты центра карты
        center:[<?php echo carbon_get_theme_option('map_point') ?>],
        // Масштаб карты
        zoom: 17,
        // Выключаем все управление картой
        controls: []
      }); 

				var myGeoObjects = [];

    // Указываем координаты метки
    myGeoObjects = new ymaps.Placemark([<?php echo carbon_get_theme_option('map_point') ?>],{
    								// hintContent: '<div class="map-hint">Авто профи, Курск, ул.Комарова, 16</div>',
    								balloonContent: '<div class="map-hint"><?php echo carbon_get_theme_option('text_map') ?>', },{
    								iconLayout: 'default#image',
                    // Путь до нашей картинки
                    iconImageHref:  '<?php bloginfo("template_url"); ?>/img/icons/map-marker.svg',  
                    // Размеры иконки
                    iconImageSize: [65, 65],
                    // Смещение верхнего угла относительно основания иконки
                    iconImageOffset: [-25, -100]
                  });

    var clusterer = new ymaps.Clusterer({
    	clusterDisableClickZoom: false,
    	clusterOpenBalloonOnClick: false,
    });
    
    clusterer.add(myGeoObjects);
    myMap.geoObjects.add(clusterer);
    // Отключим zoom
    myMap.behaviors.disable('scrollZoom');

  }
</script>

</div>
</section>

<?php get_footer(); 
