<?php


class A
{
    public static function test()
    {
        static::who();
    }

    /**
     * summary
     */
    public static function who()
    {
        echo __CLASS__;
    }
}


class B extends A
{
    /**
     * summary
     */
    public static function who()
    {
        echo __CLASS__;
    }

    public static function foo()
    {
        A::test();
        parent::test();
        self::test();
    }
}

class C extends B
{
    public static function who()
    {
        echo __CLASS__;
    }
}

C::foo();
