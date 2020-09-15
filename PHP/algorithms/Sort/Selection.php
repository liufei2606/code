<?php


namespace Algorithms\Sort;

class Selection extends AbstractSort
{
    public static function sort(array $nums)
    {
        if (!is_array($nums)) {
            return false;
        }
        $len = count($nums);
        if ($len <= 1) {
            return $nums;
        }

        $iMax = count($nums);
        for ($i = 0; $i < $iMax; $i++) {
            $min = $i;
            for ($j = $i + 1; $j < $iMax; $j++) {
                if ($nums[$j] < $nums[$min]) {
                    $min = $j;
                }
            }
            if ($min != $i) {
                static::arraySwap($nums, $i, $min);
            }
        }
        return $nums;
    }

    public static function sort2($nums)
    {
        $iMax = count($nums);
        for ($i = 0; $i < $iMax - 1; $i++) {
            for ($j = ($i + 1); $j < $iMax; $j++) {
                if ($nums[$i] > $nums[$j]) {
                    //前面逻辑一致，只要有小的就换位，上面方法标记最小 换位一次
                    self::arraySwap($nums, $i, $j);
                }
            }
        }

        return $nums;
    }

}
