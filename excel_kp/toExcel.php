<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("template_kp.xlsx");
// $sheet = $reader->load("template_kp.xlsx");
// $sheet = $sheet->getActiveSheet();

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('template_kp.xlsx');
$worksheet = $spreadsheet->getActiveSheet();

$worksheet->setCellValue('P2', 'Hello World !');

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('Img');
$drawing->setDescription('Img');
$drawing->setPath('img/pict.jpg');
$drawing->setHeight(36);
$drawing->setCoordinates('P4');
$drawing->setWorksheet($spreadsheet->getActiveSheet());

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="kp.xlsx"');

$writer->save("php://output");

?>