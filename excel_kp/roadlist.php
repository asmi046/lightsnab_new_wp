<?
// https://lightsnab.ru/wp-content/themes/light-shop/excel_kp/roadlist.php?rlid=5

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require_once("../../../../wp-config.php");

require 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('roadlist.xlsx');
$worksheet = $spreadsheet->getActiveSheet();

$serviceBase = new wpdb(BI_SERVICE_USER_NAME, BI_SERVICE_USER_PASS, BI_SERVICE_DB_NAME, BI_SERVICE_DB_HOST);



if (!empty($_REQUEST["rlid"])) {
    $rl = $serviceBase->get_results("SELECT * FROM `road_lists` WHERE `id` = ".$_REQUEST["rlid"]); 
    
    $worksheet->setCellValue('A1', "Маршрутный лист №".$rl[0]->id." от ". date("d.m.Y",strtotime($rl[0]->data)));
    $worksheet->setCellValue('A3', "Комментарий: ". $rl[0]->comment);

    // $q = "SELECT * FROM `road_lists_sklads` WHERE `road_list_id` = ".$_REQUEST["rlid"];
    $q = "SELECT `road_lists_sklads`.*, `sklad_list`.`adres` as 'skladadress' FROM `road_lists_sklads` LEFT JOIN `sklad_list` ON `road_lists_sklads`.`sklad_id` = `sklad_list`.`id` WHERE `road_list_id` = ".$_REQUEST["rlid"];
	$lists_sklad = $serviceBase->get_results($q);

    $sklad_result = [];
	foreach ($lists_sklad as $sk) {
		$sklad_result[$sk->sklad_name][] =  $sk;
	}

    $cell_index = 7;
    foreach ($sklad_result as $key => $value) { 
        $worksheet->insertNewRowBefore($cell_index);

        $worksheet->mergeCells('A'.$cell_index.':'.'I'.$cell_index);
        $worksheet->getStyle('A'.$cell_index)
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('87cefa');

        $worksheet->getStyle('A'.$cell_index)->getAlignment()->setVertical(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        );
        $spreadsheet->getActiveSheet()->getRowDimension($cell_index, $key)->setRowHeight(40);
        $worksheet->setCellValue('A'.$cell_index, $key." (".$value[0]->skladadress.")");

        for ($i=0; $i<count($value); $i++) {
            $worksheet->insertNewRowBefore($cell_index+1);
            $cell_index++;

            $worksheet->getStyle('A'.$cell_index)
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFFFF');
            $spreadsheet->getActiveSheet()->getRowDimension($cell_index, $key)->setRowHeight(20);

            $worksheet->mergeCells('A'.$cell_index.':'.'D'.$cell_index);
            $worksheet->mergeCells('E'.$cell_index.':'.'F'.$cell_index);
            $worksheet->mergeCells('G'.$cell_index.':'.'I'.$cell_index);

            $worksheet->setCellValue('A'.$cell_index, $value[$i]->document);
            $worksheet->setCellValue('E'.$cell_index, $value[$i]->pay);
            $worksheet->setCellValue('G'.$cell_index, $value[$i]->commen);

        }

        $cell_index++;
    }

    $cell_index+=3;
    $q = "SELECT * FROM `road_lists_delivey` WHERE `road_list_id` = ".$_REQUEST["rlid"];
    $lists_delivery = $serviceBase->get_results($q);

    foreach ($lists_delivery as $element) { 
        $worksheet->insertNewRowBefore($cell_index);

        $worksheet->mergeCells('A'.$cell_index.':'.'I'.$cell_index);
        $worksheet->getStyle('A'.$cell_index)
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('90ee90');

        $worksheet->getStyle('A'.$cell_index)->getAlignment()->setVertical(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        );

        $spreadsheet->getActiveSheet()->getRowDimension($cell_index, $key)->setRowHeight(40);
        $worksheet->setCellValue('A'.$cell_index, $element->adres . " (".$element->zak_numbet.")");

        $worksheet->insertNewRowBefore($cell_index+1);
        $cell_index++;

        $worksheet->getStyle('A'.$cell_index)
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFFFF');
        $spreadsheet->getActiveSheet()->getRowDimension($cell_index, $key)->setRowHeight(20);

        $worksheet->mergeCells('A'.$cell_index.':'.'I'.$cell_index);
        $worksheet->setCellValue('A'.$cell_index, "Клиент: ".$element->klient_name);

        $worksheet->insertNewRowBefore($cell_index+1);
        $cell_index+=1;
        $worksheet->mergeCells('A'.$cell_index.':'.'I'.$cell_index);
        $worksheet->setCellValue('A'.$cell_index, "Комментарий: ".$element->comment);

        $worksheet->insertNewRowBefore($cell_index+1);
        $cell_index+=1;
        $worksheet->mergeCells('A'.$cell_index.':'.'I'.$cell_index);
        $worksheet->setCellValue('A'.$cell_index, "Телефон: ".$element->klient_phone);
        
        $cell_index++;
    }

}






$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
if (empty($_REQUEST["rlid"]))
header('Content-Disposition: attachment; filename="kp.xlsx"');
else
header('Content-Disposition: attachment; filename="Маршрутный лист - '.$_REQUEST["rlid"].' - '.date("d.m.Y",strtotime($rl[0]->data)).'.xlsx"');

$writer->save("php://output");


?>