<?php

namespace DesignPatterns\Behavioral\Mediator\Subsystem;

use DesignPatterns\Behavioral\Mediator\Colleague;

/**
 * Database提供数据库服务
 */
class Database extends Colleague
{
    /**
     * @return string
     */
    public function getData()
    {
        return "World";
    }
}