<?php

$redis = new Redis();

/**
 * 获取锁
 * @param  String  $key    锁标识
 * @param  Int     $expire 锁过期时间
 * @return Boolean
 */
function lock($key = '', $expire = 5)
{
    $is_lock = $this->_redis->setnx($key, time()+$expire);
    //不能获取锁
    if (!$is_lock) {
        //判断锁是否过期
        $lock_time = $this->_redis->get($key);
        //锁已过期，删除锁，重新获取
        if (time() > $lock_time) {
            unlock($key);
            $is_lock = $this->_redis->setnx($key, time() + $expire);
        }
    }

    return $is_lock? true : false;
}

/**
 * 释放锁
 * @param  String  $key 锁标识
 * @return Boolean
 */
function unlock($key = '')
{
    return $this->_redis->del($key);
}

// 定义锁标识
$key = 'Test_bihu_lock';

// 获取锁
$is_lock = lock($key, 10);
if ($is_lock) {
    echo 'get lock success<br>';
    echo 'do sth..<br>';
    sleep(5);
    echo 'success<br>';
    unlock($key);
} else { //获取锁失败
    echo 'request too frequently<br>';
}
