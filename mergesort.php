<?php

function mergeSort($array) {
    if (count($array) <= 1) {
        return $array;
    }

    $middle = floor(count($array) / 2);
    $left = mergeSort(array_slice($array, 0, $middle));
    $right = mergeSort(array_slice($array, $middle));

    return merge($left, $right);
}

function merge($left, $right) {
    $result = [];
    while (count($left)>0 &&count($right)>0) {
        if ($left[0]<=$right[0]) {
            $result[] = array_shift($left);
        } else {
            $result[] = array_shift($right);
        }
    }
    return array_merge($result, $left, $right);
}

echo json_encode([
    mergeSort([5, 3, 8, 6, 2])
]);