<?php
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', ' TESTEEE');
    $sheet->setCellValue('A2', ' TESTEEE');
    $sheet->setCellValue('A3', ' TESTEEE');
    $sheet->setCellValue('A4', ' TESTEEE');
    $sheet->setCellValue('A5', ' TESTEEE');
    $sheet->setCellValue('A6', ' TESTEEE');
    $sheet->setCellValue('A7', ' TESTEEE');
    $sheet->setCellValue('A8', ' TESTEEE');
    $sheet->setCellValue('A9', ' TESTEEE');


    $writer = new Xlsx($spreadsheet);
    $writer->save('TESTE.xlsx');

    var_dump($sheet->getCellValue());
?>