<?php

/**
 * 选择排序算法实现
 */
$nums = [4, 5, 6, 3, 2, 1];

for ($i = 0, $iMax = count($nums); $i < $iMax; $i++) {
    $min = $i;
    for ($j = $i + 1; $j < $iMax; $j++) {
        if ($nums[$j] < $nums[$min]) {
            $min = $j;
        }
    }
    if ($min != $i) {
        $temp = $nums[$i];
        $nums[$i] = $nums[$min];
        $nums[$min] = $temp;
    }
}

echo implode("", $nums);