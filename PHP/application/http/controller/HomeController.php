<?php

namespace Application\services\Http\Controller;

use Application\services\Http\Exception\ValidationException;
use Application\services\Http\Response;
use Application\services\Model\Album;
use Application\services\Model\Message;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
//        $albums = $this->connection->table('albums')->selectAll();
        $albums = Album::all()->toArray();
        $pageTitle = $siteName = $this->container->resolve('app.name');
        $siteUrl = $this->container->resolve('app.url');
        $siteDesc = $this->container->resolve('app.desc');

        $this->view->render('blog/home.php', [
            'albums' => $albums,
            'pageTitle' => $pageTitle,
            'siteName' => $siteName,
            'siteDesc' => $siteDesc,
            'siteUrl' => $siteUrl
        ]);
    }

    public function about()
    {
        $response = new Response('', 301, ['Location' => 'https://www.bluebird89.online/']);
        $response->send();
    }

    // 联系表单页面
    public function contact()
    {
        if ($this->request->getMethod() == 'GET') {
            $pageTitle = '联系我 - '.$this->container->resolve('app.name');
            $siteName = $this->container->resolve('app.name');
            $this->view->render('blog/contact.php', compact('pageTitle', 'siteName'));
        } else {
            // POST 提交表单处理逻辑
            $name = $this->request->get('name');
            $email = $this->request->get('email');
            $phone = $this->request->get('phone');
            $content = $this->request->get('message');

            // 验证表单输入数据
            if (empty($name)) {
                throw new ValidationException('用户名不能为空');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new ValidationException('请输入正确的邮箱地址');
            }

            if (!preg_match('/^1[34578]{1}\d{9}$/', $phone)) {
                throw new ValidationException('请输入正确的手机号码');
            }
            if (empty($content)) {
                throw new ValidationException('消息内容不能为空');
            }

            $message = new Message();
            $message->name = filter_var($name, FILTER_SANITIZE_STRING);
            $message->email = $email;
            $message->phone = $phone;
            $message->content = filter_var($content, FILTER_SANITIZE_STRING);
            $message->created_at = Carbon::now();

            if ($message->save()) {
                (new Response('消息保存成功', 200))->send();
            }
            (new Response('保存消息失败，请重试！', 500))->send();
        }
    }
}
