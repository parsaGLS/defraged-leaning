<?php
$n=100;//input value
for ($i = 0; $i <= $n; $i++) {
    echo str_repeat("&ensp;", $n - $i) . str_repeat("*", 2 * $i + 1) . "<br>";
}

for ($i = $n - 1; $i >= 0; $i--) {
    echo str_repeat("&ensp;", $n - $i) . str_repeat("*", 2 * $i + 1) . "<br>";
}

?>

