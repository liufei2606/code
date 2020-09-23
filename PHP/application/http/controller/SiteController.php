<?php
namespace Application\services\controllers;

use sf\web\Controller;
use Sf;

class SiteController extends Controller
{
    public function actionTest()
    {
        $user = \Application\services\models\User::findAll();
        $data = ['code' => 200, 'msg' => 'Success', 'data' => $user];
        echo $this->toJson($data);
    }

    public function actionView()
    {
        $body = 'Test Body infomation ';
        return $this->render('site/view', ['body' => $body, 'users' => [1, 2]]);
    }

    public function actionCache()
    {
        $cache = Sf::createObject('cache');
        $cache->set('test', 'Just a filecache test');
        echo 'FileCache store:' . '</br>';

        $rs = $cache->get('test');
        $cache->flush();

        echo $rs;
    }

    public function actionRds()
    {
        $cache = Sf::createObject('redis');
        $cache->set('test', 'Just a redisCache test');
        echo 'RedisCache store:' . '</br>';

        $rs = $cache->get('test');
        $cache->flush();

        echo $rs;
    }
}
