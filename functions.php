<?php

// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

define("SITE_PHONE", "+7 (994) 444 44 83");
define("SITE_PHONE_DOP", "+7 (994) 444 48 44");
define("SITE_MAIL", "sale@lightsnab.ru");

define("INSTA_LNK", "https://instagram.com/light_snab?igshid=3qjj6waf8lj4");
define("FB_LNK", "https://vm.tiktok.com/ZSTc25a5/");

define("COMPANY_NAME", "Магазин LightSnab");
define("MAIL_RESEND", "noreply@light-snab.ru");

add_image_size( "togalery", 900, 900, true );
add_image_size( "tominiatyre", 300, 300, true ); 


//----Подключене carbon fields
//----Инструкции по подключению полей см. в комментариях themes-fields.php
include "carbon-fields/carbon-fields-plugin.php";

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' ); 
function crb_attach_theme_options() {
	require_once __DIR__ . "/themes-fields.php";
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
	require_once( 'carbon-fields/vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
} 

//-----Блок описания вывода меню
// 1. Осмысленные названия для алиаса и для описания на русском.
// если это меню в подвали пишем - Меню в подвале 
// если в шапке то пишем - Меню в шапке 
// если 2 меню в шапке пишем  - Меню в шапке (верхняя часть)

add_action( 'after_setup_theme', function(){
	register_nav_menus( [
		'menu-1' => 'Меню Товары',
		'menu-2' => 'Меню Сотрудничество',
		'menu-3' => 'Меню Доставка',
	] );
} ); 

// register_nav_menus( array(
// 	'header_menu' => 'Главное меню'
// ) );

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 185, 185 ); 

add_post_type_support( 'page', 'excerpt' );

// Подключение стилей и nonce для Ajax в админку 
add_action('admin_head', 'my_assets_admin');
function my_assets_admin(){
	wp_enqueue_style("style-adm",get_template_directory_uri()."/style-admin.css");
	
	wp_localize_script( 'jquery', 'allAjax', array(
			'nonce'   => wp_create_nonce( 'NEHERTUTLAZIT' )
		) );
}


define("ALL_VERSION", "1.0.38");

// Подключение стилей и nonce для Ajax и скриптов во фронтенд 
add_action( 'wp_enqueue_scripts', 'my_assets' );
	function my_assets() {

		// Подключение стилей 

		wp_enqueue_style("main-style", get_stylesheet_uri(), array(), ALL_VERSION, 'all' ); // Подключение основных стилей в самом конце

		// Подключение скриптов
		
		wp_enqueue_script( 'jquery');

		wp_enqueue_script( 'mask', get_template_directory_uri().'/js/jquery.inputmask.bundle.js', array(), ALL_VERSION , true); //маска для инпутов
		wp_enqueue_script( 'slick', get_template_directory_uri().'/js/slick.min.js', array(), ALL_VERSION , true); //Слайдер
		
		wp_enqueue_script( 'main', get_template_directory_uri().'/js/main.js', array(), ALL_VERSION , true); // Подключение основного скрипта в самом конце
		
		if ( is_page(447))
		{
			wp_enqueue_script( 'imasc', get_template_directory_uri().'/js/imask.js', array(), ALL_VERSION , true);
			wp_enqueue_script( 'axios', get_template_directory_uri().'/js/axios.min.js', array(), ALL_VERSION , true);
		}
		
		if ( is_page(79))
			{
				wp_enqueue_script( 'vue', get_template_directory_uri().'/js/vue.js', array(), ALL_VERSION , true);
				wp_enqueue_script( 'axios', get_template_directory_uri().'/js/axios.min.js', array(), ALL_VERSION , true);
				wp_enqueue_script( 'bascet', get_template_directory_uri().'/js/bascet.js', array(), ALL_VERSION , true);
			}

		if ( is_page(399) || is_single())
		{
			wp_enqueue_script( 'axios', get_template_directory_uri().'/js/axios.min.js', array(), ALL_VERSION , true);
		}

		wp_localize_script( 'main', 'allAjax', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'NEHERTUTLAZIT' )
		) );
	}

	// Заготовка для вызова ajax
	
	add_action( 'wp_ajax_send_cart', 'send_cart' );
	add_action( 'wp_ajax_nopriv_send_cart', 'send_cart' );

	function send_cart() {
		if ( empty( $_REQUEST['nonce'] ) ) {
			wp_die( '0' );
		}
		
		if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {

			$headers = array(
				'From: Сайт '.COMPANY_NAME.' <'.MAIL_RESEND.'>',
				'content-type: text/html',
			);
		
			add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
			
			$adr_to_send = carbon_get_theme_option("mail_to_send");
			$adr_to_send = (empty($adr_to_send))?"asmi046@gmail.com":$adr_to_send;
			
			$zak_number = "LS-".date("H").date("s").date("s")."-".rand(100,999);

			$mail_content = "<h1>Заказ на сате №".$zak_number."</h1>";
			
			$bscet_dec = json_decode(stripcslashes ($_REQUEST["bascet"]));
			
			$mail_content .= "<table style = 'text-align: left;' width = '100%'>";
				$mail_content .= "<tr>";
					$mail_content .= "<th></th>";
					$mail_content .= "<th>ТОВАР</th>";
					$mail_content .= "<th>КОЛЛИЧЕСТВО</th>";
					$mail_content .= "<th>СУММА</th>";
				$mail_content .= "</tr>";

				for ($i = 0; $i<count($bscet_dec); $i++) {
					$mail_content .= "<tr>";
						$mail_content .= "<td><img src = '".$bscet_dec[$i]->picture."' width = '70' height = '70'></td>";
						$mail_content .= "<td><a href = '".$bscet_dec[$i]->lnk."'>".$bscet_dec[$i]->name." / ".$bscet_dec[$i]->sku."</a></td>";
						$mail_content .= "<td>".$bscet_dec[$i]->count."</td>";
						$mail_content .= "<td>".$bscet_dec[$i]->subtotal." р.</td>";
					$mail_content .= "</tr>";
				}

			$mail_content .= "</table>";
			$mail_content .= "<h2>Сумма: ".$_REQUEST["bascetsumm"]." р.</h2>";

			
			$mail_content .= "<strong>Имя:</strong> ".$_REQUEST["name"]."<br/>";
			$mail_content .= "<strong>Телефон:</strong> ".$_REQUEST["phone"]."<br/>";
			$mail_content .= "<strong>e-mail:</strong> ".$_REQUEST["mail"]."<br/>";
			$mail_content .= "<strong>Адрес:</strong> ".$_REQUEST["adres"]."<br/>";
			$mail_content .= "<strong>Комментарий:</strong> ".$_REQUEST["comment"]."<br/>";

			$mail_them = "Заказ на сайте Light-Snab.ru";

			
			if (wp_mail($adr_to_send, $mail_them, $mail_content, $headers)) {
				wp_die(json_encode(array("send" => true )));
			}
			else {
				wp_die( 'Ошибка отправки!', '', 403 );
			}
			
		} else {
			wp_die( 'НО-НО-НО!', '', 403 );
		}
	}


// Отправка формы из модального окна
add_action( 'wp_ajax_sendphone', 'sendphone' );
add_action( 'wp_ajax_nopriv_sendphone', 'sendphone' );

  function sendphone() {
    if ( empty( $_REQUEST['nonce'] ) ) {
      wp_die( '0' );
    }
    
    if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {
      
      $headers = array(
        'From: Сайт '.COMPANY_NAME.' <'.MAIL_RESEND.'>', 
        'content-type: text/html',
      );
    
      add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
       if (wp_mail(carbon_get_theme_option( 'mail_to_send' ), 'Заявка на обратный звонок', '<strong>Имя:</strong> '.$_REQUEST["name"]. ' <br/> <strong>Телефон:</strong> '.$_REQUEST["tel"]. ' <br/> <strong>Email:</strong> '.$_REQUEST["email"], $headers))
        wp_die("<span style = 'color:green;'>Мы свяжемся с Вами в ближайшее время.</span>");
      else wp_die("<span style = 'color:red;'>Сервис недоступен попробуйте позднее.</span>"); 
      
    } else {
      wp_die( 'НО-НО-НО!', '', 403 ); 
    }
  }


	// Заявка на опт
	
	add_action( 'wp_ajax_send_opt', 'send_opt' );
	add_action( 'wp_ajax_nopriv_send_opt', 'send_opt' );

	function send_opt() {
		if ( empty( $_REQUEST['nonce'] ) ) {
			wp_die( '0' );
		}
		
		if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {

			$headers = array(
				'From: Сайт '.COMPANY_NAME.' <'.MAIL_RESEND.'>',
				'content-type: text/html',
			);
		
			add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
			
			$adr_to_send = carbon_get_theme_option("mail_to_send");
			$adr_to_send = (empty($adr_to_send))?"asmi046@gmail.com":$adr_to_send;
			
			$mail_content = "<h1>Заявка на оптовое сторудничество Lightsnab</h1>";
			$mail_content .=  "<strong>Профессия: </strong>".$_REQUEST["who"]."<br/>";
			$mail_content .=  "<strong>Имя: </strong>".$_REQUEST["name"]."<br/>";
			$mail_content .=  "<strong>e-mail: </strong>".$_REQUEST["mail"]."<br/>";
			$mail_content .=  "<strong>Телефон: </strong>".$_REQUEST["phone"]."<br/>";
			$mail_content .=  "<strong>Комментарий: </strong>".$_REQUEST["comment"]."<br/>";

			if (wp_mail($adr_to_send, "Оптовое сторудничество Lightsnab", $mail_content, $headers)) {
				wp_die(json_encode(array("send" => true )));
			}
			else {
				wp_die( 'Ошибка отправки!', '', 403 );
			}
			
		} else {
			wp_die( 'НО-НО-НО!', '', 403 );
		}
	}
	

	// Отзыв о продукте
	
	add_action( 'wp_ajax_send_otz', 'send_otz' );
	add_action( 'wp_ajax_nopriv_send_otz', 'send_otz' );

	function send_otz() {
		if ( empty( $_REQUEST['nonce'] ) ) {
			wp_die( '0' );
		}
		
		if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {

			$headers = array(
				'From: Сайт '.COMPANY_NAME.' <'.MAIL_RESEND.'>',
				'content-type: text/html',
			);
		
			add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
			
			$adr_to_send = carbon_get_theme_option("mail_to_send");
			$adr_to_send = (empty($adr_to_send))?"asmi046@gmail.com":$adr_to_send;
			
			$mail_content = "<h1>Отзыв на товар - ".$_REQUEST["tovname"]." - с сайта  Lightsnab</h1>";
			$mail_content .=  "<strong>Наименование товара: </strong>".$_REQUEST["tovname"]."<br/>";
			$mail_content .=  "<strong>Имя: </strong>".$_REQUEST["name"]."<br/>";
			$mail_content .=  "<strong>e-mail: </strong>".$_REQUEST["mail"]."<br/>";
			$mail_content .=  "<strong>Ваша оценка: </strong>".$_REQUEST["reiting"]."<br/>";
			$mail_content .=  "<strong>Комментарий: </strong>".$_REQUEST["comment"]."<br/>";

			if (wp_mail($adr_to_send, "Отзыв на товар - ".$_REQUEST["tovname"]." - c сайта Lightsnab", $mail_content, $headers)) {
				
				if (carbon_get_theme_option("load_rew"))
				{
					$allRev = carbon_get_post_meta($_REQUEST["tovid"], "offer_rev");

					add_post_meta($_REQUEST["tovid"], '_offer_rev|rev_name|'.count($allRev).'|0|value', $_REQUEST["name"], true );
					add_post_meta($_REQUEST["tovid"], '_offer_rev|rev_mail|'.count($allRev).'|0|value', $_REQUEST["mail"], true );
					add_post_meta($_REQUEST["tovid"], '_offer_rev|rev_reiting|'.count($allRev).'|0|value', $_REQUEST["reiting"], true );
					add_post_meta($_REQUEST["tovid"], '_offer_rev|rev_date|'.count($allRev).'|0|value', date("Y-m-d"), true );
					add_post_meta($_REQUEST["tovid"], '_offer_rev|rev_text|'.count($allRev).'|0|value', $_REQUEST["comment"], true );
				}
				// carbon_set_post_meta( $_REQUEST["tovid"], 'offer_rev', array(
				// 	array(
				// 		"rev_name" => $_REQUEST["name"],
				// 		"rev_mail" => $_REQUEST["mail"],
				// 		"rev_date" => date("Y-m-d"),
				// 		"rev_reiting" => $_REQUEST["reiting"],
				// 		"rev_text" => $_REQUEST["comment"]
				// 	)
				// ));

				wp_die(json_encode(array("send" => true )));
			}
			else {
				wp_die( 'Ошибка отправки!', '', 403 );
			}
			
		} else {
			wp_die( 'НО-НО-НО!', '', 403 );
		}
	}

	add_action( 'wp_ajax_get_subcat', 'get_subcat' );
	add_action( 'wp_ajax_nopriv_get_subcat', 'get_subcat' );

	function get_subcat() {
		if ( empty( $_REQUEST['nonce'] ) ) {
			wp_die( '0' );
		}
		
		if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {
			global $wpdb;

			$mainCat =  $wpdb->get_results('SELECT `lshop_term_taxonomy`.*,  `lshop_terms`.`name`  FROM `lshop_term_taxonomy` LEFT JOIN `lshop_terms` ON `lshop_terms`.`term_id`=`lshop_term_taxonomy`.`term_id` WHERE `lshop_term_taxonomy`.`parent` = '.$_REQUEST["catid"].' AND `lshop_term_taxonomy`.`taxonomy` = "lightcat" ');

			$rezStr = '<option value = "">- Подтип -</option>';
			foreach ( $mainCat as $catM ) {
				
				$rezStr .= '<option value = "'.$catM->term_id.'">'. $catM->name.'</option>';
				
			}

			
			wp_die( $rezStr. $_REQUEST["catid"] );

		} else {
			wp_die( 'НО-НО-НО!', '', 403 );
		}
	}
	
	// Регистрация кастомного поста

add_action( 'init', 'create_light_taxonomies' );

function create_light_taxonomies(){

	register_taxonomy('lightcat', array('light'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => "Категория товара",
			'singular_name'     => "Категория товара",
			'search_items'      => "Найти категорию товара",
			'all_items'         => __( 'Все категории' ),
			'parent_item'       => __( 'Дочерние категории' ),
			'parent_item_colon' => __( 'Дочерние категории:' ),
			'edit_item'         => __( 'Редактировать категорию' ),
			'update_item'       => __( 'Обновить категорию' ),
			'add_new_item'      => __( 'Добавить новую категорию товара' ),
			'new_item_name'     => __( 'Имя новой категории товара' ),
			'menu_name'         => __( 'Категории товара' ),
		),
		'description' => "Категория товаров для магазина",
		'public' => true,
		'show_ui'       => true,
		'query_var'     => true,
		'show_in_rest'  => true,
		'show_admin_column'     => true,
	));

	register_taxonomy('lightstyle', array('light'), array(
		'hierarchical'  => false,
		'labels'        => array(
			'name'              => "Стиль дизайна",
			'singular_name'     => "Стиль дизайна",
			'search_items'      => "Найти стиль",
			'all_items'         => __( 'Все стили' ),
			'parent_item'       => __( 'Дочерние стили' ),
			'parent_item_colon' => __( 'Дочерние стили:' ),
			'edit_item'         => __( 'Редактировать стиль' ),
			'update_item'       => __( 'Обновить стиль' ),
			'add_new_item'      => __( 'Добавить новый стиль' ),
			'new_item_name'     => __( 'Имя новго стиля товара' ),
			'menu_name'         => __( 'Стили товара' ),
		),
		'description' => "Стиль дизайна товаров",
		'public' => true,
		'show_ui'       => true,
		'query_var'     => true,
		'show_in_rest'  => true,
		'show_admin_column'     => true,
	));
}


add_action('init', 'light_custom_init');

function light_custom_init(){
	register_post_type('light', array(
		'labels'             => array(
			'name'               => 'Продукты', // Основное название типа записи
			'singular_name'      => 'Продукты', // отдельное название записи типа Book
			'add_new'            => 'Добавить новый',
			'add_new_item'       => 'Добавить новый товар',
			'edit_item'          => 'Редактировать товар',
			'new_item'           => 'Новый товар',
			'view_item'          => 'Посмотреть товар',
			'search_items'       => 'Найти товар',
			'not_found'          =>  'Товаров не найдено',
			'not_found_in_trash' => 'В корзине товаров не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Товары'

		  ),
		'taxonomies' => array('lightcat'), 
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'show_admin_column'        => true,
		'show_in_quick_edit'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats')
	) );
}

// _____________________Колонки в таблицу админки

add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
 
function posts_columns($defaults){
    $defaults['riv_post_sku'] = __('Артикул');
	$defaults['riv_post_thumbs'] = __('Миниатюра');
	$defaults['riv_post_price'] = __('Цена');
	return $defaults;
}
 
function posts_custom_columns($column_name, $id){
	
	
	if($column_name === 'riv_post_sku'){
		$SKU_t = get_post_meta(get_the_ID(), "_offer_sku", true);
		echo empty($SKU_t)?"-":$SKU_t;
	}
	
	if($column_name === 'riv_post_thumbs'){	
		$img1 = get_the_post_thumbnail_url( get_the_ID(), "thumbnail");
		
		if (empty($img1))
			$img1 = get_bloginfo("template_url")."/img/no-photo.jpg";
		
		echo '<img width = "60" src = "'.$img1.'" />';
			
	
	}
	
	if($column_name === 'riv_post_price'){
		$PRICE = get_post_meta(get_the_ID(), "_offer_price", true);
		echo empty($PRICE)?"0 руб.":$PRICE." руб.";
	}
	
	
}

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
	/*
	Вид базового шаблона:
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>
	*/

	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

function filter_wpseo_sitemap_urlimages( $images, $post_id ) { 
	$pict = carbon_get_post_meta($post_id, 'offer_picture');
	if($pict) {
		$pictIndex = 0;
		foreach($pict as $item) {
			array_push($images, wp_get_attachment_image_src($item['gal_img'], 'full')[0]);
		}
	}

	 array_push($images, 'https://www.example.com/wp-content/uploads/extra-image.jpg');
	
	return $images; 
  }

  add_filter( 'wpseo_sitemap_urlimages', 'filter_wpseo_sitemap_urlimages', 10, 2 );

  include "crm-rest.php";

?>