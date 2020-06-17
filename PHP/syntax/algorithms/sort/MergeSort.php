<?php

// todo
function merge_sort($nums)
{
    if (count($nums) <= 1) {
        return $nums;
    }

    merge_sort_c($nums, 0, count($nums) - 1);
    return $nums;
}

// 递归
function merge_sort_c(&$nums, $p, $r)
{
    if ($p >= $r) {
        return;
    }

    $q = floor(($p + $r) / 2);
    merge_sort_c($nums, $p, $q);
    merge_sort_c($nums, $q + 1, $r);

    merge($nums, ['start' => $p, 'end' => $q], ['start' => $q + 1, 'end' => $r]);
}

function merge(&$nums, $nums_p, $nums_q)
{
    $temp = [];
    $i = $nums_p['start'];
    $j = $nums_q['start'];
    $k = 0;
    while ($i <= $nums_p['end'] && $j <= $nums_q['end']) {
        if ($nums[$i] <= $nums[$j]) {
            $temp[$k++] = $nums[$i++];
        } else {
            $temp[$k++] = $nums[$j++];
        }
    }

    if ($i <= $nums_p['end']) {
        for (; $i <= $nums_p['end']; $i++) {
            $temp[$k++] = $nums[$i];
        }
    }

    if ($j <= $nums_q['end']) {
        for (; $j <= $nums_q['end']; $j++) {
            $temp[$k++] = $nums[$j];
        }
    }

    for ($x = 0; $x < $k; $x++) {
        $nums[$nums_p['start'] + $x] = $temp[$x];
    }
}

$nums = [4, 5, 6, 3, 2, 1];
$nums = merge_sort($nums);
print_r($nums);