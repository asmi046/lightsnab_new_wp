<?
    //php www/lightsnab.ru/wp-content/themes/light-shop/pars/inexcel/inexcel.php

    ini_set('max_execution_time', 900);

    require_once("../../../../../wp-config.php");
            
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    
    require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

    $inputFileName = './data_04_07_2021.xlsx';

    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    
    global $wpdb;
   

    $i = 3;
    
    echo "Начато добавление в БД из Excel\n\r";
    $wpdb->show_errors(); // включит показ ошибок
    $wpdb->query( "TRUNCATE `transfer_main`" );
    while (!empty($objPHPExcel->getSheet(0)->getCell('A'.$i)->getValue()))
    {
        // echo $objPHPExcel->getSheet(0)->getCell('A'.$i)->getValue()."\n\r";
        $wpdb->insert( 'transfer_main', array (
                "naimenovanie" => !empty($objPHPExcel->getSheet(0)->getCell('A'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('A'.$i)->getValue():"",
                "kategoria" => !empty($objPHPExcel->getSheet(0)->getCell('B'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('B'.$i)->getValue():"",
                "kategoria_pop" => !empty($objPHPExcel->getSheet(0)->getCell('C'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('C'.$i)->getValue():"",
                "style" => !empty($objPHPExcel->getSheet(0)->getCell('D'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('D'.$i)->getValue():"",
                "kratkoe" => !empty($objPHPExcel->getSheet(0)->getCell('E'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('E'.$i)->getValue():"",
                "nazvanie" => !empty($objPHPExcel->getSheet(0)->getCell('F'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('F'.$i)->getValue():"",
                "metka" => !empty($objPHPExcel->getSheet(0)->getCell('G'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('G'.$i)->getValue():"",
                "dluapoiska" => !empty($objPHPExcel->getSheet(0)->getCell('H'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('H'.$i)->getValue():"",
                "seria" => !empty($objPHPExcel->getSheet(0)->getCell('I'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('I'.$i)->getValue():"",
                "articulbase" => !empty($objPHPExcel->getSheet(0)->getCell('J'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('J'.$i)->getValue():"",
                "nalichie" => !empty($objPHPExcel->getSheet(0)->getCell('K'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('K'.$i)->getValue():"",
                "seotext" => !empty($objPHPExcel->getSheet(0)->getCell('L'.$i)->getValue())?$objPHPExcel->getSheet(0)->getCell('L'.$i)->getValue():""
            ) );

        
        $i++;
    } 
 
    
    echo "Добавлена основная таблица\n\r";

    $i = 2;
    $wpdb->query( "TRUNCATE `transfer_cerecter`" );
    while (!empty($objPHPExcel->getSheet(1)->getCell('A'.$i)->getValue()))
    {
        $wpdb->insert( 'transfer_cerecter', array (
                "articulbase" => !empty($objPHPExcel->getSheet(1)->getCell('A'.$i)->getValue())?$objPHPExcel->getSheet(1)->getCell('A'.$i)->getValue():"",
                "naimenovanie" => !empty($objPHPExcel->getSheet(1)->getCell('B'.$i)->getValue())?$objPHPExcel->getSheet(1)->getCell('B'.$i)->getValue():"",
                "paramname" => !empty($objPHPExcel->getSheet(1)->getCell('C'.$i)->getValue())?$objPHPExcel->getSheet(1)->getCell('C'.$i)->getValue():"",
                "paramzn" => !empty($objPHPExcel->getSheet(1)->getCell('D'.$i)->getValue())?$objPHPExcel->getSheet(1)->getCell('D'.$i)->getValue():"",
            ) );

        
        $i++;
    } 
    
    echo "Добавлена таблица характеристик\n\r";

    $i = 2;
    $wpdb->query( "TRUNCATE `transfer_mod`" );
    while (!empty($objPHPExcel->getSheet(2)->getCell('A'.$i)->getValue()))
    {
        $wpdb->insert( 'transfer_mod', array (
                "basearticle" => !empty($objPHPExcel->getSheet(2)->getCell('A'.$i)->getValue())?$objPHPExcel->getSheet(2)->getCell('A'.$i)->getValue():"",
                "naimenovanie" => !empty($objPHPExcel->getSheet(2)->getCell('B'.$i)->getValue())?$objPHPExcel->getSheet(2)->getCell('B'.$i)->getValue():"",
                "namemodif" => !empty($objPHPExcel->getSheet(2)->getCell('C'.$i)->getValue())?$objPHPExcel->getSheet(2)->getCell('C'.$i)->getValue():"",
                "artmodif" => !empty($objPHPExcel->getSheet(2)->getCell('D'.$i)->getValue())?$objPHPExcel->getSheet(2)->getCell('D'.$i)->getValue():"",
                "modprice" => !empty($objPHPExcel->getSheet(2)->getCell('E'.$i)->getValue())?$objPHPExcel->getSheet(2)->getCell('E'.$i)->getValue():"",
                "modpriceold" => !empty($objPHPExcel->getSheet(2)->getCell('F'.$i)->getValue())?$objPHPExcel->getSheet(2)->getCell('F'.$i)->getValue():"",
                "modpicture" => !empty($objPHPExcel->getSheet(2)->getCell('G'.$i)->getValue())?$objPHPExcel->getSheet(2)->getCell('G'.$i)->getValue():"",
            ) );

        
        $i++;
    } 
    
    echo "Добавлена таблица модификаций\n\r";
   
    $i = 2;
    $wpdb->query( "TRUNCATE `transfer_galery`" );
    while (!empty($objPHPExcel->getSheet(3)->getCell('A'.$i)->getValue()))
    {
        $wpdb->insert( 'transfer_galery', array (
                "basearticle" => !empty($objPHPExcel->getSheet(3)->getCell('A'.$i)->getValue())?$objPHPExcel->getSheet(3)->getCell('A'.$i)->getValue():"",
                "naimenovanie" => !empty($objPHPExcel->getSheet(3)->getCell('B'.$i)->getValue())?$objPHPExcel->getSheet(3)->getCell('B'.$i)->getValue():"",
                "filename" => !empty($objPHPExcel->getSheet(3)->getCell('C'.$i)->getValue())?$objPHPExcel->getSheet(3)->getCell('C'.$i)->getValue():"",
                "modid" => !empty($objPHPExcel->getSheet(3)->getCell('D'.$i)->getValue())?$objPHPExcel->getSheet(3)->getCell('D'.$i)->getValue():"",
                "alttitle" => !empty($objPHPExcel->getSheet(3)->getCell('E'.$i)->getValue())?$objPHPExcel->getSheet(3)->getCell('E'.$i)->getValue():"",
               ) );

        
        $i++;
    } 
    
    echo "Добавлена таблица галереи\n\r";

    $results = $wpdb->get_results("SELECT * FROM `transfer_main`", ARRAY_A);

    $tovIndex = 0;
    foreach ($results as $tovarInfo){
        $tovIndex ++;
        $galery = $wpdb->get_results("SELECT * FROM `transfer_galery` WHERE `basearticle` = '".$tovarInfo["articulbase"]."'", ARRAY_A);



        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'light',
            
            'meta_query' => [
                    'relation' => 'OR',
                    [
                        'key' => '_offer_sku',
                        'value' => (string)$tovarInfo["articulbase"]
                    ]
            ]
          );
        $posts = new WP_Query($args);

        if (!empty($posts)) {
            echo "#" . $tovIndex . " " . $tovarInfo["naimenovanie"]." - Пост уже существует  \n\r";
            continue; 
        }

        if (empty($galery)) {
            echo "#" . $tovIndex . " " . $tovarInfo["naimenovanie"]." - Нет фото в базе! \n\r";
            continue;
        }

        if (!file_exists(__DIR__.'/photo/'.$galery[0]["filename"])) {
            echo "#" . $tovIndex . " " . $galery[0]["filename"]." - Нет фото в папке! \n\r";
            continue;
        }

        $to_post_meta  = [ 
            '_offer_smile_descr' => $tovarInfo["kratkoe"], 
            '_offer_type' => "Цокольный (Со сменными лампами)", 
            '_offer_sku' => $tovarInfo["articulbase"], 
            '_offer_nal' => 'В пути',
            '_offer_name' => $tovarInfo['nazvanie'],
            '_offer_label' => $tovarInfo['metka'],
            '_offer_allsearch' => $tovarInfo['dluapoiska']." ".$tovarInfo['kategoria_pop'],
            '_offer_siries' => $tovarInfo['seria'],
            '_offer_fulltext' => $tovarInfo['seotext'],
        ];

        $indexCh = 0;
        $cerecter = $wpdb->get_results("SELECT * FROM `transfer_cerecter` WHERE `articulbase` = '".$tovarInfo["articulbase"]."'", ARRAY_A);
        foreach ($cerecter as $carrecter) {
            $to_post_meta["_offer_cherecter|c_name|".$indexCh."|0|value"] = $carrecter["paramname"];
            $to_post_meta["_offer_cherecter|c_val|".$indexCh."|0|value"] = $carrecter["paramzn"];
            $indexCh++;
        }

        $indexMod = 0;
        $mod = $wpdb->get_results("SELECT * FROM `transfer_mod` WHERE `basearticle` = '".$tovarInfo["articulbase"]."'", ARRAY_A);
        foreach ($mod as $modif) {
            $to_post_meta["_offer_modification|mod_name|".$indexMod."|0|value"] = $modif["namemodif"];
            $to_post_meta["_offer_modification|mod_sku|".$indexMod."|0|value"] = $modif["artmodif"];
            $to_post_meta["_offer_modification|mod_price|".$indexMod."|0|value"] = $modif["modprice"];
            $to_post_meta["_offer_modification|mod_old_price|".$indexMod."|0|value"] = $modif["modpriceold"];
            $to_post_meta["_offer_modification|mod_picture_id|".$indexMod."|0|value"] = $modif["modpicture"];
            
            if ($tovarInfo["articulbase"] == $modif["artmodif"]) {
                $to_post_meta["_offer_price"] = $modif["modprice"];
                $to_post_meta["_offer_old_price"] = $modif["modpriceold"];
            }

            $indexMod++;
        }

        

        $postCat = array();

        if (trim ($tovarInfo["kategoria"]) === "Светильники и подвесной свет") $postCat = array(12);
        if (trim ($tovarInfo["kategoria"]) === "Люстры") $postCat = array(11);
        if (trim ($tovarInfo["kategoria"]) === "Люстры для низких потолков") $postCat = array(13);
        if (trim ($tovarInfo["kategoria"]) === "Потолочные светильники") $postCat = array(14);
        if (trim ($tovarInfo["kategoria"]) === "Реечные и рядные светильники и люстры") $postCat = array(15);
        if (trim ($tovarInfo["kategoria"]) === "Бра и настенное освещение") $postCat = array(16);
        if (trim ($tovarInfo["kategoria"]) === "Торшеры") $postCat = array(17);
        if (trim ($tovarInfo["kategoria"]) === "Настольные лампы") $postCat = array(18);
        if (trim ($tovarInfo["kategoria"]) === "Точечный свет") $postCat = array(19);
        if (trim ($tovarInfo["kategoria"]) === "Детский свет") $postCat = array(20);
            

        $post_id = wp_insert_post(  wp_slash( array(
            'post_type'     => 'light',
            'post_author'    => 1,
            'post_status'    => 'publish',
            'post_title' => $tovarInfo["naimenovanie"],
            'post_excerpt'  => $tovarInfo["kratkoe"],
            'post_content'  => $tovarInfo["kratkoe"],
            'meta_input'     => $to_post_meta,
            
        ) ) );


        echo "#" . $tovIndex . " " . $tovarInfo["naimenovanie"]." - ДОБАВЛЕН! \n\r";

        wp_set_object_terms( $post_id, $postCat, "lightcat" );
        wp_set_object_terms( $post_id, explode(',', $tovarInfo["style"]), "lightstyle" );

        $indexImg = 0;
        
        foreach ($galery as $img) {
            $img1 = get_bloginfo("template_url").'/pars/inexcel/photo/'. $img["filename"];
            $ttl = $img["alttitle"];
            $img_id = media_sideload_image( $img1, $post_id, $ttl, "id" );
            
            add_post_meta( $post_id, '_offer_picture|gal_img|'.$indexImg.'|0|value', $img_id, true );
            add_post_meta( $post_id, '_offer_picture|gal_img_sku|'.$indexImg.'|0|value',  $img["modid"], true );
            add_post_meta( $post_id, '_offer_picture|gal_img_alt|'.$indexImg.'|0|value', $ttl, true );
            
            if ($indexImg == 0) set_post_thumbnail($post_id, $img_id);
            
            $indexImg++;
        }   
        // $tovIndex ++;

        // if ($tovIndex > 3)
        // break;
    }

    echo "Посты добавлены\n\r";
?>