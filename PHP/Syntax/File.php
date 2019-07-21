<?php

$handle = opendir('.');
while (false !== ($file = readdir($handle))) {
    $files[] = $file;
}
closedir($handle);
print_r($files);

if (!($fp = fopen('date.txt', 'w'))) {
    return;
}
fprintf($fp, "%04d-%02d-%02d", 2020, 4, 3); // 写入一个根据 format 格式化后的字符串到 由 handle 句柄打开的流中
