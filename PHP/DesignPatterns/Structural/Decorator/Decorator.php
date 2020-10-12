<?php


namespace DesignPatterns\Structural\Decorator;


abstract class Decorator implements RendererInterface
{
	/**
	 * @var RendererInterface
	 */
	protected $wrapped;

	/**
	 * 必须类型声明装饰组件以便在子类中可以调用renderData()方法
	 *
	 * @param  RendererInterface  $wrappable
	 */
	public function __construct(RendererInterface $wrappable)
	{
		$this->wrapped = $wrappable;
	}
}
