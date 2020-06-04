<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POST 请求测试</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        div.container {
            margin-top: 50px;
        }

        form {
            margin: 20px;
        }
    </style>
</head>
<body>
<div class="container col-4">
    <h1 class="text-center">登录表单</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="inputUserName">用户名</label>
            <input type="text" class="form-control" id="inputUserName" name="name">
        </div>
        <div class="form-group">
            <label for="inputPassword">密码</label>
            <input type="password" class="form-control" id="inputPassword" name="password">
        </div>
        <button type="submit" class="btn btn-primary">登录</button>
    </form>

    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="上传">
    </form>

</div>
</body>
</html>

<?php

formatParameter($_SERVER, 'SERVER');
formatParameter($_GET, 'GET');
formatParameter($_POST, 'POST');
//formatParameter($_FILES['image'], 'FILE');

function formatParameter(array $parameters, string $type = ''): void
{
    if (!empty($parameters) && is_array($parameters)) {
        $title = $type ? ucfirst($type)." Parameters:" : '';
        echo '<h3 style="color: blueviolet;">'.$title.'</h3>';
        echo '<table><tr><th>Key</th><th>Value</th></tr>';
        foreach ($parameters as $k => $v) {
//            printf("    $k:$v".PHP_EOL, $k, $v);
            echo '<tr><td>'.$k.'</td><td>'.$v.'</td></tr>';
        }
        echo '</table>';
    }
}

$image = $_FILES['image'];

// 处理文件上传过程中的错误
if ($image['error'] != UPLOAD_ERR_OK) {
    switch ($image['error']) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            trigger_error('上传文件过大', E_USER_ERROR);
            break;
        case UPLOAD_ERR_PARTIAL:
            trigger_error('上传文件不完整', E_USER_ERROR);
            break;
        case UPLOAD_ERR_NO_FILE:
            trigger_error('没有文件被上传', E_USER_ERROR);
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            trigger_error('未指定或找不到临时目录', E_USER_ERROR);
            break;
        case UPLOAD_ERR_CANT_WRITE:
            trigger_error('上传目录无法写入', E_USER_ERROR);
            break;
        default:
            trigger_error('其他文件上传错误', E_USER_ERROR);
            break;
    }
}

// 限定上传文件类型
if (!in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
    trigger_error('只支持 jpg/jpeg、png、gif 格式图片上传', E_USER_WARNING);
}

// 限定上传文件大小
if ($image['size'] > 1 * 1024 * 1024) {
    trigger_error('上传文件不能超过 1M', E_USER_WARNING);
}

// 设置文件上传路径为 Web 根目录下的 images 子目录
$uploaddir = __DIR__.'/../../assets/images/';
$filepath = $uploaddir.$image['name'];

// 移动上传文件到指定位置
if (move_uploaded_file($image['tmp_name'], $filepath)) {
    // 上传成功，则在页面预览上传的图片
    echo '<font color="green">文件上传成功</font><hr>';
    $webpath = '/assets/images/'.$image['name'];
    echo '<img src="'.$webpath.'">';
} else {
    echo '<font color="red">文件上传失败，请重试!</font>';
}
?>