<?php


namespace Algorithms\sort;

/**
 * Class Bubble
 * 冒泡排序:序列中的最大值插到已排序序列的最前面，这个过程就像冒泡一样
 *
 * @package Algorithms\sort
 */
class Bubble extends AbstractSort
{
    public static function sort($nums)
    {
        if (!is_array($nums)) {
            return false;
        }

        $len = count($nums);
        if ($len <= 1) {
            return $nums;
        }
        $iMax = count($nums);

        // 外层控制执行次数
        for ($i = 0; $i < $iMax; $i++) {
            //置位没有意义:n-i 次没有换位生效
//            $flag = false;
            // 内层比较范围[0 ~ n-i) j 与j+1 比较, 次数 n-1 n-2 1
            for ($j = 0; $j < ($iMax - $i - 1); $j++) {
                if ($nums[$j] > $nums[$j + 1]) {
                    self::arraySwap($nums, $j, $j + 1);
//                    $flag = true;
                }
            }
//            if (!$flag) {
//                break;
//            }
        }

        return $nums;
    }
}
