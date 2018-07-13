<?php

namespace app\controllers;

use sf\web\Controller;

class SiteController extends Controller
{
    public function actionTest()
    {
        $data = ['code' => 200, 'msg' => 'Success'];
        echo $this->toJson($data);
    }

    public function actionView()
    {
        $body = 'Test Body infomation ';
        return $this->render('site/view', ['body' => $body]);
    }
}
