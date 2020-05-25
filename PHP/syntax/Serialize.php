<?php

$arr = array(
  array(
    'uid' => 22193123,
    'gender' => 'famale',
    'username' => 'elarity',
    'password' => md5('www123'),
    'relation' => array(
      array(
        'uid' => 22193123,
        'gender' => 'famale',
        'username' => 'elarity',
        'password' => md5('www123'),
      ),
      array(
        'uid' => 22193123,
        'gender' => 'famale',
        'username' => 'elarity',
        'password' => md5('www123'),
      ),
      array(
        'uid' => 22193123,
        'gender' => 'famale',
        'username' => 'elarity',
        'password' => md5('www123'),
      ),
      array(
        'uid' => 22193123,
        'gender' => 'famale',
        'username' => 'elarity',
        'password' => md5('www123'),
      ),
      array(
        'uid' => 22193123,
        'gender' => 'famale',
        'username' => 'elarity',
        'password' => md5('www123'),
      ),
      array(
        'uid' => 22193123,
        'gender' => 'famale',
        'username' => 'elarity',
        'password' => md5('www123'),
      ),
      array(
        'uid' => 22193123,
        'gender' => 'famale',
        'username' => 'elarity',
        'password' => md5('www123'),
      ),
      array(
        'uid' => 22193123,
        'gender' => 'famale',
        'username' => 'elarity',
        'password' => md5('www123'),
      ),
      array(
        'uid' => 22193123,
        'gender' => 'famale',
        'username' => 'elarity',
        'password' => md5('www123'),
      ),
    ),
  )
);
// 每种序列化方案都执行100000次
$counter = 100000;

// json序列化方案，执行100000次
echo PHP_EOL.PHP_EOL;
$start = microtime(true);
for ($i = 1; $i <= $counter; $i++) {
    $json = json_encode($arr);
}
$size = strlen($json);
$end = microtime(true);
$cost_time = $end - $start;
echo "json_encode : 耗费时间为{$cost_time} , 数据体积为{$size}".PHP_EOL;

// jsond序列化方案，执行100000次
// $start = microtime(true);
// for ($i = 1; $i <= $counter; $i++) {
//     $jsond = jsond_encode($arr);
// }
// $size = strlen($jsond);
// $end = microtime(true);
// $cost_time = $end - $start;
// echo "jsond_encode : 耗费时间为{$cost_time} , 数据体积为{$size}".PHP_EOL;

// serialize序列化方案，执行100000次
$start = microtime(true);
for ($i = 1; $i <= $counter; $i++) {
    $serialize = serialize($arr);
}
$size = strlen($serialize);
$end = microtime(true);
$cost_time = $end - $start;
echo "serialize : 耗费时间为{$cost_time} , 数据体积为{$size}".PHP_EOL;

// msgpack序列化方案，执行100000次
$start = microtime(true);
for ($i = 1; $i <= $counter; $i++) {
    $msgpack = msgpack_pack($arr);
}
$size = strlen($msgpack);
$end = microtime(true);
$cost_time = $end - $start;
echo "msgpack : 耗费时间为 : {$cost_time} , 数据体积为{$size}".PHP_EOL;
echo PHP_EOL.PHP_EOL;
