<?
//php www/lightsnab.ru/wp-content/themes/light-shop/pars/priceload.php

ini_set('max_execution_time', 9000);

require_once("../../../../wp-config.php");


$dir = "../../../../prices_all";
$files = @scandir($dir,1);

global $wpdb;

print_r($files);

global $wpdb;
$wpdb->get_results("TRUNCATE `lshop_loadprice` ");

// $wpdb->show_errors(); // включит показ ошибок
// $wpdb->print_error(); // включит показ ошибок на экран
// $wpdb->hide_errors(); // выключит показ ошибок

// return;

for ($i = 0; $i<count($files); $i++)
if (($files[$i] !== ".")&&($files[$i] !== "..")&&(!empty($files[$i]))) {
    $row = 0;

    if (($handle = fopen($dir."/".$files[$i], "r")) !== FALSE) {
        echo  $files[$i]."\n\r"; 
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            if ($row == 0) {$row++; continue;}
            
                if (empty($data) || empty($data[0])) continue;

                $sku = $data[0];
                $count = $data[2];
                $price = str_replace(",",".",$data[1]);
                
                if (empty($sku)) continue;
                
                

                $wpdb->insert('lshop_loadprice' , ["sku" => $sku, "price" =>$price, "count" => $count] );
                
                // $idrez = $wpdb->get_results('SELECT * FROM `lshop_postmeta` WHERE `meta_key` = "_offer_sku" AND `meta_value` = "'.$sku.'"');

                // echo  "#: ".$row."\n\r";
                // echo  "KSU: ".$sku."\n\r";
                // echo  "Колличество: ".$count."\n\r";
                // echo  "Цена: ".$price."\n\r";
                
                // // $posts->posts[0]
                // if (!empty($idrez[0]->post_id)) {
                //     echo  "Пост ID: ".$idrez[0]->post_id."\n\r"; 
                //     // echo  "Товар: ".$posts->posts[0]->post_title."\n\r";
                //     // carbon_set_post_meta( (int)$idrez[0]->post_id, 'offer_nal_count', (string)$count ); 
                //     carbon_set_post_meta( (int)$idrez[0]->post_id, 'offer_price', (string)$price ); 
                // } else {
                //     echo  "Пост не найден. \n\r"; 
                // }

                echo  $sku."\n\r"; 
            
            $row++; 
        }

    fclose($handle);
    unlink($dir."/".$files[$i]); 
    }    
}

?>