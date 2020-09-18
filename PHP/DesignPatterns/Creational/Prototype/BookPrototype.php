<?php

namespace DesignPatterns\Creational\Prototype;

/**
 * BookPrototype类
 */
abstract class BookPrototype
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    protected string $category;

    /**
     * @abstract
     * @return void
     */
    abstract public function __clone();

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param  string  $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }
}