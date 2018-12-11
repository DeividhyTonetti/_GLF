<?php

    require '../model/vendor/autoload.php'; // depois colocar director

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    class Xls
    {
      //criar metodos pivados para alterar as informações de size e style word
        public function printTable($data, $siape, $name, $date1, $date2)
        {
            $newDate = new Date();
            $vectorDate = $newDate->intervalo($date1, $date2);

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
                $spreadsheet->getActiveSheet()->mergeCells('G4:G7');
                $spreadsheet->getActiveSheet()->mergeCells('H4:H7');
                $spreadsheet->getActiveSheet()->mergeCells('I4:I7');
                $spreadsheet->getActiveSheet()->mergeCells('J4:J7');
                $spreadsheet->getActiveSheet()->mergeCells('K4:K7');
                $spreadsheet->getActiveSheet()->mergeCells('L4:L7');
                $spreadsheet->getActiveSheet()->mergeCells('M4:M7');
                $spreadsheet->getActiveSheet()->mergeCells('N4:N7');
                $spreadsheet->getActiveSheet()->mergeCells('O4:O7');
                $spreadsheet->getActiveSheet()->mergeCells('P4:P7');
                $spreadsheet->getActiveSheet()->mergeCells('Q4:Q7');
                $spreadsheet->getActiveSheet()->mergeCells('R4:R7');
                $spreadsheet->getActiveSheet()->mergeCells('S4:S7');
                $spreadsheet->getActiveSheet()->mergeCells('T4:T7');
                $spreadsheet->getActiveSheet()->mergeCells('U4:U7');
                $spreadsheet->getActiveSheet()->mergeCells('V4:V7');
                $spreadsheet->getActiveSheet()->mergeCells('W4:W7');
                $spreadsheet->getActiveSheet()->mergeCells('X4:X7');
                $spreadsheet->getActiveSheet()->mergeCells('Y4:Y7');
                $spreadsheet->getActiveSheet()->mergeCells('Z4:Z7');
                $spreadsheet->getActiveSheet()->mergeCells('AA4:AA7');
                $spreadsheet->getActiveSheet()->mergeCells('AB4:AB7');
                $spreadsheet->getActiveSheet()->mergeCells('AC4:AC7');
                $spreadsheet->getActiveSheet()->mergeCells('AD4:AD7');
                $spreadsheet->getActiveSheet()->mergeCells('AE4:AE7');
                $spreadsheet->getActiveSheet()->mergeCells('AF4:AF7');
                $spreadsheet->getActiveSheet()->mergeCells('AG4:AG7');
                $spreadsheet->getActiveSheet()->mergeCells('AH4:AH7');
                $spreadsheet->getActiveSheet()->mergeCells('AI4:AI7');
                $spreadsheet->getActiveSheet()->mergeCells('AJ4:AJ7');
                $spreadsheet->getActiveSheet()->mergeCells('AK4:AK7');
                $spreadsheet->getActiveSheet()->mergeCells('AL4:AL7');
                $spreadsheet->getActiveSheet()->mergeCells('AM4:AM7');
                $spreadsheet->getActiveSheet()->mergeCells('AN4:AN7');
                $spreadsheet->getActiveSheet()->mergeCells('AO4:AO7');
                $spreadsheet->getActiveSheet()->mergeCells('AP4:AP7');

                $spreadsheet->getActiveSheet()->mergeCells('F3:AQ3');
                
                //Insiro dados nas células
                $spreadsheet->getActiveSheet()->setCellValue('F1', 'LISTA DE FREQUÊNCIA    -   Semestre - '.$_SESSION['semestre']);
                $spreadsheet->getActiveSheet()->setCellValue('A6', $data[$key]['nomeDis']);
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

                // Continuo inserindo os dados, mas agora faço o tratamento para a data
                
                $spreadsheet->getActiveSheet()->setCellValue('F4',  $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('G4', $vectorDate['1']);
                $spreadsheet->getActiveSheet()->setCellValue('H4', $vectorDate['2']);
                $spreadsheet->getActiveSheet()->setCellValue('I4', $vectorDate['3']);
                $spreadsheet->getActiveSheet()->setCellValue('J4', $vectorDate['4']);
                $spreadsheet->getActiveSheet()->setCellValue('K4', $vectorDate['5']);
                $spreadsheet->getActiveSheet()->setCellValue('L4', $vectorDate['6']);
                $spreadsheet->getActiveSheet()->setCellValue('M4', $vectorDate['7']);
                $spreadsheet->getActiveSheet()->setCellValue('N4', $vectorDate['8']);
                $spreadsheet->getActiveSheet()->setCellValue('O4', $vectorDate['9']);
                $spreadsheet->getActiveSheet()->setCellValue('P4', $vectorDate['10']);
                $spreadsheet->getActiveSheet()->setCellValue('Q4', $vectorDate['11']);
                $spreadsheet->getActiveSheet()->setCellValue('R4', $vectorDate['12']);
                $spreadsheet->getActiveSheet()->setCellValue('S4', $vectorDate['13']);
                $spreadsheet->getActiveSheet()->setCellValue('T4', $vectorDate['14']);
                $spreadsheet->getActiveSheet()->setCellValue('U4', $vectorDate['15']);
                $spreadsheet->getActiveSheet()->setCellValue('V4', $vectorDate['16']);
                $spreadsheet->getActiveSheet()->setCellValue('W4', $vectorDate['17']);
                $spreadsheet->getActiveSheet()->setCellValue('X4', $vectorDate['18']);
                $spreadsheet->getActiveSheet()->setCellValue('Y4', $vectorDate['19']);
                $spreadsheet->getActiveSheet()->setCellValue('Z4', $vectorDate['20']);

                $spreadsheet->getActiveSheet()->setCellValue('AA4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AB4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AC4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AD4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AE4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AF4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AG4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AH4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AI4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AJ4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AK4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AL4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AM4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AN4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AO4', $vectorDate['0']);
                $spreadsheet->getActiveSheet()->setCellValue('AP4', $vectorDate['0']);
                

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
                $spreadsheet->getActiveSheet()->getStyle('F4:AP7')->getAlignment()->setTextRotation(-90)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
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
            //$spreadsheet->getActiveSheet()->setCellValue('A'.$j, 'Horário: '.$hours);
            $spreadsheet->getActiveSheet()->setCellValue('F'.$j, 'Chefe do Departamento');
            $spreadsheet->getActiveSheet()->setCellValue('I'.$j, 'Professor(es):'.$siape.' - '. $name);
            
            $j++;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, 'Local: ');

            $j++;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, 'Mensagem: _Matricula Inicial.');
            $spreadsheet->getActiveSheet()->setCellValue('AO'.$j, $newDate->dateNow());

            $j++;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, '                  _Não permita a presença de alunos não relaciondos, salvos autorizados pelo DAE');

            $j++;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, '                  _Site do DAE: www.dae.ufsc.br; Fórum da Graduação: www.forumgrad.ufsc.br');
            $spreadsheet->getActiveSheet()->setCellValue('AO'.$j, 'Núcleo de Processamento de Dados');

            $sheet = $spreadsheet->getActiveSheet();
            $drawing->setWorksheet($spreadsheet->getActiveSheet());

            //-----------********************************CRIA UMA NOVA ABA*****************************---------------
            $worksheet1 = $spreadsheet->createSheet();
            $drawing1 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            
            $worksheet1->setTitle('Verso');
            $worksheet1->getTabColor()->setRGB('FFFFFF');
            $spreadsheet->setActiveSheetIndex(1);
            
            //Inserimos a imagem
            $drawing1->setName('logoUFSC2');
            $drawing1->setDescription('logoUFSC2');
            $drawing1->setPath('../view/img/Universidade2.png');
            $drawing1->setCoordinates('A1');
            $drawing1->getShadow()->setVisible(true);

            //---------------------------TABELA 1 NOVA ABA------------------------------
            $j = 9;

            //Mesclo as células
            $spreadsheet->getActiveSheet()->mergeCells('A1:K5');
            $spreadsheet->getActiveSheet()->mergeCells('A6:C6');
            $spreadsheet->getActiveSheet()->mergeCells('D6:E6');
            $spreadsheet->getActiveSheet()->mergeCells('F6:I6');
            $spreadsheet->getActiveSheet()->mergeCells('J6:K6');
            $spreadsheet->getActiveSheet()->mergeCells('A7:K7');

            for ($i=8; $i <=46 ; $i++) 
            { 
                $spreadsheet->getActiveSheet()->mergeCells('N'.$i.':O'.$i);
            }

            //Insiro dados nas células
            $spreadsheet->getActiveSheet()->setCellValue('A6', 'Disciplina: '.$dataFinal[$key]['disciplina']);
            $spreadsheet->getActiveSheet()->setCellValue('D6', 'Turma: '.$data[$key]['numDis']);
            $spreadsheet->getActiveSheet()->setCellValue('F6', 'Horas Aula: ');
            $spreadsheet->getActiveSheet()->setCellValue('J6', 'Aulas: ');
            $spreadsheet->getActiveSheet()->setCellValue('A7', 'CONTROLE DE AVALIAÇÕES: ');
            $spreadsheet->getActiveSheet()->setCellValue('A8', 'Ordem');

            $spreadsheet->getActiveSheet()->setCellValue('B8', 'Matrícula');
            $spreadsheet->getActiveSheet()->setCellValue('C8', '1');
            $spreadsheet->getActiveSheet()->setCellValue('D8', '2');
            $spreadsheet->getActiveSheet()->setCellValue('E8', '3');
            $spreadsheet->getActiveSheet()->setCellValue('F8', '4');
            $spreadsheet->getActiveSheet()->setCellValue('G8', '5');
            $spreadsheet->getActiveSheet()->setCellValue('H8', '6');
            $spreadsheet->getActiveSheet()->setCellValue('I8', '7');
            $spreadsheet->getActiveSheet()->setCellValue('J8', '8');
            $spreadsheet->getActiveSheet()->setCellValue('K8', 'N. Final');

            // Costruimos um array para setar os estilos de linha, font, borda, cores, alinhamento etc..
            
            $styleTab1 = [
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
                ]
            ];

            $styleTab2 = [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ]
                ]
            ];
            
            $spreadsheet->getActiveSheet()->getStyle('A6:C6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFA0A0A0');
            $spreadsheet->getActiveSheet()->getStyle('A6:C6')->getBorders()->getAllborders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('D6:K6')->applyFromArray($styleTab1);
            $spreadsheet->getActiveSheet()->getStyle('A7:K7')->applyFromArray($styleTab1);
            $spreadsheet->getActiveSheet()->getStyle('A8:K8')->applyFromArray($styleTab1);

            foreach($dataFinal as $key => $value)
            {
                $spreadsheet->getActiveSheet()->setCellValue('A'.$j, $key);
                $spreadsheet->getActiveSheet()->getStyle('A'.$j.':K'.$j)->applyFromArray($styleTab2);
                $spreadsheet->getActiveSheet()->setCellValue('B'.$j, intval($dataFinal[$key]['matricula']));
                
                $j++;
            }

            //---------------------------TABELA 2 NOVA ABA------------------------------

            //Seto as laguras das colunas
            $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(40);
            $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(37);

            //Mesclo as células
            $spreadsheet->getActiveSheet()->mergeCells('N1:O1');
            $spreadsheet->getActiveSheet()->mergeCells('M2:N2');
            $spreadsheet->getActiveSheet()->mergeCells('M4:N4');
            $spreadsheet->getActiveSheet()->mergeCells('M5:N5');
            $spreadsheet->getActiveSheet()->mergeCells('N7:O7');
            
            //Insiro dados nas células
            $spreadsheet->getActiveSheet()->setCellValue('N1', 'LISTA DE FREQUÊNCIA    -     Semestre: '.$_SESSION['semestre']);
            $spreadsheet->getActiveSheet()->setCellValue('M3', 'Horário do Prof. para Atendimento aos Alunos (Extraclasse)');
            $spreadsheet->getActiveSheet()->setCellValue('M4', 'Dia da semana: ');
            $spreadsheet->getActiveSheet()->setCellValue('M5', 'Nome do Monitor: ');
            $spreadsheet->getActiveSheet()->setCellValue('O3', 'Horários/Locais');
            $spreadsheet->getActiveSheet()->setCellValue('O4', 'AQUI VAI O HORARIO');
            $spreadsheet->getActiveSheet()->setCellValue('O5', 'AQUI VAI O LOCAL');
            $spreadsheet->getActiveSheet()->setCellValue('M7', 'Datas');
            $spreadsheet->getActiveSheet()->setCellValue('N7', 'Conteúdo Programático estabelecido no Plano de Ensino');

            //Pegamos o Array anterior para estilizar alguns parametros
            $spreadsheet->getActiveSheet()->getStyle('M7:O7')->applyFromArray($styleTab1);
            
            //Estilizmos (NEGRITO)
            $spreadsheet->getActiveSheet()->getStyle('M3:N5')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('O3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('O3:O5')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('M8:O46')->applyFromArray($styleTab2); 

            //---------------------------TABELA 3 NOVA ABA------------------------------

            //Seto a altura da coluna
            //$spreadsheet->getActiveSheet()->getRowDimension('47')->setRowHeight(3);
            $k = $j+1;
            $l = $k+3;

            //Mesclo as células
            $spreadsheet->getActiveSheet()->mergeCells('A'.$k.':B'.$k);
            $spreadsheet->getActiveSheet()->mergeCells('C'.$k.':C'.$l);
            $spreadsheet->getActiveSheet()->mergeCells('D'.$k.':D'.$l);
            $spreadsheet->getActiveSheet()->mergeCells('E'.$k.':E'.$l);
            $spreadsheet->getActiveSheet()->mergeCells('F'.$k.':F'.$l);
            $spreadsheet->getActiveSheet()->mergeCells('G'.$k.':G'.$l);
            $spreadsheet->getActiveSheet()->mergeCells('H'.$k.':H'.$l);
            $spreadsheet->getActiveSheet()->mergeCells('I'.$k.':I'.$l);
            $spreadsheet->getActiveSheet()->mergeCells('J'.$k.':J'.$l);
            $spreadsheet->getActiveSheet()->mergeCells('K'.$k.':K'.$l);

            for ($i = 48; $i <= 51; $i++) 
            { 
                $spreadsheet->getActiveSheet()->mergeCells('M'.$i.':N'.$i);
            }

            //Estilizmos
            $spreadsheet->getActiveSheet()->getStyle('C'.$k.':L'.$l)->getAlignment()->setTextRotation(-90)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A'.$k.':K'.$l)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            //Insiro dados nas células
            $spreadsheet->getActiveSheet()->setCellValue('A'.$k, 'Data das Avaliações: ');
            $spreadsheet->getActiveSheet()->setCellValue('C'.$k, '-');
            $spreadsheet->getActiveSheet()->setCellValue('D'.$k, '-');
            $spreadsheet->getActiveSheet()->setCellValue('E'.$k, '-');
            $spreadsheet->getActiveSheet()->setCellValue('F'.$k, '-');
            $spreadsheet->getActiveSheet()->setCellValue('G'.$k, '-');
            $spreadsheet->getActiveSheet()->setCellValue('H'.$k, '-');
            $spreadsheet->getActiveSheet()->setCellValue('I'.$k, '-');
            $spreadsheet->getActiveSheet()->setCellValue('J'.$k, '-');
            $spreadsheet->getActiveSheet()->setCellValue('K'.$k, '-');

            //---------------------------TABELA 4 NOVA ABA------------------------------

            //Estilizmos
            $spreadsheet->getActiveSheet()->getStyle('O48')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('O48')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('M48')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('M48:O51')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            //Insiro dados nas células
            $spreadsheet->getActiveSheet()->setCellValue('O48', 'Pag. 1');
            $spreadsheet->getActiveSheet()->setCellValue('M48', 'Observações:');
            $spreadsheet->getActiveSheet()->setCellValue('M49', 'Nota 1: ');
            $spreadsheet->getActiveSheet()->setCellValue('M50', 'Nota 2: ');
            $spreadsheet->getActiveSheet()->setCellValue('M51', 'Nota 3: ');

            $drawing1->setWorksheet($spreadsheet->getActiveSheet());
            $spreadsheet->setActiveSheetIndex(0);
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