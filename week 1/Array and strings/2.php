<?php
$input="The quick brown fox";
$i=strlen($input);
$i--;
$count=0;
while ($input[$i]!=" "){
    $i-=1;
    $count++;
}
$count++;
$output=substr($input,0,strlen($input)-$count);
echo $output;
?>
