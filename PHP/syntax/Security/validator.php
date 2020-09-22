<?php
$input = 'yaojinbu@163.com';
$isEmail = filter_var($input, FILTER_VALIDATE_EMAIL);

if ($isEmail !== false) {
    echo 'success';
} else {
    echo 'failed';
}