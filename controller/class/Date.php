<?php

    class Date
    {
        private $date;

        public function dateNow()
        {
            $now = new DateTime( 'now', new DateTimeZone( 'America/Sao_Paulo') );
            
            return $now->format( "d/m/Y H:i:s" );
        }

        public function intervalo($data1, $data2)
        {
            $data1 = new DateTime($data1);
            $data2 = new DateTime($data2);
            
            for ($i=$data1=>format("Y/m/d"); $i <= $data1=>format("Y/m/d"); $i = $data1->modify('+1 weekday')) 
            {  
              $dataFinal[] = 
              [   
                  'disciplina' => $data[$key]['disciplina'],
                  'numDis' => $data[$key]['numDis'],
                  'matricula' => $data[$key]['matricula'],
                  'nomeAlu' => $data[$key]['nomeAlu']
              ];
            }

            $data->modify('+1 ');
            echo $data->format('d-m-Y H:i:s');

            return $now->format( "d/m/Y H:i:s" );
        }
    }

?>