<?php

namespace Oop;

class A
{
    public static function test()
    {
        self::who();
    }

    public static function who()
    {
        echo __CLASS__.PHP_EOL;
    }

    public function getClassName()
    {
        echo static::class;
    }
}

class B extends A
{
    public static function who()
    {
        echo __CLASS__.PHP_EOL;
    }
}

B::test(); # A
B::who();
(new  B())->getClassName();
