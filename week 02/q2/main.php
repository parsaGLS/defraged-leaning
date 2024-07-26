<?php
require_once 'vendor/autoload.php';
use app\Validation;


//testing....
Validation::input("abcd5","codemeli,alphabet,email,number,alphaNum,phoneNum,length:5",true);




