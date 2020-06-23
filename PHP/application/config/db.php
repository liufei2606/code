<?php

return  [
    'class' => '\sf\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=test',
    'username' => 'blog',
    'password' => 'blog',
    'attributes' => [
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_STRINGIFY_FETCHES => false,
    ],
];
