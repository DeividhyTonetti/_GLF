<?php

    class Date
    {
        private $date;

        public function dateNow()
        {
            $now = new DateTime( 'now', new DateTimeZone( 'America/Sao_Paulo') );
            
            return $now->format( "d/m/Y H:i:s" );
        }

        public function intervalo($date1, $date2, $opt1, $opt2)
        {
            $date1 = new DateTime($date1);
            $date2 = new DateTime($date2);
            $vector[] = $date1->format("Y/m/d"); 

            foreach ($opt1 as $key => $value) 
            {   
                if($opt1[$key] == 0)
                {
                    unset($opt1[$key]);
                }

                if($opt2[$key] == 0)
                {
                    unset($opt2[$key]);
                }
            }

            if(!empty($opt1[0][0]))
            {
                $discI1 = $opt1[0][0];
                $discF1 = $opt2[0][0];
            }
            else
            {
                $discI1 = 0;
                $discF1 = 0;
            }

            if(!empty($opt1[1][0]))
            {
                $discI2 = $opt1[1][0];
                $discF2 = $opt2[1][0];
            }
            else
            {
                $discI2 = 0;
                $discF2 = 0;
            }

            if(!empty($opt1[2][0]))
            {
                $discI3 = $opt1[2][0];
                $discF3 = $opt2[2][0];
            }
            else
            {
                $discI3 = 0;
                $discF3 = 0;
            }

            if(!empty($opt1[3][0]))
            {
                $discI4 = $opt1[3][0];
                $discF4 = $opt2[3][0];
            }
            else
            {
                $discI4 = 0;
                $discF4 = 0;
            }

            if(!empty($opt1[4][0]))
            {
                $discI5 = $opt1[4][0];
                $discF5 = $opt2[4][0];
            }
            else
            {
                $discI5 = 0;
                $discF5 = 0;
            }

            if(!empty($opt1[5][0]))
            {
                $discI6 = $opt1[5][0];
                $discF6 = $opt2[5][0];
            }
            else
            {
                $discI6 = 0;
                $discF6 = 0;
            }

            if(!empty($opt1[6][0]))
            {
                $discI7 = $opt1[6][0];
                $discF7 = $opt2[6][0];
            }
            else
            {
                $discI7 = 0;
                $discF7 = 0;
            }

            if(!empty($opt1[7][0]))
            {
                $discI8 = $opt1[7][0];
                $discF8 = $opt2[7][0];
            }
            else
            {
                $discI8 = 0;
                $discF8 = 0;
            }

            if(!empty($opt1[8][0]))
            {
                $discI9 = $opt1[8][0];
                $discF9 = $opt2[8][0];
            }
            else
            {
                $discI9 = 0;
                $discF9 = 0;
            }

            if(!empty($opt1[9][0]))
            {
                $discI10 = $opt1[9][0];
                $discF10 = $opt2[9][0];
            }
            else
            {
                $discI10 = 0;
                $discF10 = 0;
            }

            return $day = $this->day($discI1, $discF1, $discI2, $discF2, $discI3, $discF3, $discI4, $discF4, $discI5, $discF5, $discI6, $discF6, $discI7, $discF7, $discI8, $discF8, $discI9, $discF9, $date1, $date2);
        }

        private function day($discI1, $discF1, $discI2, $discF2, $discI3, $discF3, $discI4, $discF4, $discI5, $discF5, $discI6, $discF6, $discI7, $discF7, $discI8, $discF8, $discI9, $discF9, $date1, $date2)
        {
            if(!empty($discI1) and $discI1 != 0)
            {
                $vector[0] = $this->week($discI1, $discF1);
            }

            if(!empty($discI2) and $discI2 != 0)
            {
                $vector[1] = $this->week($discI2, $discF2);
            }

            if(!empty($discI3) and $discI3 != 0)
            {
                $vector[2] = $this->week($discI3, $discF3);
            }

            if(!empty($discI4) and $discI4 != 0)
            {
                $vector[3] = $this->week($discI4, $discF4);
            }

            if(!empty($discI5) and $discI5 != 0)
            {
                $vector[4] = $this->week($discI5, $discF5);
            }

            if(!empty($discI6) and $discI6 != 0)
            {
                $vector[5] = $this->week($discI6, $discF6);
            }

            if(!empty($discI7) and $discI7 != 0)
            {
                $vector[6] = $this->week($discI7, $discF7);
            }

            if(!empty($discI8) and $discI8 != 0)
            {
                $vector[7] = $this->week($discI8, $discF8);
            }

            if(!empty($discI9) and $discI9 != 0)
            {
                $vector[8] = $this->week($discI9, $discF9);
            }

            if(!empty($discI10) and $discI10 != 0)
            {
                $vector[9] = $this->week($discI10, $discF10);
            }

            return $this->dateModify($vector, $date1, $date2);
        }

        private function week($x, $y)
        {
            if($x == $y)
            {
                return 7;
            }

            if($x == 2 and $y == 3)
            {
                return 1;
            }
            
            if($x == 2 and $y == 4)
            {
                return 2;
            }
            
            if($x == 2 and $y == 5)
            {
                return 3;
            }

            if($x == 2 and $y == 6)
            {
                return 4;
            }
            
            if($x == 3 and $y == 4)
            {
                return 1;
            }

            if($x == 3 and $y == 5)
            {
                return 2;
            }

            if($x == 3 and $y == 6)
            {
                return 3;
            }

            if($x == 4 and $y == 5)
            {
                return 1;
            }

            if($x == 4 and $y == 6)
            {
                return 2;
            }

            if($x == 5 and $y == 6)
            {
                return 1;
            }
        }

        private function dateModify($vector, $date1, $date2)
        {
            $datEnd[] = $date1->format( "d/m/Y");
            
            while($date1->format("Y/m/d") < $date2->format("Y/m/d")) 
            {  
                foreach ($vector as $key => $value) 
                {
                    $date1->modify('+'.$vector[$key].'day');
                    $datEnd[] = $date1->format( "d/m/Y" );

                    //Altero a data 7 - o número do dia da semana
                    $date1->sub( new DateInterval('P'.$vector[$key].'D'))->format('Y-m-d');
                    $date1->modify('+ 7 day');

                    $datEnd[] = $date1->format( "d/m/Y" );
                }
            }

            $datEnd[] = $date2->format("d/m/Y");

            return $datEnd;
        }
    }

?>