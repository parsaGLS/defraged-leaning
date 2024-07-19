<?php
$number="887744";
for ($i=0; $i<strlen($number); $i++){
    $character = $number[$i];
    echo $character.': ';
    for ($j=0; $j<$character; $j++){
        echo $character;
    }
    echo '<br>';
}
?>