<?php

// 日志调试方法

/**
 * 超级调试
 *
 * 调试非本地环境或分布式环境，通过Log查看变量传递
 * 写入变量值到\var\log\php_super_debug.log
 * @param  mixed  $data     日志数据
 * @param  string $log_path 日志路径
 * @param  string $log_name 日志名称
 * @return void
 */
function super_debug($data, $log_path='\var\log\', $log_name='debug')
{
  error_log(json_encode($data, JSON_UNESCAPED_UNICODE)."\n", 3, $log_path.$log_name);
}
// php实现下载图片

header('Content-type: image/jpeg');
header('Content-Disposition: attachment; filename=download_name.jpg');
readfile($yourFilePath);
