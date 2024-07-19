<?php
$input=array('A' => 'Blue', 'B' => 'Green', 'c' => 'Red');
$lowerCase=[];
$upperCase=[];
foreach($input as $k=>$v){
    $lowerCase[$k]=strtolower($v);
    $upperCase[$k]=strtoupper($v);
}

echo '<pre>';
var_dump($lowerCase);
echo '</pre>';

echo '<pre>';
var_dump($upperCase);
echo '</pre>';




?>