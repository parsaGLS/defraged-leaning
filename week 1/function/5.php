<?php
function is_lowercase($input) {
    if (strtolower($input)==$input){
        return true;
    }else{
        return false;
    }
}


echo is_lowercase("asdadfsd")?"yes":"no";




?>

