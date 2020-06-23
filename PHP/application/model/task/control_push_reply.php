<?php
/**
 * 推送消息处理文件
 * Created by chris.
 * User: Administrator
 * Date: 2018/3/26
 * Time: 14:07
 */

//===================================push消息进程管理======================================================
//判断进行是否在跑
error_reporting(0);
//$cmd = 'ps aux | grep Controller/push.php';
$cmd = "ps aux|grep Controller/push.php| grep -v grep | awk '{print $2}'"; //提取运行的进程号
$push = shell_exec($cmd);
$push = trim($push);

//如果进程不存在  启动起来 让其在后台运行
if ($push == '' || empty($push)) {
    $cmd = "nohup /mnt/cdrom/ppcbin/php7/bin/php /mnt/cdrom/ppcbin/htdocs/apiswitch/App/Controller/push.php >> /mnt/cdrom/ppcbin/htdocs/apiswitch/App/Log/push_`date -d last-day +\%Y\%m`.log 2>&1 &";
    shell_exec($cmd);

    $cmd = "ps aux|grep Controller/push.php| grep -v grep | awk '{print $2}'"; //提取运行的进程号
    $push = shell_exec($cmd);
    $push = trim($push);
    echo 'push进程启动成功，push进程pid:' . $push . '，';
} else {
    echo 'push进程pid:' . $push . '，';
}

//===================================reply回复消息进程管理==================================================
//判断进行是否在跑
$cmd = "ps aux|grep Controller/reply.php| grep -v grep | awk '{print $2}'"; //提取运行的进程号
$reply = shell_exec($cmd);
$reply = trim($reply);

//如果进程不存在  启动起来 让其在后台运行
if ($reply == '' || empty($reply)) {
    $cmd = "nohup /mnt/cdrom/ppcbin/php7/bin/php /mnt/cdrom/ppcbin/htdocs/apiswitch/App/Controller/reply.php >> /mnt/cdrom/ppcbin/htdocs/apiswitch/App/Log/reply_`date -d last-day +\%Y\%m`.log 2>&1 &";
    shell_exec($cmd);

    $cmd = "ps aux|grep Controller/reply.php| grep -v grep | awk '{print $2}'"; //提取运行的进程号
    $reply = shell_exec($cmd);
    $reply = trim($reply);
    echo 'reply进程启动成功，reply进程pid:' . $reply;
} else {
    echo 'reply进程pid:' . $reply;
}


echo "\r\n";
