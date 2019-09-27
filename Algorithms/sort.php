<?php

# 将大值冒泡到最后
# 针对所有的元素重复以上的步骤，除了后面已经排序的 持续每次对越来越少的元素重复上面的步骤

function bubbleSort($arr)
{
    $len = count($arr);
    # 范围
    for ($i = 0; $i < $len - 1; $i++) {
        for ($j = 0; $j < $len - 1 - $i; $j++) {
            # 操作
            if ($arr[$j] > $arr[$j+1]) {
                $tmp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $tmp;
            }
        }
    }
    return $arr;
}

# 选择排序:O(n²) 的时间复杂度,数据规模越小越好。唯一的好处可能就是不占用额外的内存空间
# 首先在未排序序列中找到最小（大）元素，存放到排序序列的起始位置。
# 再从剩余未排序元素中继续寻找最小（大）元素，然后放到已排序序列的末尾
function selectionSort($arr)
{
    $len = count($arr);
    for ($i = 0; $i < $len - 1; $i++) {
        # 标记位置
        $minIndex = $i;
        for ($j = $i + 1; $j < $len; $j++) {
            if ($arr[$j] < $arr[$minIndex]) {
                $minIndex = $j;
            }
        }

        $temp = $arr[$i];
        $arr[$i] = $arr[$minIndex];
        $arr[$minIndex] = $temp;
    }
    return $arr;
}

# 插入排序
function insertionSort($arr)
{
    $len = count($arr);
    for ($i = 1; $i < $len; $i++) {
        $preIndex = $i - 1;
        $current = $arr[$i];
        while ($preIndex >= 0 && $arr[$preIndex] > $current) {
            $arr[$preIndex+1] = $arr[$preIndex];
            $preIndex--;
        }
        $arr[$preIndex+1] = $current;
    }
    return $arr;
}
