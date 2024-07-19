<?php
function factorial($n){
    if ($n===0){
        return 1;
    }else{
        $output=1;
        for ($i=1;$i<=$n;$i++){
            $output*=$i;
        }
        return $output;
    }
}



echo factorial(5);
?>