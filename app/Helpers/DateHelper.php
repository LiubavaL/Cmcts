<?php

namespace App\Helpers;
use Carbon\Carbon;

class DateHelper{
    
    private $timestampMask = 'Y-m-d H:i:s';

    public function humanFormat($date){
        $created = Carbon::createFromFormat($this->timestampMask,$date);

        return $created->diffForHumans();
    }

    public function moreThanDays($date, $days ){
        $created = Carbon::createFromFormat($this->timestampMask, $date);
        $now = Carbon::now();

        return $now->diffInDays($created) <= $days;
    }

    public function fdyFormat($date){
        return date_format($date, 'F d, Y');
    }
}