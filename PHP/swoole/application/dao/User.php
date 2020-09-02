<?php

namespace dao;

use Family\Core\Singleton;
use Family\MVC\Dao;

class User extends Dao
{
    use Singleton;

    public function __construct()
    {
        parent::__construct('\entity\User');
    }
}
