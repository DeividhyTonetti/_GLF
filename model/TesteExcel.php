<?php
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    //Estancio os objetos
    $spreadsheet = new Spreadsheet();
    $writer = new Xlsx($spreadsheet);

    //Configuro a página para impressão
    $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    $spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

    // Seto o idioma
    $locale = 'pt_br';
    $validLocale = \PhpOffice\PhpSpreadsheet\Settings::setLocale($locale);
    
    if (!$validLocale) 
    {
        echo 'Não encontramos o idioma '.$locale." - Revertendo para EN_US<br/>\n";
    }
    

    //Mesclo as células
    $spreadsheet->getActiveSheet()->mergeCells('A1:E5');
    $spreadsheet->getActiveSheet()->mergeCells('A6:B6');
    $spreadsheet->getActiveSheet()->mergeCells('D6:E6');
    $spreadsheet->getActiveSheet()->mergeCells('F4:F7');
    $spreadsheet->getActiveSheet()->mergeCells('AQ4:AQ5');
    $spreadsheet->getActiveSheet()->mergeCells('F3:AQ3');

    //Insiro dados nas células
    $spreadsheet->getActiveSheet()->setCellValue('F3', 'LISTA DE FREQUÊNCIA');
    $spreadsheet->getActiveSheet()->setCellValue('A6', 'ARA-ALGUMACOISA');
    $spreadsheet->getActiveSheet()->setCellValue('C6', 'NomeDISCIPLINA');
    $spreadsheet->getActiveSheet()->setCellValue('D6', 'Turma: Nº');
    $spreadsheet->getActiveSheet()->setCellValue('AQ4', 'Pág.');
    $spreadsheet->getActiveSheet()->setCellValue('AQ3', '1');
    $spreadsheet->getActiveSheet()->setCellValue('AQ2', 'Ordem');
    $spreadsheet->getActiveSheet()->setCellValue('A7', 'Ordem');
    $spreadsheet->getActiveSheet()->setCellValue('B7', 'Matrícula');
    $spreadsheet->getActiveSheet()->setCellValue('C7', 'Aluno');
    $spreadsheet->getActiveSheet()->setCellValue('D7', 'Nota');
    $spreadsheet->getActiveSheet()->setCellValue('E7', 'Frequência');

    // Costruimos um array para setar os estilos de linha, font, borda, cores, alinhamento etc..
   
    /*Border style 
             BORDER_NONE             = 'none';
             BORDER_DASHDOT          = 'dashDot';
             BORDER_DASHDOTDOT       = 'dashDotDot';
             BORDER_DASHED           = 'dashed';
             BORDER_DOTTED           = 'dotted';
             BORDER_DOUBLE           = 'double';
             BORDER_HAIR             = 'hair';
             BORDER_MEDIUM           = 'medium';
             BORDER_MEDIUMDASHDOT    = 'mediumDashDot';
             BORDER_MEDIUMDASHDOTDOT = 'mediumDashDotDot';
             BORDER_MEDIUMDASHED     = 'mediumDashed';
             BORDER_SLANTDASHDOT     = 'slantDashDot';
             BORDER_THICK            = 'thick';
             BORDER_THIN             = 'thin';
    */ 

    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ]
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation' => 90,
            'startColor' => [
                'argb' => 'FFA0A0A0',
            ],
            'endColor' => [
                'argb' => 'FFFFFFFF',
            ],
        ],
    ];

    $spreadsheet->getActiveSheet()->getStyle('A6:E7')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('F4:F7')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('AQ5:AQ7')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('F3:AQ3')->applyFromArray($styleArray);


   

    //Ativo as células
    $sheet = $spreadsheet->getActiveSheet();
    
    //Forço um donwload no formato xls
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="myfile.xls"');
    header('Cache-Control: max-age=0');

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
    $writer->save('php://output');

    

?>