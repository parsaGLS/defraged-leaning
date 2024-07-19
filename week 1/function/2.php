<?php
function is_prime($n) {
    if ($n<=3){
        return true;
    }else{
        $i=2;
        while($i*$i<=$n){
            if ($n%$i===0){
                return false;
            }
            $i++;
        }
        return true;
    }
}



echo is_prime(6)?"yes":"no";





?>