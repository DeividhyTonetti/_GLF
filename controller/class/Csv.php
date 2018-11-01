<?php

    ini_set('default_charset','ISO 8859-1');
    
    class Csv
    {
        public function importar($siape, $name, $hours, $date1, $date2, $archive)
        {
            $meuArray = Array();
            $dir = "../view/upload/txt/";
           
            if (move_uploaded_file($archive["tmp_name"], $dir.$archive["name"]))
            { 
                $file = fopen($dir.$archive["name"], 'r');
            }

            while(($line = fgetcsv($file, 1000, "*")) !== false)
            {
                foreach ($line as $key) 
                {
                    $dados = explode(";", $key);
                }

                if(!is_numeric(filter_var($dados[0], FILTER_SANITIZE_NUMBER_INT)) and $dados[0] != "Alunos_Matriculados" and !empty($dados[0]) and $dados[0] != "  _________________________________________________")
                {
                    $disciplina[] = $dados[0];
                }

                if(!empty($dados[2]) and !empty($dados[3]) and !empty($dados[4]))
                {     
                    $data[] = 
                    [
                        'numDis' => $dados[2],
                        'matricula' => $dados[3],
                        'nomeAlu' => $dados[4]
                    ];
                } 
            }

            $html = '
            <!DOCTYPE html>
                <html lang="PT-BR" >
        
                    <head>
                        <meta charset="UTF-8">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
                        <link rel="stylesheet" href="view/css/style.css">
                    </head>
                    <body>
                        <form class="form">';
                        foreach ($disciplina as $key => $value) 
                        {
                            $html.='
                            <div class="inputGroup">
                                <input id="option'.$key.'" name="option'.$key.'" type="checkbox"/>
                                <label for="option'.$key.'">'.$disciplina[$key].'</label>
                            </div>
                            ';
                        }

                        $html .= '</form>
                        <div style="max-width: 600px; margin: 24px auto;">
                        <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">           
                    </body>              
            </html>
          ';
          
          echo $html;
          $this->tratarDados($disciplina, $data, $siape, $name, $hours, $date1, $date2, $archive);
        }

        public function tratarDados($disciplina, $data, $siape, $name, $hours, $date1, $date2, $archive)
        {  
            $xls = new Xls();
            $i = 0;

            foreach ($data as $key => $value) 
            {   
                if(empty($data[$key+1]['numDis']))
                {
                    $var1 = 0;
                }
                else
                {
                   $var1 = $data[$key+1]['numDis']; 
                }

                if($data[$key]['numDis'] != $var1)
                {   
                    $dataFinal[] = 
                    [   
                        'disciplina' => $disciplina[$i],
                        'numDis' => $data[$key]['numDis'],
                        'matricula' => $data[$key]['matricula'],
                        'nomeAlu' => $data[$key]['nomeAlu']
                    ];

                    $xls->printTable($dataFinal, $siape, $name, $hours, $date1, $date2);
                    $dataFinal = array();
                    $i++;
                }
                else
                {
                    $dataFinal[] = 
                    [   
                        'disciplina' => $disciplina[$i],
                        'numDis' => $data[$key]['numDis'],
                        'matricula' => $data[$key]['matricula'],
                        'nomeAlu' => $data[$key]['nomeAlu']
                    ];
                }
            }
            
            fclose($file);
        }
    }

?>