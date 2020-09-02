<?php

// 创建内存表 执行完会自动释放
$table = new swoole_table(1024);

$table->column('id', $table::TYPE_INT, 4);
$table->column('name', $table::TYPE_STRING, 64);
$table->column('age', $table::TYPE_INT, 1);
$table->create();

// 设置
$table->set('data', ['id' => 1, 'name' => 'henry', 'age' => 43]);
$table['data2'] = ['id' => 2, 'name' => 'henry', 'age' => 30];

// 获取
print_r($table->get('data'));
print_r($table['data2']);

// 递增 或递减
$table->incr('data', 'age', 2);
print_r($table->get('data'));
$table->decr('data2', 'age', 2);
print_r($table->get('data2'));

// 删除
$table->del('data');
var_dump($table->get('data')); // false
