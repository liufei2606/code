<?php


namespace Algorithms\sort;


class Selection extends AbstractSort
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

        foreach ($arr as $i => $iValue) {
            $min_i = $iValue;
            $index = $i;
            $min_j = $i + 1;
            for ($j = $min_j; $j < $len; $j++) {
                if ($arr[$j] < $min_i) {
                    $min_i = $arr[$j];
                    $index = $j;
                }
            }
            if ($i < $index) {
                $arr = self::array_swap($arr, $i, $index);
            }
        }

        return $arr;
    }

}
