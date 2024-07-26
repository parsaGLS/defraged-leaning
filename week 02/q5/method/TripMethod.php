<?php
namespace method;
require_once "../vendor/autoload.php";
use parameter\TripParam;


abstract class TripMethod
{
    public array $map=[[1,2,2,4,3],[2,1,4,2,3],[3,5,1,3,2],[4,3,3,1,2],[3,3,2,2,1]];
    abstract public function calcPrice (TripParam $param):float;
}
