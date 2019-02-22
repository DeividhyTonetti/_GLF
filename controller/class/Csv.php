<?php

    header('Content-Type: text/html; charset=UTF-8');
    
    class Csv
    {
        public function importar($siape, $name, $date1, $date2, $archive)
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
                
                if(is_numeric(filter_var($dados[0], FILTER_SANITIZE_NUMBER_INT)) and $dados[0] != "Alunos_Matriculados" and !empty($dados[0]) and $dados[0] != "  _________________________________________________")
                {
                    $semestreAno = $dados[0];
                    $ano = substr($semestreAno, 0, 4);
                    $semestre = substr($semestreAno, -2);

                    $semestre = $ano."/".$semestre;
                }

                if(!empty($dados[1]) and !empty($dados[2]) and !empty($dados[3]) and !empty($dados[4]))
                {     
                    $data[] = 
                    [
                        'nomeDis'=> $dados[1],
                        'numDis' => $dados[2],
                        'matricula' => $dados[3],
                        'nomeAlu' => $dados[4]
                    ];
                } 
            }

            
            $html = '
            
            <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
                    <link rel="stylesheet" href="view/css/style.css">
                    <meta http-equiv="Content-Language" content="pt-br">
                </head>
                    <body>
                        <form class="form">';
                        foreach ($disciplina as $key => $value) 
                        { 
                            $_SESSION['options'] = "option".$key;
                            $html.='
                            <div class="inputGroup">
                                <input id="option'.$key.'" name="option'.$key.'" type="checkbox" onclick="mudarEstado'.$key.'('."'minhaDiv".$key."'".')"/>
                                <label for="option'.$key.'">'.$disciplina[$key].'</label>
                            </div>
                            
                            <div id = "minhaDiv'.$key.'" style = "display: none;"" class="name form-group">
                                <div>    
                                    <label>Entre com o Dia e a Hora: </label>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div>
                                            <select name = "op1[]" class="name form-control" id = "option1">
                                                <option value = "0">DIA</option> 
                                                <option value = "2"> Segunda</option> 
                                                <option value = "3"> Terça</option>
                                                <option value = "4"> Quarta</option> 
                                                <option value = "5"> Quinta</option> 
                                                <option value = "6"> Sexta</option> 
                                            </select>
                                            <input id="hours1" type = "time" name = "hours[]" value = "" class="name form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <select name = "op2[]" class="name form-control" id = "option2">
                                                <option value = "0">DIA</option> 
                                                <option value = "2"> Segunda</option> 
                                                <option value = "3"> Terça</option>
                                                <option value = "4"> Quarta</option> 
                                                <option value = "5"> Quinta</option> 
                                                <option value = "6"> Sexta</option>  
                                            </select>
                                            <input id="hour2" type = "time" name = "hours1[]" value = "" class="name form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        }

                        $html .= '<input type="hidden" name="tratar" value="tratar">
                            <input type="hidden" name="importar" value="">
                        </form>
                        <div style="max-width: 600px; margin: 24px auto;">
                        <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">           
                    </body>              
            </html>
          ';
        
          $_SESSION['data'] = $data;
          $_SESSION['disciplina'] = $disciplina;
          $_SESSION['semestre'] = $semestre;

          //aqui vou ter que passar a data para verificar no jquery
         echo $html;
        }

        public function tratarDados($disciplina, $data, $siape, $name, $date1, $date2, $archive, $hours1, $hours2, $opt1, $opt2)
        {  
            $xls = new Xls();
            $order = new Order();
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
                        'nomeDis' => $data[$key]['nomeDis'],
                        'numDis' => $data[$key]['numDis'],
                        'matricula' => $data[$key]['matricula'],
                        'nomeAlu' => $data[$key]['nomeAlu'],
                        'hours1' => $hours1[$i],
                        'hours1' => $hours2[$i]
                    ];

                    $dataFinal = $order->orderVector($dataFinal);
                    
                    $xls->printTable($dataFinal, $siape, $name, $date1, $date2, $opt1, $opt2);
                    $dataFinal = array();
                    $i++;
                }
                else
                {
                    $dataFinal[] = 
                    [   
                        'disciplina' => $disciplina[$i],
                        'nomeDis' => $data[$key]['nomeDis'],
                        'numDis' => $data[$key]['numDis'],
                        'matricula' => $data[$key]['matricula'],
                        'nomeAlu' => $data[$key]['nomeAlu'],
                        'hours' => $hours1[$i]
                    ];
                }
            }
        }
    }

?>