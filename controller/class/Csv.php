<?php

    ini_set('default_charset','ISO 8859-1');
    
    class Csv
    {
        public function importar()
        {

            $xls = new Xls();
            $meuArray = Array();
            $i = 0;
            
            $file = fopen('../view/upload/relatorio.txt', 'r');

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

                    $xls->printTable($dataFinal);
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