<?php

namespace app\controllers;

class SiteController
{
    public function actionTest()
    {
        echo 'success';
    }

    public function actionView()
    {
        $body = 'Test Body infomation ';
        require '../views/site/view.php';
    }
}
