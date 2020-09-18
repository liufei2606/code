<?php

namespace DesignPatterns\Creational\Prototype;

/**
 * FooBookPrototype类
 */
class FooBookPrototype extends BookPrototype
{
    protected string $category = 'Foo';

    /**
     * empty clone
     */
    public function __clone()
    {
    }
}