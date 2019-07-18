<?php
use Swoole\Coroutine as co;

echo "Process start time:" . date('Ymd H:i:s') . PHP_EOL;
$workers = [];
$urls = [
    'http://baidu.com',
    'http://www.zhibo8.com',
    'https://www.v2ex.com',
    'https://techmeme.com',
];

$len = count($urls);
for ($i = 0; $i < $len; $i++) {
    $process = new swoole_process(function(swoole_process $worker) use($i, $urls){
        $content = curlData($urls[$i]);
        echo $content .PHP_EOL;
    }, true);
    $pid = $process->start();
    $workers[$pid] = $process;
}

foreach ($workers as $process) {
    echo $process->read();
}

function curlData ($url) {
    sleep(1);
    $content = file_get_contents($url);
    $filename = __DIR__ . '/data.txt';
    co::create(function () use ($filename, $content){
        $p =  co::writeFile($filename, json_encode($content), FILE_APPEND);
        var_dump($p);
    });
    return $url . ' suceess' . PHP_EOL;
}
echo "Process end time:" . date('Ymd H:i:s');
