<?php

    class Order
    {
        public function orderVector($dataFinal)
        {
            
            usort($dataFinal, array($this, "cmp"));
            
            return $dataFinal;
        }

        private function cmp($a, $b) 
        {
            return $a['nomeAlu'] > $b['nomeAlu'];
        }
        
    }

?>