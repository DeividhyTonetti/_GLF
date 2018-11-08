<?php

    class Date
    {
        private $date;

        public function dateNow()
        {
            $now = new DateTime( 'now', new DateTimeZone( 'America/Sao_Paulo') );
            
            return $now->format( "d/m/Y H:i:s" );
        }

        public function intervalo($date1, $date2)
        {
            $date1 = new DateTime($date1);
            $date2 = new DateTime($date2);
            
            while($date1->format("Y/m/d") < $date2->format("Y/m/d")) 
            {  
                $date1->modify('+7 day');
                $vector[] = $date1->format( "d/m/Y" );
            }

            return $vector;
        }

        private function semana()
        {
            $dias = array (0 => "Domingo", 1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado");
        }
    }

?>