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
	  <? $org = carbon_get_theme_option("as_company"); if (!empty($org)){?><li>Организация: <strong><? echo $org; ?></strong></li><?}?>
		<? $adr = carbon_get_theme_option("as_address"); if (!empty($adr)){?><li>Адрес: <strong><? echo $adr; ?></strong></li><?}?>
		<? $inn = carbon_get_theme_option("as_inn"); if (!empty($inn)){?><li>ИНН: <strong><? echo $inn; ?></strong></li><?}?>
		<? $kpp = carbon_get_theme_option("as_kpp"); if (!empty($kpp)){?><li>КПП: <strong><? echo $kpp; ?></strong></li><?}?>
		<? $ogrn = carbon_get_theme_option("as_orgn"); if (!empty($ogrn)){?><li>ОРГН: <strong><? echo $ogrn; ?></strong></li><?}?>
		<? $rs = carbon_get_theme_option("as_rs"); if (!empty($rs)){?><li>Р/С: <strong><? echo $rs; ?></strong></li><?}?>
		<? $ks = carbon_get_theme_option("as_ks"); if (!empty($ks)){?><li>К/С: <strong><? echo $ks; ?></strong></li><?}?>
		<? $bik = carbon_get_theme_option("as_bik"); if (!empty($bik)){?><li>БИК: <strong><? echo $bik; ?></strong></li><?}?>
		<? $bank = carbon_get_theme_option("as_bank"); if (!empty($bank)){?><li>БАНК: <strong><? echo $bank; ?></strong></li><?}?>
		<? $mail = carbon_get_theme_option("as_email"); if (!empty($mail)){?><li>Email: <strong><a href="mailto:<? echo $mail; ?>"><? echo $mail; ?></strong></a></li><?}?>
		<? $tel = carbon_get_theme_option("as_phones_1"); $tel2 = carbon_get_theme_option("as_phone_2"); if (!empty($tel)){?><li>Тел: <strong><a href="tel:<? echo preg_replace('/[^0-9]/', '', $tel); ?>"><? echo $tel; ?></strong></a> <a href="tel:<? echo preg_replace('/[^0-9]/', '', $tel2); ?>"><? echo $tel2; ?></strong></a></li><?}?> 
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
