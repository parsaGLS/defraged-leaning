<?php
$a="football";
$b="footboll";
for ($i=0; $i<strlen($a); $i++) {
    if (!($a[$i]==$b[$i])) {
        echo "First difference between two strings at position &nbsp; ".$i ." &nbsp; \"$a[$i]\" VS \"$b[$i]\"";
    }
}
?>