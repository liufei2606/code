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
