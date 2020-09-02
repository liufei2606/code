<?php

namespace Algorithms\sort;

class Quick extends AbstractSort
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
        $left = $right = [];

        for ($i = 1; $i < $len; $i++) {
            if ($arr[$i] < $arr[0]) {
                $left[] = $arr[$i];
            } else {
                $right[] = $arr[$i];
            }
        }
        $left = self::sort($left);
        $right = self::sort($right);

        return array_merge($left, [$arr[0]], $right);
    }
}
