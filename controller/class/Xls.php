<?php

    require '../model/vendor/autoload.php'; // depois colocar director

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    class Xls
    {

      //criar metodos pivados para alterar as informações de size e style word
        public function printTable($data)
        {
            $now = new Date();

            $arquivo = 'planilha.xls';
            $i = 8;

            $spreadsheet = new Spreadsheet();
            $writer = new Xlsx($spreadsheet);
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();

            //Configuro a página para impressão
            $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
            //$spreadsheet->getActiveSheet()->getPageSetup()->setFitToPage(100);
            $spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
            $spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(0);

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
              
              //---------------------------TABELA 1------------------------------
              //Inserimos a imagem
              $drawing->setName('logoUFSC');
              $drawing->setDescription('logoUFSC');
              $drawing->setPath('../view/img/Universidade.png');
              $drawing->setCoordinates('A1');
              $drawing->getShadow()->setVisible(true);


              //Mesclo as células
              $spreadsheet->getActiveSheet()->mergeCells('F1:AQ1');
              $spreadsheet->getActiveSheet()->mergeCells('F2:AQ2');
              $spreadsheet->getActiveSheet()->mergeCells('A1:E5');
              $spreadsheet->getActiveSheet()->mergeCells('A6:B6');
              $spreadsheet->getActiveSheet()->mergeCells('D6:E6');
              $spreadsheet->getActiveSheet()->mergeCells('F4:F7');
              $spreadsheet->getActiveSheet()->mergeCells('F3:AQ3');
              
              //Insiro dados nas células
              $spreadsheet->getActiveSheet()->setCellValue('F1', 'LISTA DE FREQUÊNCIA');
              $spreadsheet->getActiveSheet()->setCellValue('A6', 'ARA-ALGUMACOISA');
              $spreadsheet->getActiveSheet()->setCellValue('C6', $dataFinal[$key]['disciplina']);
              $spreadsheet->getActiveSheet()->setCellValue('D6', 'Turma:'.$data[$key]['numDis']);
              $spreadsheet->getActiveSheet()->setCellValue('AQ5', 'Pág.');
              $spreadsheet->getActiveSheet()->setCellValue('AQ6', '1');
              $spreadsheet->getActiveSheet()->setCellValue('AQ7', 'Ordem');
              $spreadsheet->getActiveSheet()->setCellValue('A7', 'Ordem');
              $spreadsheet->getActiveSheet()->setCellValue('B7', 'Matrícula');
              $spreadsheet->getActiveSheet()->setCellValue('C7', 'Aluno');
              $spreadsheet->getActiveSheet()->setCellValue('D7', 'Nota');
              $spreadsheet->getActiveSheet()->setCellValue('E7', 'Freq.');
              $spreadsheet->getActiveSheet()->setCellValue('F4', 'TESTE');

            if($i % 2 == 1)
            {
                $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $key);
                $spreadsheet->getActiveSheet()->setCellValue('AQ'.$i, $key);
                $spreadsheet->getActiveSheet()->setCellValue('B'.$i, intval($dataFinal[$key]['matricula']));
                $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $dataFinal[$key]['nomeAlu']);
            
            }
            else
            {
                $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $key);
                $spreadsheet->getActiveSheet()->setCellValue('AQ'.$i, $key);
                $spreadsheet->getActiveSheet()->setCellValue('B'.$i, intval($dataFinal[$key]['matricula']));
                $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $dataFinal[$key]['nomeAlu']);

                $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AQ'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFA0A0A0');
            }              


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
              $spreadsheet->getActiveSheet()->getStyle('F3:AQ3')->applyFromArray($styleArray);

              //alguns styles estou usando fora do vetor -- mas seria de suma importância fazer dentro de um vetor
              $spreadsheet->getActiveSheet()->getStyle('F4:F7')->getAlignment()->setTextRotation(-90)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
              $spreadsheet->getActiveSheet()->getStyle('AQ4:AQ7')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
              $spreadsheet->getActiveSheet()->getStyle('AQ5:AQ7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
              $spreadsheet->getActiveSheet()->getStyle('AQ5')->getFont()->setUnderline(true);
              $spreadsheet->getActiveSheet()->getStyle('A1:E5')->getBorders()->getAllborders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
              $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AQ'.$i)->getBorders()->getAllborders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
              $spreadsheet->getActiveSheet()->getStyle('A'.$i.':B'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
              $spreadsheet->getActiveSheet()->getStyle('AQ'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
              $spreadsheet->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
              $spreadsheet->getActiveSheet()->getStyle('F1:AQ1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
              $spreadsheet->getActiveSheet()->getStyle('AQ7')->getBorders()->getAllborders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                 
              //incremento I para ir para a próxima linha
              $i++;
            }

            //---------------------------TABELA 2------------------------------
              
            //Mesclo as células e os styles determinando as linhas  partir do meu contador $i
            $j= $i+1;

            $i++;
            $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
            $spreadsheet->getActiveSheet()->mergeCells('F'.$i.':H'.$i);
            $spreadsheet->getActiveSheet()->mergeCells('I'.$i.':AQ'.$i);
            $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AQ'.$i)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('F'.$i.':H'.$i)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('F'.$i.':H'.$i)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $i++;
            $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
            $spreadsheet->getActiveSheet()->mergeCells('F'.$i.':H'.$i);
            $spreadsheet->getActiveSheet()->mergeCells('I'.$i.':AQ'.$i);
            $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AQ'.$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('F'.$i.':H'.$i)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('F'.$i.':H'.$i)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            
            $i++;
            $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':AN'.$i);
            $spreadsheet->getActiveSheet()->mergeCells('AO'.$i.':AQ'.$i);
            $spreadsheet->getActiveSheet()->getStyle('AO'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $i++;
            $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':AN'.$i);
            
            $i++;
            $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':AN'.$i);
            $spreadsheet->getActiveSheet()->mergeCells('AO'.$i.':AQ'.$i);
            $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AQ'.$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        
           

            //Insiro os dados na tabela
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, 'Horário: ');
            $spreadsheet->getActiveSheet()->setCellValue('F'.$j, 'Chefe do Departamento');
            $spreadsheet->getActiveSheet()->setCellValue('I'.$j, 'Professor(es):'.' SIAPE'.' - NOME');
            
            $j++;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, 'Local: ');

            $j++;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, 'Mensagem: _Matricula Inicial.');
            $spreadsheet->getActiveSheet()->setCellValue('AO'.$j, $now->dateNow());

            $j++;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, '                  _Não permita a presença de alunos não relaciondos, salvos autorizados pelo DAE');

            $j++;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, '                  _Site do DAE: www.dae.ufsc.br; Fórum da Graduação: www.forumgrad.ufsc.br');
            $spreadsheet->getActiveSheet()->setCellValue('AO'.$j, 'Núcleo de Processamento de Dados');

            $sheet = $spreadsheet->getActiveSheet();
            $drawing->setWorksheet($spreadsheet->getActiveSheet());

            $this->donwload($spreadsheet, $dataFinal[$key]['disciplina']);     
        }

        public function donwload($spreadsheet, $archiveName)
        {
          $archiveName = trim($archiveName);

            //Forço um donwload no formato xls

            //header('Content-Type: application/vnd.ms-excel');
            //header("Content-Disposition: attachment; filename=\"{$archiveName}\".xls" );
            //header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('..\view\upload\excel'.DIRECTORY_SEPARATOR.$archiveName.'.xls'); 
          
            exit;
        }
    }

?>