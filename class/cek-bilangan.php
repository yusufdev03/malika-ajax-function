<?php

class CekBilangan
    {
        private $bilangan;
        
        public function __construct($bil)
        {
            $this->bilangan = $bil;
        }
        
        public function cekGenap()
        {
            if($this->bilangan % 2 == 0)
                return 1;
            else
                return 0;
        }
        
        public function cekGanjil()
        {
            if($this->bilangan % 2 == 1)
                return 1;
            else
                return 0;
        }
        
        public function cekPrima()
        {
            $prima = 0;
            $faktor = 0;
            
            for($i=1;$i<=$this->bilangan;$i++)
            {
                if($this->bilangan % $i == 0)
                {
                    $faktor++;
                    if(($faktor == 2) && ($i == $this->bilangan))
                    {
                        $prima = 1;
                    }
                    else if($faktor > 2)
                    {
                        $prima = 0;
                        break;
                    }
                }
            }
            return $prima;
        }
    }