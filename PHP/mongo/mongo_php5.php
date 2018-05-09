<?php

$m = new MongoClient();
$db = $m->selectDB('test');
$collection = new MongoCollection($db, 'student');
echo '<pre/>';
// 搜索水果
$nameQuery = array('name' => 'asion');

$cursor = $collection->find($nameQuery);
foreach ($cursor as $doc) {
    var_dump($doc);
}

// 搜索甜的产品 Taste is a child of Details.
$sweetQuery = array('detail.gender' => 'male');
echo "Sweet\n";
$cursor = $collection->find($sweetQuery);
foreach ($cursor as $doc) {
    var_dump($doc);
}
