<?php


namespace Algorithms\Sort;

class Heap extends AbstractSort
{
    public static function sort(array $arr)
    {
        if (!is_array($arr)) {
            return false;
        }
        global $len;
        $len = count($arr);
        if ($len <= 1) {
            return $arr;
        }

        for ($i = $len; $i >= 0; $i--) {
            self::heapify($arr, $i);
        }

        return $arr;
    }

    public static function heapify($arr, $i)
    {
        $left = 2 * $i + 1;
        $right = 2 * $i + 2;
        $largest = $i;

        global $len;
        if ($left < $len && $arr[$left] > $arr[$largest]) {
            $largest = $left;
        }
        if ($right < $len && $arr[$right] > $arr[$largest]) {
            $largest = $right;
        }
        if ($largest != $i) {
            self::arraySwap($arr, $i, $largest);
            self::heapify($arr, $largest);
        }
    }
}
