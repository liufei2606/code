<?php
// 通过二维数组生成九九乘法表
$multi = [];
for ($j = 0; $j < 9; $j++) {
    for ($i = 0; $i < 9; $i++) {
        $n1 = $i + 1;
        $n2 = $j + 1;
        if ($n1 < $n2) {  // 摒除重复的记录
            continue;
        }
        $multi[$i][$j] = sprintf("%dx%d=%d", $n2, $n1, $n1 * $n2);
    }
}

// 打印九九乘法表
foreach ($multi as $row) {
    foreach ($row as $item) {
        printf("%-8s", $item);  // 位宽为8，左对齐
    }
    printf("\n");
}

//step into
// add watch