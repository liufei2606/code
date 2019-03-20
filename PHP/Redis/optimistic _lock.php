<?php

$redis = new Redis();
$strKey = 'Test_bihu_age';

$redis->set($strKey, 10);

$age = $redis->get($strKey);

echo "---- Current Age:{$age} ---- <br/><br/>";

$redis->watch($strKey);

// 开启事务
$redis->multi();

//在这个时候新开了一个新会话执行
$redis->set($strKey, 30);  //新会话

echo "---- Current Age:{$age} ---- <br/><br/>"; //30

$redis->set($strKey, 20);

$redis->exec();

$age = $redis->get($strKey);

echo "---- Current Age:{$age} ---- <br/><br/>"; //30

//当exec时候如果监视的key从调用watch后发生过变化，则整个事务会失败
