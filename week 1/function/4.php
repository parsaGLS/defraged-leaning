<?php
function sortArray ($input)
{
   sort($input);
   echo "<pre>";
   echo var_dump($input);
   echo "<pre>";
}
$cars = array("Volvo", "BMW", "Toyota");

sortArray($cars);
sortArray(array(100,8,50));

?>