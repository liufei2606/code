<?php

namespace Syntax\MySql;

//error_reporting(E_ERROR);

use PDO;

class post
{
    public $id;
    public $title;
    public $context;
    public $created_at;

    /**
     * @var PDO
     */
    protected $pdo;

    public function __construct(PDO $pdo = null)
    {
        if ($pdo != null) {
            $this->pdo = $pdo;
        }
    }

    /**
     * @param $title
     * @param $context
     *
     * @return string
     */
    public function insert(string $title, string $context): ?string
    {
        $sql = 'INSERT INTO `post` (title, context, created_at) VALUES (:title, :context, :created_at)';
        try {
            $stmt = $this->pdo->prepare($sql);
            $datetime = date('Y-m-d H:i:s', time());
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':context', $context, PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $datetime, PDO::PARAM_STR);
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            printf("数据库插入失败: %s 条".PHP_EOL, $e->getMessage());
        }
    }

    /**
     * @param  array  $items
     *
     * @return int
     */
    public function batchInsert(array $items)
    {
        $sql = 'INSERT INTO `post` (title, context, created_at) VALUES (:title, :context, :created_at)';
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare($sql);
            foreach ($items as $item) {
                $datetime = date('Y-m-d H:i:s', time());
                $stmt->bindParam(':title', $item->title, PDO::PARAM_STR);
                $stmt->bindParam(':context', $item->context, PDO::PARAM_STR);
                $stmt->bindParam(':created_at', $datetime, PDO::PARAM_STR);
                $stmt->execute();
            }
            $this->pdo->commit();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            printf("数据库批量插入失败: %s条".PHP_EOL, $e->getMessage());
        }
    }

    public function select($id)
    {
        $sql = 'SELECT * FROM `post` WHERE id = ?';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchObject(self::class);  // 以对象方式返回结果集
        } catch (PDOException $e) {
            printf("数据库查询失败: %s 条".PHP_EOL, $e->getMessage());
        }
    }

    public function selectAll()
    {
        $sql = 'SELECT * FROM `post` ORDER BY id DESC';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            printf("数据库查询失败: %s".PHP_EOL, $e->getMessage());
        }
    }

    public function update($id)
    {
        $sql = 'UPDATE `post` SET created_at = :created_at WHERE id = :id';
        try {
            $stmt = $this->pdo->prepare($sql);
            $datetime = date('Y-m-d H:i:s', time() - 36800);
            $stmt->bindParam(':created_at', $datetime, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            printf("数据库更新失败: %s条".PHP_EOL, $e->getMessage());
        }
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM `post` WHERE id = ?';
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            printf("数据库删除失败: %s条".PHP_EOL, $e->getMessage());
        }
    }
}


$dsn = 'mysql:host=127.0.0.1;port=3306;dbname=test;charset=utf8mb4';
$user = 'blog';
$pass = 'blog';
$db = 'test';

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    printf("数据库连接失败: %s".PHP_EOL, $e->getMessage());
}

$post = new post($pdo);

$title = '这是一篇测试文章🐶';
$context = '测试内容: 今天天气不错☀️';

$id = $post->insert($title, $context);
if ($id) {
    $item = $post->select($id);
    echo '插入成功,ID: '.$id.'.创建时间:'.$item->created_at.PHP_EOL;
}
$post->update($id);
$item = $post->select($id);
echo '更新成功,时间:'.$item->created_at.PHP_EOL;

if ($post->delete($id)) {
    echo '已删除，删除影响行数: '.PHP_EOL;
}

$post1 = new Post($pdo);
$items = [
    [
        'title' => '这是一篇测试文章111',
        'context' => '测试内容'
    ],
    [
        'title' => '这是一篇测试文章222',
        'context' => '测试内容'
    ],
    [
        'title' => '这是一篇测试文章333',
        'context' => '测试内容'
    ],
];
$post1->batchInsert($items);
$items = $post1->selectAll();
print_r($items);
