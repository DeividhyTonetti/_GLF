<?php

    class Xls
    {
        public function printTable($data)
        {
            $arquivo = 'planilha.xls';

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
            $html = 
            '
                <!DOCTYPE html>
                  <html lang="PT-BR">
                  <head>
                    <meta charset="ISO 8859-1">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta http-equiv="x-ua-compatible" content="ie=edge">
                    <meta charset="ISO 8859-1">
                    <meta name="viewport" content="width=device-width, initial-scale=1">


                    <title>GLP</title>
        
                  </head>

                  <body class="hold-transition sidebar-mini">
                <table width="300px" border="1px" bordercolor="black">
                <tr>
                  <th class="tg-wvxr" colspan="5"><img src="../view/img/Universidade.png"  height="42" width="300"></th>
                  <th class="tg-ir8p" rowspan="3"></th>
                  <th class="tg-iu89" rowspan="2"><span style="font-weight:bold;text-decoration:underline">Pag.</span><br><span style="font-weight:bold">1</span></th>
                </tr>
                <tr>
                <td class="tg-xds7" colspan="2"></td>
                <td class="tg-g5qm">'.$dataFinal[$key]['disciplina'].'</td>
                <td class="tg-8rb3" colspan="2">Turma: <span style="font-weight:bold">'.$dataFinal[$key]['numDis'].'</span></td>
              </tr>
              <tr>
                <td class="tg-vhpi">Ordem</td>
                <td class="tg-4qi8"><span style="font-weight:bold">Matrícula</span></td>
                <td class="tg-e7lt">Aluno</td>
                <td class="tg-e7lt"> Nota</td>
                <td class="tg-vhpi">Freq.</td>
                <td class="tg-t2qg">Ordem</td>
              </tr>
            ';

            foreach($dataFinal as $key => $value)
            {
              $html .=
              '  <tr>
                  <td class="tg-kvd6">'.$key.'</td>
                  <td class="tg-rqvj">'.$dataFinal[$key]['matricula'].'</td>
                  <td class="tg-rqvj">'.$dataFinal[$key]['nomeAlu'].'</td>
                  <td class="tg-rqvj"></td>
                  <td class="tg-kvd6"></td>
                  <td class="tg-72fs"></td>
                  <td class="tg-kvd6">'.$key.'</td>
                </tr>
              ';
            }

            $html .= '</table>';

            //var_dump($html);
            $this->donwload($html, $dataFinal[$key]['disciplina']);

        }

        public function donwload($html, $arquivo)
        {
          $arquivo = trim($arquivo);

          // Configurações header para forçar o download

          header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
          header ("Content-Disposition: attachment; filename=\"{$arquivo}\".xls" );
          header("Cache-Control: max-age=0");
          // Envia o conteúdo do arquivo
          echo $html;
          exit;
        }
    }

?>