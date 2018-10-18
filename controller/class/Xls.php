<?php

    require '../model/vendor/autoload.php'; // depois colocar director

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    class Xls
    {

      //criar metodos pivados para alterar as informações de size e style word
        public function printTable($data)
        {
            $spreadsheet = new Spreadsheet();
            $writer = new Xlsx($spreadsheet);
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();

            $arquivo = 'planilha.xls';
            $i = 8;

            foreach ($data as $key => $value) 
            {  
              $dataFinal[] = 
              [   
                  'disciplina' => $data[$key]['disciplina'],
                  'numDis' => $data[$key]['numDis'],
                  'matricula' => $data[$key]['matricula'],
                  'nomeAlu' => $data[$key]['nomeAlu']
              ];
            }

            foreach($dataFinal as $key => $value)
            {

              $dataFinal[$key]['nomeAlu'] = utf8_encode($dataFinal[$key]['nomeAlu']);
              //Seto o tamanho da letra e o tipo
              $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
              $spreadsheet->getDefaultStyle()->getFont()->setSize(12);

              //Seto as laguras das colunas
              $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(38);
              $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);

              // Seto o idioma
              $locale = 'pt_br';
              $validLocale = \PhpOffice\PhpSpreadsheet\Settings::setLocale($locale);
              
              if (!$validLocale) 
              {
                  echo 'Não encontramos o idioma '.$locale." - Revertendo para EN_US<br/>\n";
              }

              //Inserimos a imagem
              $drawing->setName('logoUFSC');
              $drawing->setDescription('logoUFSC');
              $drawing->setPath('../view/img/Universidade.png');
              $drawing->setCoordinates('A1');
              $drawing->getShadow()->setVisible(true);

              
              
              // Seto o tipo de página
              $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
              $spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

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
              $spreadsheet->getActiveSheet()->setCellValue('C6', $dataFinal[$key]['disciplina']);
              $spreadsheet->getActiveSheet()->setCellValue('D6', 'Turma:'.$data[$key]['numDis']);
              $spreadsheet->getActiveSheet()->setCellValue('AQ4', 'Pág.');
              $spreadsheet->getActiveSheet()->setCellValue('AQ3', '1');
              $spreadsheet->getActiveSheet()->setCellValue('AQ2', 'Ordem');
              $spreadsheet->getActiveSheet()->setCellValue('A7', 'Ordem');
              $spreadsheet->getActiveSheet()->setCellValue('B7', 'Matrícula');
              $spreadsheet->getActiveSheet()->setCellValue('C7', 'Aluno');
              $spreadsheet->getActiveSheet()->setCellValue('D7', 'Nota');
              $spreadsheet->getActiveSheet()->setCellValue('E7', 'Freq.');
              $spreadsheet->getActiveSheet()->setCellValue('F4', 'TESTE');

              $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $key);
              $spreadsheet->getActiveSheet()->setCellValue('B'.$i, intval($dataFinal[$key]['matricula']));
              $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $dataFinal[$key]['nomeAlu']);

              //Quebro linha caso haja necessidade 

              $spreadsheet->getActiveSheet()->getStyle('C8:C18')->getAlignment()->setWrapText(true);

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
                      'startColor' => [
                          'argb' => 'FFA0A0A0',
                      ],
                      'endColor' => [
                          'argb' => 'FFFFFFFF',
                      ],
                  ],
              ];

              $spreadsheet->getActiveSheet()->getStyle('A6:E7')->applyFromArray($styleArray);
              $spreadsheet->getActiveSheet()->getStyle('F4:F7')->getAlignment()->setTextRotation(-90)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
              $spreadsheet->getActiveSheet()->getStyle('AQ5:AQ7')->applyFromArray($styleArray);
              $spreadsheet->getActiveSheet()->getStyle('F3:AQ3')->applyFromArray($styleArray);
              $spreadsheet->getActiveSheet()->getStyle('A1:E5')->getBorders()->getAllborders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
              $spreadsheet->getActiveSheet()->getStyle('A'.$i.':E'.$i)->getBorders()->getAllborders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
              $spreadsheet->getActiveSheet()->getStyle('A'.$i.':B'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
              $spreadsheet->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
              
              $i++;
            }

            $sheet = $spreadsheet->getActiveSheet();
            $drawing->setWorksheet($spreadsheet->getActiveSheet());

            $this->donwload($spreadsheet, $dataFinal[$key]['disciplina']);     
        }

        public function donwload($spreadsheet, $archiveName)
        {
          $archiveName = trim($archiveName);

           //Forço um donwload no formato xls

          header('Content-Type: application/vnd.ms-excel');
          header("Content-Disposition: attachment; filename=\"{$archiveName}\".xls" );
          header('Cache-Control: max-age=0');

          $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
          $writer->save('php://output'); 
          
          exit;
        }
    }

?>