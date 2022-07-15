<?
// https://lightsnab.ru/wp-content/themes/light-shop/excel_kp/roadlist.php?rlid=5

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define("BI_SERVICE_DB_NAME", "u0743099_lscrm");
define("BI_SERVICE_USER_NAME", "u0743099__lscrm");
define("BI_SERVICE_USER_PASS", "2V4o5H6o");
define("BI_SERVICE_DB_HOST", "localhost");

require_once("../../../../wp-config.php");

require 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('details.xlsx');
$worksheet = $spreadsheet->getActiveSheet();

$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);



if (!empty($_REQUEST["start"])&&!empty($_REQUEST["end"])) {
    $q = "SELECT `zakaz`.* FROM `zakaz` WHERE (`status` = 'Новый' OR `status` = 'Архив') AND (`zak_final_data` >= '".date("Y-m-d", strtotime($_REQUEST["start"]))."' AND `zak_final_data` <= '".date("Y-m-d", strtotime($_REQUEST["end"]))."') AND `mng_mail` LIKE '".$_REQUEST["manager"]."'";
    $rl = $serviceBase->get_results($q); 
    

    $cell_index = 2;
    foreach ($rl as $key => $value) { 
        $worksheet->insertNewRowBefore($cell_index+1);

        $worksheet->setCellValue('A'.$cell_index, $cell_index-1 );
        $worksheet->setCellValue('B'.$cell_index, $value->zak_numbet );
        $worksheet->setCellValue('C'.$cell_index, $value->mng_name );
        $worksheet->setCellValue('D'.$cell_index, $value->zak_final_data );
        $worksheet->setCellValue('E'.$cell_index, $value->klient_name );
        $worksheet->setCellValue('F'.$cell_index, $value->nomer_sheta_1c );
        $worksheet->setCellValue('G'.$cell_index, $value->summa_sheta_1c );
        $worksheet->setCellValue('H'.$cell_index, $value->total_summ );

        $cell_index++;
    }
}




$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
if (empty($_REQUEST["start"])||empty($_REQUEST["end"]))
header('Content-Disposition: attachment; filename="details.xlsx"');
else
header('Content-Disposition: attachment; filename="Детали продаж - '.$_REQUEST["manager"].' - '.date("d.m.Y").'.xlsx"');

$writer->save("php://output");


?>