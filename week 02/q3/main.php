<?php
require_once "vendor/autoload.php";
use BikeStore\Bike;
use BikeStore\BikeProvider;
use BikeStore\Clock;
use BikeStore\BikeStore;





//testing.....
$bike1=new Bike("1","ali","perfect");
$bike2=new Bike("2","asghar","perfect");
$provider=new BikeProvider([$bike1,$bike2]);
$clock=new Clock();
$bikeStore=new BikeStore($provider,$clock,50);
$borrowedBikes=$bikeStore->borrow();
$borrowedBikes=$bikeStore->borrow();
echo "<pre>";
var_dump($borrowedBikes);
echo "</pre>";
$bikeStore->restore($bike2,true);
$bikeStore->restore($bike1,false);
$borrowedBikes=$bikeStore->borrow();
echo "<pre>";
var_dump($borrowedBikes);
echo "</pre>";
$borrowedBikes=$bikeStore->borrow();
echo "<pre>";
var_dump($borrowedBikes);
echo "</pre>";
