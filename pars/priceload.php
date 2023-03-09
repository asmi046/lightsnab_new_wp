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

// for ($i = 0; $i<count($files); $i++)
// if (($files[$i] !== ".")&&($files[$i] !== "..")&&(!empty($files[$i]))) {
//     $row = 0;

//     if (($handle = fopen($dir."/".$files[$i], "r")) !== FALSE) {
//         echo  $files[$i]."\n\r"; 
//         while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
//             if ($row == 0) {$row++; continue;}
            
//                 if (empty($data) || empty($data[0])) continue;

//                 $sku = $data[0];
//                 $count = $data[2];
//                 $price = str_replace(",",".",$data[1]);
                
//                 if (empty($sku)) continue;
                
//                 $wpdb->insert('lshop_loadprice' , ["sku" => $sku, "price" =>$price, "count" => $count] );
                
//                 echo  $sku."\n\r"; 
            
//             $row++; 
//         }

//     fclose($handle);
//     unlink($dir."/".$files[$i]); 
//     }    
// }

$filename = "all_price.xml";

if (file_exists('xml/'.$filename)) {
    $xmlObject = simplexml_load_file('xml/'.$filename);

    $row = 0;
    foreach ($xmlObject->Worksheet->Table->Row as $key => $value) {
        if ($row === 0) {$row++; continue;}

        $old_pricr = empty($value->Cell[3]->Data)?0:$value->Cell[3]->Data;


        $rez = $wpdb->insert('lshop_loadprice' , 
        [
            "sku" => (string)$value->Cell[0]->Data, 
            "price" => floatval($value->Cell[2]->Data), 
            "count" => intval($value->Cell[4]->Data)
        ] );

        echo  $row . ": " . $value->Cell[0]->Data ." - ".$rez."\n\r";

        // echo (string)$value->Cell[2]->Data ;
        $row++;
    }
}

?>