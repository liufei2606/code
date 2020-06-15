<?php

/**
 * 插入排序实现函数（PHP）：，
 * 取未排序区间中的元素：正序遍历每个元素
 * 在已排序区间中找到合适的插入位置将其插入：逆向对比前面的每个元素，j>i:互换，i《=i跳出循环
 *
 * @param $nums
 *
 * @return mixed
 */
$nums = [4, 5, 6, 3, 2, 1];
for ($i = 0, $iMax = count($nums); $i < $iMax; $i++) {
    $value = $nums[$i];

    for ($j = $i - 1; $j >= 0; $j--) {
        if ($nums[$j] > $value) {
            $nums[$j + 1] = $nums[$j];
        } else {
            break;
        }
    }
    $nums[$j + 1] = $value;
}
echo implode("", $nums);