<?php
$input="$123,34.00A";
$output=preg_replace("/[^0-9,\.]/","",$input);
echo $output;
?>