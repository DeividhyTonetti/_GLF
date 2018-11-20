<?php

    class Order
    {
        public function orderVector($dataFinal)
        {
            
            usort($dataFinal, array($this, "cmp"));
            
            var_dump($dataFinal);
        }

        private function cmp($a, $b) 
        {
            return $a['nomeAlu'] > $b['nomeAlu'];
        }
        
    }

?>