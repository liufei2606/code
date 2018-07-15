<?php
namespace app\controllers;

use sf\web\Controller;
use Sf;

class SiteController extends Controller
{
    public function actionTest()
    {
        $user = \app\models\User::findAll();
        $data = ['code' => 200, 'msg' => 'Success', 'data' => $user];
        echo $this->toJson($data);
    }

    public function actionView()
    {
        $body = 'Test Body infomation ';
        return $this->render('site/view', ['body' => $body]);
    }

    public function actionCache()
    {
        echo 'FileCache test start' .'</br>';

        $cache = Sf::createObject('cache');
        $cache->set('test', 'Just a cache test');
        echo 'FileCache store' . '</br>';

        $rs = $cache->get('test');
        $cache->flush();

        echo $rs;
    }
}
