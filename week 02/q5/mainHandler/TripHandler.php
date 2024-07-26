<?php

namespace mainHandler;
require_once "./vendor/autoload.php";
use method\{BikeTripMethod,EconomicTripMethod,VipTripMethod};
use Exception;
use parameter\TripParam;

class TripHandler
{
    private static $_instance = null;
    private function  __construct() { }
    private function  __clone() { }
    public static function getInstance()
    {
        if( !is_object(self::$_instance) )
            self::$_instance = new TripHandler();
        return self::$_instance;
    }
    public function calcPrice (string $type,TripParam $param):float{
        if ($type==="bike"){
            return (new BikeTripMethod())->calcPrice($param);
        }elseif ($type==="vip"){
            return (new VipTripMethod())->calcPrice($param);
        }elseif ($type==="economic"){
            return (new EconomicTripMethod())->calcPrice($param);
        }else{
            throw new Exception("Unknown trip type");
        }

    }

}
