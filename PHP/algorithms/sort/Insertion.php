<?php


namespace Algorithms\sort;

class Insertion extends AbstractSort
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

        for ($i = 0; $i < $len; $i++) {
            $pre_i = $i - 1;
            $current = $arr[$i];
            while ($pre_i >= 0 && $arr[$pre_i] > $current) {
                $arr[$pre_i + 1] = $arr[$pre_i];
                $pre_i -= 1;
            }
            $arr[$pre_i + 1] = $current;
        }

        return $arr;
    }
}
