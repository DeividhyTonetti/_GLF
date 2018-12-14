<?php

    require '../model/vendor/autoload.php'; // depois colocar director

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    class Xls
    {
      //criar metodos pivados para alterar as informações de size e style word
        public function printTable($data, $siape, $name, $date1, $date2, $opt1, $opt2)
        {
            $newDate = new Date();
            $datEnd = $newDate->intervalo($date1, $date2, $opt1, $opt2);

            $arquivo = 'planilha.xls';
            $i = 8;
            $l = 0;
            $p = 1;
            $z = 1;

            $spreadsheet = new Spreadsheet();
            $writer = new Xlsx($spreadsheet);
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $spreadsheet->getProperties()->setTitle('Gerador de Lista de Frequência');
            $spreadsheet->getProperties()->setCreator("Deividhy J. Tonetti");
            $spreadsheet->getActiveSheet()->setTitle('Frente');

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
                $spreadsheet->getDefaultStyle()->getFont()->setSize(9);

                //Seto as laguras das colunas
                $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(38);
                $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
                $spreadsheet->getActiveSheet()->getColumnDimension('AU')->setWidth(8);

                foreach(range('F', 'Z') as $column) 
                {
                    $spreadsheet->getActiveSheet()->getColumnDimension($column)->setWidth(2.88);
                }

                foreach(range('A', 'T') as $column) 
                {
                    $spreadsheet->getActiveSheet()->getColumnDimension('A'.$column)->setWidth(2.88);
                }
               
                //Seto a altura da linha
                $spreadsheet->getActiveSheet()->getRowDimension('7')->setRowHeight(27.75);

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
                $spreadsheet->getActiveSheet()->mergeCells('F1:AU2');
                $spreadsheet->getActiveSheet()->mergeCells('F3:AU3');
                $spreadsheet->getActiveSheet()->mergeCells('A1:E5');
                $spreadsheet->getActiveSheet()->mergeCells('A6:B6');
                $spreadsheet->getActiveSheet()->mergeCells('D6:E6');

                //Mesclo as células
                foreach(range('F', 'Z') as $mesc) 
                {
                    $spreadsheet->getActiveSheet()->mergeCells($mesc.'4:'.$mesc.'7');
                }
    
                foreach(range('A', 'T') as $mesc) 
                {
                    $spreadsheet->getActiveSheet()->mergeCells('A'.$mesc.'4:'.'A'.$mesc.'7');
                }
                
                //Insiro dados nas células
                $spreadsheet->getActiveSheet()->setCellValue('F1', 'LISTA DE FREQUÊNCIA    -   Semestre - '.$_SESSION['semestre']);
                $spreadsheet->getActiveSheet()->setCellValue('A6', $data[$key]['nomeDis']);
                $spreadsheet->getActiveSheet()->setCellValue('C6', $dataFinal[$key]['disciplina']);
                $spreadsheet->getActiveSheet()->setCellValue('D6', 'Turma:'.$data[$key]['numDis']);
                $spreadsheet->getActiveSheet()->setCellValue('AU5', 'Pág.');
                $spreadsheet->getActiveSheet()->setCellValue('AU6', '1');
                $spreadsheet->getActiveSheet()->setCellValue('AU7', 'Ordem');
                $spreadsheet->getActiveSheet()->setCellValue('A7', 'Ordem');
                $spreadsheet->getActiveSheet()->setCellValue('B7', 'Matrícula');
                $spreadsheet->getActiveSheet()->setCellValue('C7', 'Aluno');
                $spreadsheet->getActiveSheet()->setCellValue('D7', 'Nota');
                $spreadsheet->getActiveSheet()->setCellValue('E7', 'Freq.');
                $spreadsheet->getActiveSheet()->setCellValue('AT4', 'Total de Faltas');

                // Continuo inserindo os dados, mas agora faço o tratamento para a data
                
                foreach(range('F', 'Z') as $letter) 
                {
                    if(!empty($datEnd[$l]))
                    {
                        if($l<=21)
                        {
                            echo $letter.'4<br>';
                            $spreadsheet->getActiveSheet()->setCellValue($letter.'4', $datEnd[$l]);
                            $spreadsheet->getActiveSheet()->getStyle($letter.'4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                            
                            $l++;
                        }
                    }
                }

                foreach(range('A', 'S') as $letter1) 
                {
                    if(!empty($datEnd[$l]))
                    {
                        if($l<=39)
                        {
                            echo $letter.$letter1.'4<br>';
                            $spreadsheet->getActiveSheet()->setCellValue('A'.$letter1.'4', $datEnd[$l]);
                            $spreadsheet->getActiveSheet()->getStyle('A'.$letter1.'4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                            
                            $l++;
                        }    
                    }
                }
                
                //Vejp se meu índice i é par ou impar para pintar a cédula.
                if($i % 2 == 1)
                {
                    $this->paint($spreadsheet, $i, $key, $dataFinal);
                }
                else
                {
                    $this->paint($spreadsheet, $i, $key, $dataFinal);

                    $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AU'.$i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFA0A0A0');
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
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
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
                $spreadsheet->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle('AT'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle('A6:E7')->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('F3:AU3')->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('AT4:AT7')->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('F1:AU2')->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('AU7')->applyFromArray($styleArray);

                //alguns styles estou usando fora do vetor -- mas seria de suma importância fazer dentro de um vetor
                $spreadsheet->getActiveSheet()->getStyle('F4:AT7')->getAlignment()->setTextRotation(-90)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle('AU4:AU7')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $spreadsheet->getActiveSheet()->getStyle('AU5:AU7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle('AU5')->getFont()->setUnderline(true);
                $spreadsheet->getActiveSheet()->getStyle('A1:E5')->getBorders()->getAllborders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AU'.$i)->getBorders()->getAllborders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $spreadsheet->getActiveSheet()->getStyle('A'.$i.':B'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle('AU'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $spreadsheet->getActiveSheet()->getStyle('F1:AU2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle('AU7')->getBorders()->getAllborders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    
                //incremento I para ir para a próxima linha
                $i++;
            }

            //---------------------------TABELA 2------------------------------
              
            //Mesclo as células e os styles determinando as linhas  partir do meu contador $i
            $j= $i+1;

            $i++;
            $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':C'.$i); // local
            $spreadsheet->getActiveSheet()->mergeCells('D'.$i.':H'.$i); //Chefe
            $spreadsheet->getActiveSheet()->mergeCells('I'.$i.':AU'.$i); // professor
            $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AU'.$i)->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('F'.$i.':H'.$i)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('F'.$i.':H'.$i)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $i++;
            $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':E'.$i);
            $spreadsheet->getActiveSheet()->mergeCells('F'.$i.':H'.$i);
            $spreadsheet->getActiveSheet()->mergeCells('I'.$i.':AU'.$i);
            $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AU'.$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('F'.$i.':H'.$i)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            
            $i++;
            $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':AJ'.$i); // Mensagem Matricula Inicial
            $spreadsheet->getActiveSheet()->mergeCells('AK'.$i.':AU'.$i);// DATA E HORA
            $spreadsheet->getActiveSheet()->getStyle('AK'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $i++;
            $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':AH'.$i);
            
            $i++;
            $spreadsheet->getActiveSheet()->mergeCells('A'.$i.':AJ'.$i); // Site do DAE
            $spreadsheet->getActiveSheet()->mergeCells('AK'.$i.':AU'.$i); // Nucleo de processamento
            $spreadsheet->getActiveSheet()->getStyle('A'.$i.':AU'.$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        
            //Insiro os dados na tabela
            $spreadsheet->getActiveSheet()->setCellValue('F'.$j, 'Chefe do Departamento');
            $spreadsheet->getActiveSheet()->setCellValue('I'.$j, 'Professor(es):'.$siape.' - '. $name);
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, 'Local: ');
            
            $j+=2;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, 'Mensagem: _Matricula Inicial.');
            $spreadsheet->getActiveSheet()->setCellValue('AK'.$j, $newDate->dateNow());

            $j++;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, '                   _Não permita a presença de alunos não relaciondos, salvos autorizados pelo DAE');

            $j++;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$j, '                   _Site do DAE: www.dae.ufsc.br; Fórum da Graduação: www.forumgrad.ufsc.br');
            $spreadsheet->getActiveSheet()->setCellValue('AK'.$j, 'Núcleo de Processamento de Dados');

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
            $spreadsheet->getActiveSheet()->mergeCells('A1:I5'); // Logo
            $spreadsheet->getActiveSheet()->mergeCells('A6:C6'); // Disciplina
            $spreadsheet->getActiveSheet()->mergeCells('D6:E6'); // Turma
            $spreadsheet->getActiveSheet()->mergeCells('F6:G6'); // Horas Aula
            $spreadsheet->getActiveSheet()->mergeCells('H6:I6'); // Aulas
            $spreadsheet->getActiveSheet()->mergeCells('A7:I7'); // Controle 

            //Mesclo a células da 2ª coluna
            for ($i=8; $i <=46 ; $i++) 
            { 
                $spreadsheet->getActiveSheet()->mergeCells('K'.$i.':L'.$i);
            }

            //Insiro dados nas células
            $spreadsheet->getActiveSheet()->setCellValue('A6', 'Disciplina: '.$data[$key]['nomeDis']);
            $spreadsheet->getActiveSheet()->setCellValue('D6', 'Turma: '.$data[$key]['numDis']);
            $spreadsheet->getActiveSheet()->setCellValue('F6', 'Horas Aula: ');
            $spreadsheet->getActiveSheet()->setCellValue('H6', 'Aulas: ');
            $spreadsheet->getActiveSheet()->setCellValue('A7', 'CONTROLE DE AVALIAÇÕES: ');
            $spreadsheet->getActiveSheet()->setCellValue('A8', 'Ordem');

            $spreadsheet->getActiveSheet()->setCellValue('B8', 'Matrícula');
            foreach(range('C', 'H') as $mesc) 
            {
                $spreadsheet->getActiveSheet()->setCellValue($mesc.'8', $p);

                $p++;
            }
            $spreadsheet->getActiveSheet()->setCellValue('I8', 'N. Final');

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
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(10.50);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(39);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(11.50);

            //Mesclo as células
            $spreadsheet->getActiveSheet()->mergeCells('J1:L2');
            $spreadsheet->getActiveSheet()->mergeCells('J3:K3');
            $spreadsheet->getActiveSheet()->mergeCells('J4:K4');
            $spreadsheet->getActiveSheet()->mergeCells('J5:K5');
            $spreadsheet->getActiveSheet()->mergeCells('K7:L7');
            
            //Insiro dados nas células
            $spreadsheet->getActiveSheet()->setCellValue('J1', 'LISTA DE FREQUÊNCIA    -     Semestre: '.$_SESSION['semestre']);
            $spreadsheet->getActiveSheet()->setCellValue('J3', 'Horário p/ Atendimento');
            $spreadsheet->getActiveSheet()->setCellValue('J4', 'Dia da semana: ');
            $spreadsheet->getActiveSheet()->setCellValue('J5', 'Nome do Monitor: ');
            $spreadsheet->getActiveSheet()->setCellValue('L3', 'Horários/Locais');
            $spreadsheet->getActiveSheet()->setCellValue('L4', 'AQUI VAI O HORARIO');
            $spreadsheet->getActiveSheet()->setCellValue('L5', 'AQUI VAI O LOCAL');
            $spreadsheet->getActiveSheet()->setCellValue('J7', 'Datas');
            $spreadsheet->getActiveSheet()->setCellValue('K7', 'Conteúdo Programático estabelecido no Plano de Ensino');

            for ($q=8; $q <= 21; $q++) 
            { 
                foreach(range('F', 'Z') as $inser) 
                {
                    $spreadsheet->getActiveSheet()->setCellValue('J'.$q,'=Frente!'.$inser.'4');
                    $q++;
                }
            }

            for ($q=22; $q <= 40; $q++) 
            { 
                foreach(range('A', 'S') as $inser) 
                {
                    $spreadsheet->getActiveSheet()->setCellValue('J'.$q,'=Frente!A'.$inser.'4');
                    $q++;
                }
            }  

            //Pegamos o Array anterior para estilizar alguns parametros
            $spreadsheet->getActiveSheet()->getStyle('C7:L7')->applyFromArray($styleTab1);
            $spreadsheet->getActiveSheet()->getStyle('J1')->applyFromArray($styleArray);
            
            //Estilizmos (NEGRITO)
            $spreadsheet->getActiveSheet()->getStyle('J3:L5')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('L3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('L3:L5')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('J8:L46')->applyFromArray($styleTab2);
            $spreadsheet->getActiveSheet()->getStyle('J3:L2')->applyFromArray($styleArray); 

            //---------------------------TABELA 3 NOVA ABA------------------------------

            //Seto a altura da coluna
            //$spreadsheet->getActiveSheet()->getRowDimension('47')->setRowHeight(3);
            $k = $j+1;
            $l = $k+3;

            //Mesclo as células
            $spreadsheet->getActiveSheet()->mergeCells('A'.$k.':B'.$l);

            foreach(range('C', 'H') as $mesc1) 
            {
                $spreadsheet->getActiveSheet()->mergeCells($mesc1.$k.':'.$mesc1.$l);
            }

            for ($i = 49; $i <= 51; $i++) 
            { 
                $spreadsheet->getActiveSheet()->mergeCells('M'.$i.':N'.$i);
            }

            //Estilizmos
            $spreadsheet->getActiveSheet()->getStyle('C'.$k.':H'.$l)->getAlignment()->setTextRotation(-90)->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A'.$k.':H'.$l)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('A6:E7')->applyFromArray($styleArray);
            //Insiro dados nas células
            $spreadsheet->getActiveSheet()->setCellValue('A'.$k, 'Data das Avaliações: ');
            
            foreach(range('C', 'H') as $letter) 
            { 
                $spreadsheet->getActiveSheet()->setCellValue($letter.$k, '-');
                $spreadsheet->getActiveSheet()->getStyle($letter.$k)->applyFromArray($styleArray); 
            }

            //---------------------------TABELA 4 NOVA ABA------------------------------

            //Mesclamos
            $spreadsheet->getActiveSheet()->mergeCells('J48:L48');
            foreach(range('K', 'L') as $mesc2) 
            {
                $spreadsheet->getActiveSheet()->mergeCells($mesc2.'48:'.$mesc2.'48');
            } 

            //Estilizmos
            $spreadsheet->getActiveSheet()->getStyle('K48')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('K48')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('J48:L48')->getBorders()->getAllborders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $spreadsheet->getActiveSheet()->getStyle('J48')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('J48:L51')->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            //Insere e estiliza
            for ($u = 49; $u < 52; $u++) 
            { 
                $spreadsheet->getActiveSheet()->getStyle('J'.$u)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->setCellValue('J'.$u, 'Nota'.$z.':');
                $z++;
            }

            //Insiro dados nas células
            $spreadsheet->getActiveSheet()->setCellValue('J48', 'Observações:');

            $drawing1->setWorksheet($spreadsheet->getActiveSheet());
            $spreadsheet->setActiveSheetIndex(0);
            $this->donwload($spreadsheet, $dataFinal[$key]['disciplina']); 
        }

        //Função estática para incluir as formulas e uma parte do código repetido.
        private static function paint($spreadsheet, $i, $key, $dataFinal)
        {
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $key);
            $spreadsheet->getActiveSheet()->setCellValue('AU'.$i, $key);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$i, intval($dataFinal[$key]['matricula']));
            $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $dataFinal[$key]['nomeAlu']);

            $spreadsheet->getActiveSheet()->setCellValue('AT'.$i,'=SUM(F'.$i.':AS'.$i.')*2');
            $spreadsheet->getActiveSheet()->setCellValue('E'.$i,'=IF(AT'.$i.'<=18,"FS","FI")');
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