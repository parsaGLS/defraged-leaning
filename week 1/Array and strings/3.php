<?php
$input = '2020-01-01 02:30:40';
$date=explode(' ',$input);
$output=array_merge(explode('-',$date[0]),explode(':',$date[1]));


echo '<pre>';
var_dump($output);
echo '</pre>';


?>