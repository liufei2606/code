<?php


namespace Algorithms\sort;

class Bubble extends AbstractSort
{
    public static function sort($arr)
    {
        if (!is_array($arr)) {
            return false;
        }

        $len = count($arr);
        if ($len <= 1) {
            return $arr;
        }

        for ($i = 1; $i < $len; $i++) {
            $max_j = $len - $i;
            for ($j = 0; $j < $max_j; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    $arr = self::arraySwap($arr, $j, $j + 1);
                }
            }
        }

        return $arr;
    }
}
