<?php

if (!$_GET['a']) {
    // 可以设置其它域名
    // $path 表示该 Cookie 的服务器路径，默认是 /，表示对整个域名有效，否则是配置域名的指定目录下有效
    setcookie('name', '学院君');
    $expires = (time() + 3600);
    setcookie('website', 'https://xueyuanjun.com', $expires);
    exit();
}

if ($_GET['a'] == 'get') {
    $name = $_COOKIE['name'];
    $website = $_COOKIE['website'];
    printf('从用户请求中读取的 Cookie 数据：{name: %s, website: %s}', $name, $website);
    exit();
} elseif ($_GET['a'] == 'update') {
    $expires = (time() + 3600 * 24);
    setcookie('name', '学院君', $expires);
    // 设置过期时间为 1 天
    echo '更新 Cookie 成功';
    exit();
} elseif ($_GET['a'] == 'del') {
    $expires = (time() - 1);
    setcookie('website', '', $expires);
    echo '删除 Cookie：website';
    exit();
}

// 获取 必须重新发起请求，服务端正是从客户端请求头的 Cookie 字段中解析出的 Cookie 数据
header('Location: /syntax/network/cookie.php?a=get');
