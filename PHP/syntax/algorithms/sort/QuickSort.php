<?php

function quick_sort($nums)
{
    if (count($nums) <= 1) {
        return $nums;
    }

    quick_sort_c($nums, 0, count($nums) - 1);
    return $nums;
}

function quick_sort_c(&$nums, $p, $r)
{
    if ($p >= $r) {
        return;
    }

    $q = partition($nums, $p, $r);
    quick_sort_c($nums, $p, $q - 1);
    quick_sort_c($nums, $q + 1, $r);
}

// 寻找pivot
function partition(&$nums, $p, $r)
{
    $pivot = $nums[$r];
    $i = $p;
    for ($j = $p; $j < $r; $j++) {
        // 原理：将比$pivot小的数丢到[$p...$i-1]中，剩下的[$i..$j]区间都是比$pivot大的
        if ($nums[$j] < $pivot) {
            $temp = $nums[$i];
            $nums[$i] = $nums[$j];
            $nums[$j] = $temp;
            $i++;
        }
    }

    // 最后将 $pivot 放到中间，并返回 $i
    $temp = $nums[$i];
    $nums[$i] = $pivot;
    $nums[$r] = $temp;

    return $i;
}

$nums = [4, 5, 6, 3, 2, 1];
$nums = quick_sort($nums);
print_r($nums);