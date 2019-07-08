<?php

class UserModel
{
    public function login($username = '', $password = '')
    {
        code...
        if (...) {
            // 用户不存在
            throw new Exception('用户不存在', '404');
        }
        code...
        if (...) {
            // 密码错误
            throw new Exception('密码错误', '400');
        }
        code...
    }
}

class UserController
{
    public function login($username = '', $password = '')
    {
        try {
            $model = new UserModel();
            $res   = $model->login($username, $password);
            // 如果需要的话，我们可以在这里统一commit数据库事务
            // $db->commit();
        } catch (Exception $e) {
            // 如果需要的话，我们可以在这里统一rollback数据库事务
            // $db->rollback();
            return [
                'code'    => $e->getCode(),
                'message' => $e->getMessage()
            ]
        }
    }
}
