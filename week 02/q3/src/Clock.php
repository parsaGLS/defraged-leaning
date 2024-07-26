<?php

namespace BikeStore;

class Clock
{


    public function getCurrentTime(){
        return time();

    }
    public function getReturnTime($borrowedTime, $expireTime) {
        return $borrowedTime + $expireTime;
    }

    public function getReturnDay($returnTime) {
        return date('Y-m-d', $returnTime);
    }

    public function getReturnHour($returnTime) {
        return date('H:i:s', $returnTime);
    }



}
