<?php

ini_set('display_errors', 1);
//error_reporting(E_ALL);
error_reporting(E_ALL ^ E_WARNING);

/**
 * 自定义错误处理器
 *
 * @param $errno    int 错误级别
 * @param $errstr   string 错误信息
 * @param $errfile  string 错误文件
 * @param $errline  int   错误行号
 */
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    // 该级别错误不报告的话退出
    if (!(error_reporting() & $errno)) {
        return;
    }
    $logDir = __DIR__."/..".DIRECTORY_SEPARATOR.'logs';
    if (!file_exists($logDir)) {
        mkdir($logDir);
    }
    $logFile = $logDir.DIRECTORY_SEPARATOR.'err.log';

//    logger("%file% %level% %message%", ["level" => "warning", "message" => "This is a message", "file" => __FILE__]);
    switch ($errno) {
        case E_ERROR:
            error_log("[致命错误]:[".date('Y-m-d H:i:s', time())."]_[$errno] $errstr", 3, $logFile);
            break;
        case E_WARNING:
            error_log("[警告]:[".date('Y-m-d H:i:s', time())."]_[$errno] $errstr", 3, $logFile);
            break;
        case E_NOTICE:
            error_log("[通知]:[".date('Y-m-d H:i:s', time())."]_[$errno] $errstr", 3, $logFile);
            break;
        default:
            echo "[未知错误类型]:[".date('Y-m-d H:i:s', time())."]_[$errno] $errstr\n";
            break;
    }
}

//set_error_handler("myErrorHandler");
$ctx = stream_context_create(array(
        'http' => array(
            'timeout' => 1
        )
    )
);
try {
    $context = file_get_contexts('https://bluebird89.com/error', 0., $ctx);

} catch (Error $e) {
    var_dump($e);
}


