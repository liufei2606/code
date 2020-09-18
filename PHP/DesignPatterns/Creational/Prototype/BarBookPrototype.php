<?php

namespace DesignPatterns\Creational\Prototype;

/**
 * BarBookPrototype类
 */
class BarBookPrototype extends BookPrototype
{
    /**
     * @var string
     */
    protected string $category = 'Bar';

    /**
     * empty clone
     */
    public function __clone()
    {
    }
}