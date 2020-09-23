<?php

namespace Application\services\Http\Controller;

use Application\services\Model\User;

class AuthController extends \Application\services\Http\Controller\Controller
{
    public function login()
    {
//        if ($this->session->has('auth_user')) {
//            // 用户已登录，跳转到管理后台
//            return redirect('/admin');
//        }

        $siteName = $this->container->resolve('app.name');
        $pageTitle = '登录页面 - '.$siteName;
        if ($this->request->getMethod() == 'GET') {
            $this->view->render('blog/admin/login.php', compact('siteName', 'pageTitle'));
        } else {
            $name = $this->request->get('name');
            $password = $this->request->get('password');
            if (empty($name) || empty($password)) {
                $error = '用户名和密码不能为空';
                $this->view->render('blog/admin/login.php', compact('siteName', 'pageTitle', 'error'));
                return;
            }
            $user = User::where('name', $name)->first()->toArray();
            if (empty($user)) {
                // 返回到用户登录页面，并提示错误信息
                $error = '对应用户不存在，请重试';
                $this->view->render('blog/admin/login.php', compact('siteName', 'pageTitle', 'error'));
                return;
            }
            if (md5($password) == $user["passsword"]) {
                // 用户登录成功
                $this->session->set('auth_user', $user);
                // 跳转到管理后台
                return redirect('/admin');
            }

            $error = '用户名和密码不匹配，请重试';
            $this->view->render('blog/admin/login.php', compact('siteName', 'pageTitle', 'error', 'name'));
            return;
        }
    }

    public function logout()
    {
        if ($this->session->has('auth_user')) {
            $this->session->remove('auth_user');
            $this->session->invalidate();
        }
        return redirect('/login');
    }
}
