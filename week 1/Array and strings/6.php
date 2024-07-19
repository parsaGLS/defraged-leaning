<?php
$input=array ('c1' => 'Red', 'c2' => 'Green', 'c3' => 'White', 'c4' => 'Black');
$keys=array ('c2', 'c4');
$output=[];
foreach ($input as $k=>$v) {
    $flag=true;
    for($i=0;$i<count($keys);$i++) {
        if (strcmp($k, $keys[$i])==0){
           $flag=false;
        }
    }
    if ($flag) {
        $output[$k]=$v;
    }
}
echo "<pre>";
var_dump($output);
echo "<pre>";
?>