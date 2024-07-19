<?php
function is_palindrome($input)
{
if ($input==strrev($input)){
    return true;
}else{
    return false;
}
}

echo is_palindrome("abac")?"yes":"no";




?>