<?php
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $spreadsheet = new Spreadsheet();

    $locale = 'pt_br';
    $validLocale = \PhpOffice\PhpSpreadsheet\Settings::setLocale($locale);
    
    if (!$validLocale) 
    {
        echo 'Não encontramos o idioma '.$locale." - Revertendo para EN_US<br/>\n";
    }

    $spreadsheet->getActiveSheet()->mergeCells('A1:E5');
    $spreadsheet->getActiveSheet()->mergeCells('A6:B6');
    $spreadsheet->getActiveSheet()->mergeCells('D6:E6');
    $spreadsheet->getActiveSheet()->mergeCells('F4:F7');

    $i = 0;
    foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as $drawing) {
        if ($drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing) {
            ob_start();
            call_user_func(
                $drawing->getRenderingFunction(),
                $drawing->getImageResource()
            );
            $imageContents = ob_get_contents();
            ob_end_clean();
            switch ($drawing->getMimeType()) {
                case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_PNG :
                    $extension = 'png';
                    break;
                case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_GIF:
                    $extension = 'gif';
                    break;
                case \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_JPEG :
                    $extension = 'jpg';
                    break;
            }
        } else {
            $zipReader = fopen($drawing->getPath(),'r');
            $imageContents = '';
            while (!feof($zipReader)) {
                $imageContents .= fread($zipReader,1024);
            }
            fclose($zipReader);
            $extension = $drawing->getExtension();
        }
        $myFileName = '00_Image_'.++$i.'.'.$extension;
        file_put_contents($myFileName,$imageContents);
    }

    $sheet = $spreadsheet->getActiveSheet();
    
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing();
    
    $drawing->setName('PhpSpreadsheet logo');
    $drawing->setPath('../view/img/Universidade.png');
    $drawing->setHeight(36);
    $spreadsheet->getActiveSheet()->getHeaderFooter()->addImage($drawing, \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter::IMAGE_HEADER_LEFT);

    $sheet->setCellValue('A1', $spreadsheet->getActiveSheet()->getHeaderFooter()->addImage($drawing, \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter::IMAGE_HEADER_LEFT));
    $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    $spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
    


    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="myfile.xls"');
    header('Cache-Control: max-age=0');

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
    $writer->save('php://output');

?>