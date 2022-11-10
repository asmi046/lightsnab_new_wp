<?
//php www/lightsnab.ru/wp-content/themes/light-shop/pars/inxml.php

// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

ini_set('max_execution_time', 5500);
ini_set('memory_limit','-1');
ini_set('post_max_size','256M');
ini_set('upload_max_filesize','256M');


function first_upper($str, $encoding='UTF-8') {
    $str = mb_ereg_replace('^[\ ]+', '', $str);
    $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
           mb_substr($str, 1, mb_strlen($str), $encoding);
    return $str;
}

//php marketsveta.su/wp-content/themes/light_market/pars/inxml.php
    require_once("../../../../wp-config.php");
            
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    global $wpdb;


    $filename = "export_crystallux.xml";
    
    echo  "Файл: ".$filename."\n\r";
   
   
    if (file_exists('xml/'.$filename)) {
        $xml = simplexml_load_file('xml/'.$filename);
        
        $curentTerm = array();

        echo  "\n\rНачато добавление товаров:\n\r\n\r";
        
        $i = 0;
        $of = $xml->shop->offers->children();
        foreach ($xml->shop->offers->children() as $elem)
        { 

            // if ($i<1097) {
            //     $i++;
            //     continue;
            // }
            

            echo "#: ".$i;
            echo "\n\r";
            echo (string)$elem->model;
            echo "\n\r";

            $brand = (string)$elem->vendor;

            $to_post_meta  = [ 
                '_offer_smile_descr' => empty((string)$elem->description)?(string)$elem->model:(string)$elem->description, 
                '_offer_type' => "Цокольный (Со сменными лампами)",
                '_offer_sku' => (string)$elem->vendorCode, 
                '_offer_nal' => ((int)$elem->quantity > 0)?"В наличии":"Под заказ",
                '_offer_name' => (string)$elem->model,
                '_offer_label' => "",
                '_offer_allsearch' => (string)$elem->model.", ".(string)$elem->vendorCode,
                '_offer_siries' => "",
                '_offer_fulltext' => (string)$elem->model.", ".(string)$elem->vendorCode,
                '_offer_price'     => 1000,
            ];

            $indexCh = 0;
            foreach ($elem->param as $param)
            {
                $p_value = (string)$param;
                $p_name = (string)$param->attributes()["name"];
                
                if ($p_name === "Код") $to_post_meta["_offer_sku"] = $p_value;
                if ($p_name === "Бренд") $brand = $p_value;
                if ($p_name === "Коллекция") $to_post_meta["_offer_siries"] = $p_value;
                
                $ignore_array = ["Бренд", "стиль" , "Форма", "мощность общая", "степень защиты ip", "пульт управления",
                "выключатель", "цвет свечения", "диммируемость", "Место установки", "солнечная батарея", "датчик движения", "Артикул", "количество грузовых мест",
                "объем коробки", "площадь освещения", "поворотный", "подсветка", "регулировка по высоте", "КодТовара",
                "Остаток", "Участник телепрограммы", "Два в одном", "Подвесные крепления", "Технологии", "Типы помещении", "Код ТН ВЭД", "Клас защиты", "Описание для каталога", "Маркер", "Индекс цветопередачи (Ra)", "ДатаПрихода",
                "Вес нетто", "Объем коробки, м3", "Ширина коробки, мм", "Длина коробки, мм", "Высота коробки, мм", "Вес брутто", "Страна происхождения",
                "Stock", "Штрихкод",
                ];

                if (in_array($p_name, $ignore_array)) continue;

                $to_post_meta["_offer_cherecter|c_name|".$indexCh."|0|value"] = first_upper($p_name);
                $to_post_meta["_offer_cherecter|c_val|".$indexCh."|0|value"] = $p_value;


                $indexCh++;
            }

            // var_dump($to_post_meta);
            // return;

            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'light',
                
                'meta_query' => [
                        'relation' => 'OR',
                        [
                            'key' => '_offer_sku',
                            'value' => (string)$to_post_meta["_offer_sku"]
                        ]
                ]
              );
            $posts = new WP_Query($args);

            if (empty($posts->posts[0])) {
                echo "Добавление нового поста.\n\r";
                
                $post_id = wp_insert_post(  wp_slash( array(
                    'post_type'     => 'light',
                    'post_author'    => 1,
                    'post_status'    => 'publish',
                    'post_title' => (string)$elem->model,
                    'post_excerpt'  => empty((string)$elem->description)?(string)$elem->model:(string)$elem->description,
                    'post_content'  => empty((string)$elem->description)?(string)$elem->model:(string)$elem->description,
                    'meta_input'     => $to_post_meta,
                    
                    
                ) ) );
            } else {

                 echo "Обновление поста: ". $posts->posts[0]->post_title." id: ".$posts->posts[0]->ID.".\n\r";
                $post_id = wp_update_post(  wp_slash( array(
                    'ID' => $posts->posts[0]->ID,
                    'post_type'     => 'light',
                    'post_author'    => 1,
                    'post_status'    => 'publish',
                    'post_title' => (string)$elem->model,
                    'post_excerpt'  => empty((string)$elem->description)?(string)$elem->model:(string)$elem->description,
                    'post_content'  => empty((string)$elem->description)?(string)$elem->model:(string)$elem->description,
                    'meta_input'     => $to_post_meta,
                    
                ) ) );
            }

            // wp_set_object_terms( $post_id, $to_post_meta["_offer_brend"], "lightbrand" );

            // $term = get_term_by('name', $curentTerm[(string)$elem->categoryId], 'lightcat');

            // $ancestors = get_ancestors( $term->term_id,  'lightcat' );
            
            $catArray = array();
            
            // foreach ($ancestors as $as)
            //     $catArray[] = $as; 
            // $catArray[] = $term->term_id; 

            
                $catArray[] = $brand;

                if (mb_stripos($elem->model, "Люстр") !== false) $catArray[] = "Люстры ".$brand;
                if (mb_stripos($elem->model, "Светиль") !== false) $catArray[] = "Светильники ".$brand;
                if (mb_stripos($elem->model, "Бра") !== false) $catArray[] = "Бра ".$brand;
                if (mb_stripos($elem->model, "Торш") !== false) $catArray[] = "Торшеры ".$brand;
                if (mb_stripos($elem->model, "Встраив") !== false) $catArray[] = "Встраиваемые светильники ".$brand;
                if (mb_stripos($elem->model, "Трек") !== false) $catArray[] = "Магнитная система ".$brand;
                
                if (count($catArray) == 1) $catArray[] = "Другие продукты ".$brand;
            
            wp_set_object_terms( $post_id, $catArray, "lightbrand" );   
           
            echo "Удаление старых вложений: \n\r";

            $media = get_attached_media( 'image', $post_id );
            foreach ($media as $mf)
            {
                $atdelrez = wp_delete_attachment( $mf->ID );
                echo empty($atdelrez)?"Ничего не удалено. \n\r":"Удалено вложение. \n\r";
            }

            echo "Галерея: \n\r";

            $indexImg = 0;
            foreach ($elem->picture as $galery)
            {
            
                echo $img1 = (string)$galery;
                echo "\n\r";
                $ttl = (string)$elem->vendor." ".(string)$elem->model." ".(string)$elem->vendorCode;
                $img_id = media_sideload_image( $img1, $post_id, $ttl, "id" );
            
            
                delete_post_meta( $post_id, '_offer_picture|gal_img|'.$indexImg.'|0|value');
                delete_post_meta( $post_id, '_offer_picture|gal_img_sku|'.$indexImg.'|0|value');
                delete_post_meta( $post_id, '_offer_picture|gal_img_alt|'.$indexImg.'|0|value');
            
                add_post_meta( $post_id, '_offer_picture|gal_img|'.$indexImg.'|0|value', $img_id, true );
                add_post_meta( $post_id, '_offer_picture|gal_img_sku|'.$indexImg.'|0|value',  "", true );
                add_post_meta( $post_id, '_offer_picture|gal_img_alt|'.$indexImg.'|0|value', $ttl, true );

                if ($indexImg == 0) set_post_thumbnail($post_id, $img_id);
            
                $indexImg++;
            }

            //  if ($i == 1) break;

            echo "\n\r";
            echo "\n\r";

            
            $i++;
           
        }  
        
    } 



?>