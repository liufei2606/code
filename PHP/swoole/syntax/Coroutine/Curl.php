<?php

use Swoole\Coroutine as co;

echo "Process start time:".date('Ymd H:i:s').PHP_EOL;
$workers = [];
$urls = [
    'http://baidu.com',
    'http://www.zhibo8.com',
    'https://www.v2ex.com',
    'https://techmeme.com',
];

$len = count($urls);
for ($i = 0; $i < $len; $i++) {
    $process = new swoole_process(function (swoole_process $worker) use ($i, $urls) {
        $context = curlData($urls[$i]);
        echo $context.PHP_EOL;
    }, true);
    $pid = $process->start();
    $workers[$pid] = $process;
}

foreach ($workers as $process) {
    echo $process->read();
}

function curlData($url)
{
    sleep(1);
    $context = file_get_contexts($url);
    $filename = __DIR__.'/data.txt';
    co::create(function () use ($filename, $context) {
        $p = co::writeFile($filename, json_encode($context), FILE_APPEND);
        var_dump($p);
    });
    return $url.' suceess'.PHP_EOL;
}

echo "Process end time:".date('Ymd H:i:s');
