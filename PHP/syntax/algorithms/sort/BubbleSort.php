<?php

$nums = [
    4,
    5,
    6,
    3,
    2,
    1,
];
$iMax = count($nums);

/*
 * 冒泡：升序
 * 暂存首先重新赋值
 */
for ($i = 0; $i < $iMax; $i++) {
    $flag = false;
    for ($j = 0; $j < ($iMax - $i - 1); $j++) {
        if ($nums[$j] > $nums[($j + 1)]) {
            $tmp = $nums[$j];
            $nums[$j] = $nums[($j + 1)];
            $nums[($j + 1)] = $tmp;
            $flag = true;
        }
    }
    if (!$flag) {
        break;
    }
}
echo implode('', $nums).PHP_EOL;

for ($i = 0; $i < $iMax; $i++) {
    for ($j = ($i + 1); $j < $iMax; $j++) {
        if ($nums[$i] < $nums[$j]) {
            $tmp = $nums[$j];
            $nums[$j] = $nums[$i];
            $nums[$i] = $tmp;
        }
    }
}
echo implode('', $nums);
