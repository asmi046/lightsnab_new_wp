<?
// https://lightsnab.ru/wp-content/themes/light-shop/excel_kp/kp.php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define("BI_SERVICE_DB_NAME", "u0743099_lscrm");
define("BI_SERVICE_USER_NAME", "u0743099__lscrm");
define("BI_SERVICE_USER_PASS", "2V4o5H6o");
define("BI_SERVICE_DB_HOST", "localhost");

require_once("../../../../wp-config.php");

require 'vendor/autoload.php';

function load_file($lnk) {
    $filename = "img/".basename($lnk);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $lnk);
    $fp = fopen($filename, 'w');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_exec ($ch);
    curl_close ($ch);
    fclose($fp);
    return $filename;
}

function deleteFile($lnk) {
    unlink("img/".basename($lnk));
} 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("template_kp.xlsx");
// $sheet = $reader->load("template_kp.xlsx");
// $sheet = $sheet->getActiveSheet();

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('template_kp.xlsx');
$worksheet = $spreadsheet->getActiveSheet();

$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);



if (!empty($_REQUEST["number"])) {
    $zak = $serviceBase->get_results("SELECT * FROM `zakaz` WHERE `zak_numbet` = '".$_REQUEST["number"]."'"); 
    $rezTov = $serviceBase->get_results("SELECT * FROM `zakaz_tovar` WHERE `zak_number` = '".$_REQUEST["number"]."'"); 
    $i = 0;
    
    $worksheet->setCellValue('H7', $zak[0]->klient_name);
    $worksheet->setCellValue('H8', $zak[0]->phone);
    $worksheet->setCellValue('H9', $zak[0]->adres);

    $worksheet->setCellValue('C10', "Заказ ".$_REQUEST["number"]." от ".date("m.d.Y", strtotime($zak[0]->zak_data)));

    

    foreach ($rezTov as $elem) {
        
        

        $worksheet->insertNewRowBefore(13+$i);
        
        $spreadsheet->getActiveSheet()->getRowDimension(13+$i)->setRowHeight(90);

        $worksheet->setCellValue('A'.(13+$i), $i+1);
        $worksheet->setCellValue('B'.(13+$i), $elem->sku);
        $worksheet->mergeCells('D'.(13+$i).':'.'F'.(13+$i));
        $worksheet->getStyle('D'.(13+$i))->getAlignment()->setWrapText(true);
        $worksheet->setCellValue('D'.(13+$i), $elem->name);
        $worksheet->setCellValue('G'.(13+$i), $elem->price);
        $worksheet->setCellValue('H'.(13+$i), $elem->count);
        $worksheet->setCellValue('J'.(13+$i), $elem->summ);
        $worksheet->setCellValue('K'.(13+$i), $elem->nal." ".$elem->comment);

        
        
        $fname = load_file($elem->img);

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName($elem->sku);
        $drawing->setDescription($elem->sku);
        $drawing->setOffsetX(10); 
        $drawing->setOffsetY(10); 
        $drawing->setPath($fname);
        $drawing->setHeight(86);
        $drawing->setCoordinates('C'.(13+$i));
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        
        
        $i++;
    }

    $worksheet->setCellValue('J'.(13+$i), $zak[0]->total_summ);


}






$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="kp.xlsx"');

$writer->save("php://output");

foreach ($rezTov as $elem) {
    deleteFile($elem->img);
}

?>