<?php

/**
 * 日志调试方法
 *
 * 调试非本地环境或分布式环境，通过Log查看变量传递
 * 写入变量值到\var\log\php_super_debug.log
 * @param  mixed  $data     日志数据
 * @param  string $log_path 日志路径
 * @param  string $log_name 日志名称
 * @return void
 */
function super_debug($data, $log_path = '/var/log/', $log_name = 'debug.log')
{
    error_log('[' . time() . ']:' . json_encode($data, JSON_UNESCAPED_UNICODE)."\n", 3, $log_path.$log_name);
}
// super_debug(['name' => 'henry', 'time' => time()], './');

// php实现下载图片
$file_url = 'https://upload.chinaz.com/picmap/201811151633430899_60.jpg';
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
readfile($file_url); # 获取图片 base64

