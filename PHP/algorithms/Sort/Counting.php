<?php


namespace Algorithms\Search\Sort;

class Counting extends AbstractSort
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

        $count = $sorted = [];
        $min = min($arr);
        $max = max($arr);
        for ($i = 0; $i < $len; $i++) {
            $count[$arr[$i]] = isset($count[$arr[$i]]) ? $count[$arr[$i]] + 1 : 1;
        }
        for ($j = $min; $j <= $max; $j++) {
            while (isset($count[$j]) && $count[$j] > 0) {
                $sorted[] = $j;
                $count[$j]--;
            }
        }

        return $sorted;
    }
}
