<?php

namespace App\Http\Controller;

use App\Http\Response;
use App\Model\Album;

class HomeController extends Controller
{
    public function index()
    {
//        $albums = $this->connection->table('albums')->selectAll();
        $albums = Album::all()->toArray();
        $pageTitle = $siteName = $this->container->resolve('app.name');
        $siteUrl = $this->container->resolve('app.url');
        $siteDesc = $this->container->resolve('app.desc');

        $this->view->render('home.php', [
            'albums' => $albums,
            'pageTitle' => $pageTitle,
            'siteName' => $siteName,
            'siteDesc' => $siteDesc,
            'siteUrl' => $siteUrl
        ]);
    }

    public function about()
    {
        $response = new Response('', 301, ['Location' => 'https://xueyuanjun.com/about-us']);
        $response->send();
    }

    // 联系表单页面
    public function contact()
    {
        if ($this->request->getMethod() == 'GET') {
            $pageTitle = '联系我 - '.$this->container->resolve('app.name');
            $siteName = $this->container->resolve('app.name');
            $this->view->render('contact.php', compact('pageTitle', 'siteName'));
        } else {
            // @todo 处理表单请求数据（放到下一篇教程详细介绍）
        }
    }

}