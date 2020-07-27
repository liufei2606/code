<?php


class User
{
    protected $log;

    public function __construct(FileLog $log)
    {
        $this->log = $log;
    }

    public function login()
    {
        // 登录成功，记录登录日志
        echo 'login success...';
        $this->log->write();
    }

}