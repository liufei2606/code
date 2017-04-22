<?php
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// 插入数据
$bulk = new MongoDB\Driver\BulkWrite;
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

//$bulk->insert(['x' => 1, 'name' => '菜鸟教程', 'url' => 'http://www.runoob.com']);
//$bulk->insert(['x' => 2, 'name' => 'Google', 'url' => 'http://www.google.com']);
//$bulk->insert(['x' => 4, 'name' => 'taobao', 'url' => 'http://www.taobao.com']);
//$manager->executeBulkWrite('test.sites', $bulk);

//$document = ['_id' => new MongoDB\BSON\ObjectID, 'name' => '菜鸟教程'];
//$_id= $bulk->insert($document);
//$result = $manager->executeBulkWrite('test.runoob', $bulk, $writeConcern);

// 更新数据
//$bulk->update(
//    ['x' => 5],
//    ['$set' => ['name' => '菜鸟工具2', 'url' => 'tool.runoob.com']],
//    ['multi' => true, 'upsert' => true]
//);
//$result = $manager->executeBulkWrite('test.sites', $bulk, $writeConcern);

//删除数据
//$bulk->delete(['x' => 3], ['limit' => 1]);   // limit 为 1 时，删除第一条匹配数据
//$manager->executeBulkWrite('test.sites', $bulk, $writeConcern);

// 查询数据
$filter = ['x' => ['$gt' => 0]];
$options = [
    'projection' => ['_id' => 0],
    'sort' => ['x' => 1],
];

$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('test.sites', $query);
echo "<pre/>";
foreach ($cursor as $document) {
    print_r($document);
}
?>