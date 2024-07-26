<?php

namespace method;
require_once "./vendor/autoload.php";
require_once "TripMethod.php";
use parameter\TripParam;
class BikeTripMethod extends TripMethod
{
    public function calcPrice (TripParam $param):float{
        $firstMult=$this->map[$param->initialPoint][$param->destinationPoint];
        $secMult=1;
        if ($param->rainy && $param->traffic){
            $secMult=1.5;
        }elseif (!$param->rainy && !$param->traffic){
            $secMult=1;
        }elseif($param->rainy){
            $secMult=0.8;
        }else{
            $secMult=2;
        }
        return $firstMult*$secMult*10000;
    }
}
