<?php

    class Date
    {
        private $date;

        public function dateNow()
        {

            $now = new DateTime( 'now', new DateTimeZone( 'America/Sao_Paulo') );
            
            return $now->format( "d/m/Y H:i:s" );
        }
    }

?>