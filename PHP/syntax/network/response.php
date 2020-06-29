<?php
// 指定头信息

//header('HTTP/1.1 200 OK');
//echo '你好，学院君';
//
//header('HTTP/1.1 400 OK');
//echo 'resource is not exist';
//
//header('HTTP/1.1 302 Found');
//header('Location: http://localhost:9000/syntax/index.php');
//
//header('HTTP/1.1 301 Move Permanently');
//header('Location: https://xueyuanjun.com');

if (empty($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic');
} else {
    $name = $_SERVER['PHP_AUTH_USER'];
    $pass = $_SERVER['PHP_AUTH_PW'];
    if ($name == 'henry' && $pass == '1234') {
        $album = new stdClass();
        $album->title = 'PHP 全栈工程师指南';
        $album->message = '用户认证成功，可以访问该页面';
        $album->summary = '基于 Laravel + Vue.js 框架的学习和实战，快速成为合格的 PHP 全栈开发工程师';
        $album->author = '学院君';
        $album->posts = [
            [
                'id' => 1,
                'title' => 'PHP 入门指南'
            ],
            [
                'id' => 2,
                'title' => 'Laravel 入门指南'
            ]
        ];
        echo json_encode($album);
    } else {
        header('HTTP/1.1 401 Unauthorized');
        echo '用户认证失败，请刷新页面重试';
    }
}

// 下载文件
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="laravel.zip"');
$filepath = __DIR__.'/files/laravel7.zip';
readfile($filepath);