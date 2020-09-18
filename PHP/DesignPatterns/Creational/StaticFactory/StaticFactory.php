<?php

namespace DesignPatterns\Creational\StaticFactory;

class StaticFactory
{
    /**
     * 通过传入参数创建相应对象实例
     *
     * @param  string  $type
     *
     * @static
     *
     * @return FormatterInterface
     * @throws \InvalidArgumentException
     */
    public static function factory($type)
    {
        $className = __NAMESPACE__.'\Format'.ucfirst($type);

        if (!class_exists($className)) {
            throw new \InvalidArgumentException('Missing format class.');
        }

        return new $className();
    }
}