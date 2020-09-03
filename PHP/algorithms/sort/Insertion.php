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
        for ($i = 1; $i < $len; $i++) {
            $j = $i - 1;
            $current = $arr[$i];
            // 循环不一样写法，思路一样，while 中可以叠加多个判断条件
            while ($j >= 0 && $arr[$j] > $current) {
                $arr[$j + 1] = $arr[$j];
                --$j;
            }
            $arr[$j + 1] = $current;
        }

        return $arr;
    }

    public static function sort1($nums)
    {
        // 取未排序区间中元
        for ($i = 1, $iMax = count($nums); $i < $iMax; $i++) {
            $value = $nums[$i];

            for ($j = $i - 1; $j >= 0; $j--) {
                if ($nums[$j] > $value) {
                    // a[j] 大于 value 后移一位
                    $nums[$j + 1] = $nums[$j];
                } else {
                    break;
                }
            }
            $nums[$j + 1] = $value;
        }

        return $nums;
    }
}
