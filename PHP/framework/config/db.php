<?php

return  [
        'class' => '\PDO',
        'dsn' => 'mysql:host=localhost;dbname=test',
        'username' => 'lee',
        'password' => '123456Ac&',
        'options' => [
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_STRINGIFY_FETCHES => false,
        ],
    ];
