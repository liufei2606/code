<?php

$host = 'localhost';
$db = 'test';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    //$sql = $pdo->quote('SELECT * FROM `post` ORDER BY `id` DESC');
    $sql = 'SELECT * FROM `post` ORDER BY `id` DESC';
    $res = $pdo->query($sql);

//    while ($row = $res->fetch()) {
//        echo $row['title'].':'.$row['context'].PHP_EOL;
//    }
//    foreach ($res as $row) {
//        print_r($row);
//    }

    # insert 两种写法
    $title = 'Rishabh';
    $context = 'Hello PDO!';
    $tis = $pdo->prepare("INSERT INTO `post`(title, context) values(?, ?)");
//    $tis->bindParam(1, $title);
//    $tis->bindParam(2, $context);
//    $tis->execute();
    $tis->execute([$title, $context]);

    $tis = $pdo->prepare("INSERT INTO `post`(title, context) values(:title, :context)");
    $tis->bindParam(':title', $title);
    $tis->bindParam(':context', $context);
    $tis->execute();

    $tis = $pdo->prepare("SELECT * FROM post");
    $tis->execute();
    $result = $tis->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $lnu) {
        echo $lnu['title'].':'.$lnu['context'].PHP_EOL;
    }

} catch (PDOException $e) {
    printf("数据库连接失败: %s".PHP_EOL, $e->getMessage());
} finally {
    $pdo = null;
}



