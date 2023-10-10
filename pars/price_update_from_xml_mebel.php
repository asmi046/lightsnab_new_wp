<?php

//php www/lightsnab.ru/wp-content/themes/light-shop/pars/price_update_from_xml_mebel.php

// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

ini_set('max_execution_time', 5500);
ini_set('memory_limit','-1');
ini_set('post_max_size','256M');
ini_set('upload_max_filesize','256M');


require_once("../../../../wp-config.php");

global $wpdb;

$filename = "_mebel.xml";
    
echo  "Файл: ".$filename."\n\r";


if (file_exists('xml/'.$filename)) {
    $xml = simplexml_load_file('xml/'.$filename);

    $exist = 0;
    $no_exist = 0;
    $index = 1;

    
    foreach ($xml->shop->offers->children() as $elem)
    {
        
        

        
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'light',
            
            'meta_query' => [
                    'relation' => 'OR',
                    [
                        'key' => '_offer_sku',
                        'value' => (string)$elem->vendorCode
                    ]
            ]
          );
        $posts = new WP_Query($args);


        $curPrice = carbon_get_post_meta($posts->posts[0]->ID,"offer_price");

        echo $index."# ".$elem->name." - ".$elem->vendorCode." - ".$elem->price." - ".$curPrice;
    
        update_post_meta( $posts->posts[0]->ID, '_offer_price', (string)$elem->price);  

        if (empty($posts->posts[0])) {
            $no_exist++;
            echo " (---)";
        } 
        else {
            $exist++;
            echo " (ЕСТЬ!!!)";
        }
       
        echo "\n\r";
        $index++;
    }

  

    echo "Найдено: ".$exist++."\n\r";
    echo "НЕНАЙДЕН: ".$no_exist++."\n\r";
} else 
    echo "Файл не найден\n\r";

?>