<?php

function binary_search($nums, $num)
{
    return binary_search_internal($nums, $num, 0, count($nums) - 1);
}

function binary_search_internal($nums, $num, $low, $high)
{
    if ($low > $high) {
        return -1;
    }

    $mid = floor(($low + $high) / 2);
    if ($num > $nums[$mid]) {
        return binary_search_internal($nums, $num, $mid + 1, $high);
    } elseif ($num < $nums[$mid]) {
        return binary_search_internal($nums, $num, $low, $mid - 1);
    } else {
        return $mid;
    }

    /**
     * 二分查找变形版：查找第一个值等于给定值的元素（数组中包含重复数据）
     */
//    if ($num < $nums[$mid]) {
//        return binary_search_internal($nums, $num, $low, $mid - 1);
//    } elseif ($num > $nums[$mid]) {
//        return binary_search_internal($nums, $num, $mid + 1, $high);
//    } else {
//        if ($mid == 0 || $nums[$mid-1] != $num) {
//            return $mid;
//        } else {
//            return binary_search_internal($nums, $num, $low, $mid - 1);
//        }
//    }
    // 在给定已排序序列中查找最后一个等于给定值的元素
//    if ($num < $nums[$mid]) {
//        return binary_search_internal($nums, $num, $low, $mid - 1);
//    } elseif ($num > $nums[$mid]) {
//        return binary_search_internal($nums, $num, $mid + 1, $high);
//    } else {
//        if ($mid == count($nums) - 1 || $nums[$mid + 1] != $num) {
//            return $mid;
//        } else {
//            return binary_search_internal($nums, $num, $mid + 1, $high);
//        }
//    }

}

$nums = [1, 2, 3, 4, 5, 6];
$index = binary_search($nums, 5);
print $index;
