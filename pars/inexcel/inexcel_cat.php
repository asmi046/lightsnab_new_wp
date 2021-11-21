<?
    //php www/lightsnab.ru/wp-content/themes/light-shop/pars/inexcel/inexcel_cat.php

    ini_set('max_execution_time', 900);

    require_once("../../../../../wp-config.php");
            
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    
    require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

    $inputFileName = './datd_01_11_2021.xlsx';

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
        if (empty($objPHPExcel->getSheet(2)->getCell('C'.$i)->getValue())) {
            $i++;
            continue;}
        if (empty($objPHPExcel->getSheet(2)->getCell('E'.$i)->getValue())) {
            $i++;
            continue;}

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

        if (empty($posts->posts)) {
            echo "#" . $tovIndex . " " . $tovarInfo["naimenovanie"]." - Пост не существует  \n\r";
            continue; 
        }

        // echo "Добавлены категории ".$posts->posts[0]->post_title." ".$posts->posts[0]->ID." \n\r";

       
        $rez = wp_set_object_terms( $posts->posts[0]->ID, $tovarInfo["kategoria"], "lightcat", true );
        $rez = wp_set_object_terms( $posts->posts[0]->ID, explode(',', $tovarInfo["kategoria_pop"]), "lightcat", true );
        
        if (is_wp_error($rez)) {
            echo "Возникла ошибка\n\r";
        } else {
            echo "Добавлены категории ".$posts->posts[0]->post_title." ".$tovarInfo["kategoria"]." -> ".$tovarInfo["kategoria_pop"]." \n\r";
        }

        // break;
    }

    echo "Посты добавлены\n\r";
?>