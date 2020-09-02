<?php


namespace Algorithms\sort;

class Merge extends AbstractSort
{
    public static function sort(array $arr)
    {
        if (!is_array($arr)) {
            return false;
        }
        $len = count($arr);
        if ($len <= 1) {
            return $arr;
        }

        $mid = $len >> 1;
        $left = array_slice($arr, 0, $mid);
        $right = array_slice($arr, $mid);
        static::sort($left);
        static::sort($right);
        if (end($left) <= $right[0]) {
            $arr = array_merge($left, $right);
        } else {
            for ($i = 0, $j = 0, $k = 0; $k <= $len - 1; $k++) {
                if ($i >= $mid && $j < $len - $mid) {
                    $arr[$k] = $right[$j++];
                } elseif ($j >= $len - $mid && $i < $mid) {
                    $arr[$k] = $left[$i++];
                } elseif ($left[$i] <= $right[$j]) {
                    $arr[$k] = $left[$i++];
                } else {
                    $arr[$k] = $right[$j++];
                }
            }
        }

        return $arr;
    }
}
