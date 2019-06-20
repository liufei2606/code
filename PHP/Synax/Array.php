<?php

// array_merge();
// base64_encode();
// str_replace();


$arr =
    ['user_name' => 'henry',
    'user_age' => 34
];

$arr = array_map(
        function ($key) {
            return str_replace('user_', '', $key);
        },
        $arr
    );


echo '<pre>';
var_dump($arr);

# 遍历一个数组获取新的数据结构
// foreach ($arr as ＆$v) {
//     // 一系列判断得到你想要的数据
//     if (...) {
//         // 复写值为你想要的
//         $v['youwantbyjudge'] = 'TIGERB'
//     }
//     ...
//     // 干掉你不想要的结构
//     unset($v['youwantdel']);
// }
// unset($v);

$arr = [1,2,3];
foreach ($arr as &$v) {
	# code...
}

foreach ($arr as $k => $v) {
	$v = 4;
}
echo "<pre>";
print_r($arr);
echo "</pre>";
