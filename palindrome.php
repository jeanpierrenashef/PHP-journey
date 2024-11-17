<?php

function isPalindrome($string){
    $length = strlen($string);
    for($i=0; $i<$length/2;$i++){
        if($string[$i]!==$string[$length-$i-1]){
            return false;
        }
    }
    return true;
}
echo json_encode([
    isPalindrome("radar")
]);