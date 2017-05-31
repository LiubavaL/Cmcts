<?php

namespace App\Helpers;

class CountHelper{
    private $thousand = 'K';
    private $million = 'M';

    public function formatCut($count){
        $result = $count;

        if($count > 999 && $count < 1000000){
            $result =  intdiv($count, 1000);

            if($count % 1000 > 0){
                $result.=','.(intdiv(($count % 1000), 100));
            }

            $result.=$this->thousand;
        }elseif($count > 999999){
            //$result =  ($count / 1000000).','.(($count % 1000000) / 100000).$this->million;

            $result =  intdiv($count, 1000000);

            if($count % 1000000 > 0){
                $result.=','.(intdiv(($count % 1000000), 100000));
            }

            $result.=$this->million;
        }

        return $result;
    }

    public function formatFull($count)
    {
        $result = number_format($count);

        return $result;
    }
}