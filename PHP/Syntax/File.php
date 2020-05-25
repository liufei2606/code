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

file_put_contents('test1.txt', '你好');  // 快速写入内容到文件 test.txt（不存在则自动创建）
$content = file_get_contents('test1.txt');
var_dump($content);

$file = fopen('test2.txt', 'w');   // 以写入模式打开文件 test2.txt，不存在则创建自动创建
fwrite($file, '你好，');   // 通过 fwrite 写入内容到文件
fwrite($file, ' world！');  // 继续写入
fclose($file);  // 关闭这个文件句柄

$file = fopen('test2.txt', 'r');  // 只读模式打开 test2.txt 文件
$content = '';
while (!feof($file)) {    // 还没有到文件末尾，则继续读取
    $content .= fread($file, 1024);   // 通过 fread 读取指定字节内容
}
fclose($file);
var_dump($content);

// 删除上述文件
unlink('test1.txt');
unlink('test2.txt');