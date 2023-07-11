<?
//php www/lightsnab.ru/wp-content/themes/light-shop/pars/priceload.php

ini_set('max_execution_time', 9000);

require_once("../../../../wp-config.php");


// $dir = "../../../../prices_all";
// $files = @scandir($dir,1);

// global $wpdb;

// print_r($files);

global $wpdb;
$wpdb->get_results("TRUNCATE `lshop_loadprice` ");

// $wpdb->show_errors(); // включит показ ошибок
// $wpdb->print_error(); // включит показ ошибок на экран
// $wpdb->hide_errors(); // выключит показ ошибок

// return;


// $filename = "all_price.xml";

// if (file_exists('xml/'.$filename)) {
//     $xmlObject = simplexml_load_file('xml/'.$filename);

//     $row = 0;
//     foreach ($xmlObject->Worksheet->Table->Row as $key => $value) {
//         if ($row === 0) {$row++; continue;}

//         $old_pricr = empty($value->Cell[3]->Data)?0:$value->Cell[3]->Data;


//         $rez = $wpdb->insert('lshop_loadprice' , 
//         [
//             "sku" => (string)$value->Cell[0]->Data, 
//             "price" => floatval($value->Cell[2]->Data), 
//             "count" => intval($value->Cell[4]->Data)
//         ] );

//         echo  $row . ": " . $value->Cell[0]->Data ." - ".$rez."\n\r";

//         // echo (string)$value->Cell[2]->Data ;
//         $row++;
//     }
// }

// $filename = "all_price.xml";

// if (file_exists('xml/'.$filename)) {
//     $xmlObject = simplexml_load_file('xml/'.$filename);

//     var_dump(count($xmlObject->shop->offers->offer));

//     $row = 0;
//     foreach ($xmlObject->shop->offers->offer as $item) {
        

//         $rez = $wpdb->insert('lshop_loadprice' , 
//         [
//             "sku" => (string)$item->vendorCode, 
//             "price" => floatval($item->price_retail), 
//             "count" => intval($item->quantity)
//         ] );

//         echo  $row . ": " . $item->vendorCode ." - ".$item->price_retail."\n\r";

//         // echo (string)$value->Cell[2]->Data ;
//         $row++;
//     }
// }

    $filename = "all_price.csv";

    $row = 0;

    if (($handle = fopen('xml/'.$filename, "r")) !== FALSE) {
        echo  $files[$i]."\n\r"; 
        while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
            if ($row == 0) {$row++; continue;}
            
                if (empty($data) || empty($data[0])) continue;

                $sku = $data[4];
                $count = $data[9];
                $price = str_replace(",", ".", $data[6]);
                $price_old = str_replace(",", ".", $data[7]);
                
                if (empty($sku)) continue;
                
                $wpdb->insert('lshop_loadprice' , ["sku" => $sku, "price" =>$price, "price_old" =>$price_old, "count" => $count] );
                
                echo  $sku." - ". $price . " - ". $price_old
                 ."\n\r"; 
            
            $row++; 
        }
    }

    fclose($handle);

?>