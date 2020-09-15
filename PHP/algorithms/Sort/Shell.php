<?php


namespace Algorithms\Sort;

class Shell extends AbstractSort
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

        $gap = 1;
        $pre_i = $len / 3;
        while ($gap < $pre_i) {
            $gap = $gap * 3 + 1;
        }

        while ($gap > 0) {
            for ($i = 0; $i < $len; $i++) {
                $temp = $arr[$i];
                $j = $i - $gap;

                while ($j >= 0 and $arr[$j] > $temp) {
                    $arr[$j + $gap] = $arr[$j];
                    $j -= $gap;
                }

                $arr[$j + $gap] = $temp;
            }

            $gap = floor($gap / 3);
        }

        return $arr;
    }
}
