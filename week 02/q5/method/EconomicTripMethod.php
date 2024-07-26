<?php

namespace method;
require_once "../vendor/autoload.php";
require_once "TripMethod.php";
use parameter\TripParam;
class EconomicTripMethod extends TripMethod
{
    public function calcPrice (TripParam $param):float{
        $firstMult=$this->map[$param->initialPoint][$param->destinationPoint];
        $secMult=1;
        if ($param->rainy && $param->traffic){
            $secMult=1.4;
        }elseif (!$param->rainy && !$param->traffic){
            $secMult=1;
        }else{
            $secMult=1.2;
        }
        return $firstMult*$secMult*5000;
    }
}
