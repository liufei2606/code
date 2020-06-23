<?php

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
