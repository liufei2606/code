<?php
// session 数据存储在服务端，然后通过分配一个全局唯一的 ID 与特定用户关联（通常在用户认证通过后分配）
// ession ID 通常会存储到 Cookie 中，在其生命周期内，用户发起请求时就会带上它，这样服务端通过解析存储在 Cookie 中的 Session ID 就能识别特定的客户端用户，并返回与之关联的 Session 数据
// Session ID 也可以包含在 URL 请求参数（查询字符串）中，但是维护成本太高

// 配置 php -i | grep session
// session.save_handler:存储方式
// session.save_path 指定存储 Session 数据文件的路径
// session.use_cookies: session 维护方式 use_only_cookies:只使用 Cookie 保存
// session.name => PHPSESSID => PHPSESSID 存储在 Cookie 中的 Session ID 对应名称是 PHPSESSID
// 默认关闭,代码中开启

// 机制是 PHP 维护：发送PHP PHPSESSID cookie,通过 cookie 解析.服务端只需要赋值即可
// 主要用途就是用户认证，其基本实现原理是在用户登录成功后为其生成一个全局唯一的 Session ID，并且将必要的用户会话数据存储到服务端对应的 Session 数据中（后续可通过 Session ID 查询）
// 通过 Set-Cookie 响应头将 Session ID 发送到客户端，并存储到客户端 Cookie，过期时间与服务端维护的 Session 有效期一致（默认是 3 小时）
// 在 Session 有效期内，所有客户端请求都会自动通过 Cookie 请求头带上这个 Session ID，服务端解析到这个 Session ID 并且查询对应 Session 数据存在，则表明该客户端用户是一个已认证用户，进而返回对应的用户信息该客户端，让客户端可以标识对应用户的登录状态。

session_save_path('./session');
session_start();

$data = [
    [
        'id' => 1,
        'name' => 'test',
        'password' => '123456'
    ],
    [
        'id' => 2,
        'name' => 'henry',
        'password' => '123456'
    ]
];
// 登录
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];
    if (empty($name) || empty($password)) {
        $error = '用户名/密码不能为空，请重试';
    } else {
        $user = array_filter($data, function ($item) use ($name, $password) {
            if ($item['name'] == $name && $item['password'] == $password) {
                return true;
            }
            return false;
        });

        if (!empty($user)) {
            $_SESSION['user'] = array_shift($user);
            header('Location: dashboard.php');
        } else {
            $error = '用户名/密码不正确，请重试';
        }
    }
    echo '<h3>'.$error.'</h3>';
}

// 退出登录
if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['a'] == 'out') {
    unset($_SESSION['user']);
    header('location: '.$_SERVER['HTTP_REFERER']);
}
// 自动登录
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}


include_once 'request.php';