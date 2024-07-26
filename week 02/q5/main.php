<?php

require_once "vendor/autoload.php";
use mainHandler\TripHandler;
use parameter\TripParam;





//testing .....


$tripHandeler=TripHandler::getInstance();
echo $tripHandeler->calcPrice("vip",new TripParam(2,3,false,true));