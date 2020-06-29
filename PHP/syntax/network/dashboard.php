<?php

session_save_path('./session');
session_start();

if (isset($_SESSION['user'])) {
//    header('Content-Type: application/json');
//    $user = $_SESSION['user'];
//    echo json_encode($user);

    header('HTTP/1.1 200 OK');
    echo '退出登录: <a href="/syntax/network/session.php?a=out">退出登录</a>';
    exit();
} else {
    header('HTTP/1.1 401 Unauthorized');
    echo '登录后才能访问: <a href="/syntax/network/session.php">立即登录</a>';
}