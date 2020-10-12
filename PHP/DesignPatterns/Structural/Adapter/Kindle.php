<?php

namespace DesignPatterns\Structural\Adapter;

/**
 * Kindle 是电子书实现类
 */
class Kindle implements EBookInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function pressNext()
	{
	}

	/**
	 * {@inheritdoc}
	 */
	public function pressStart()
	{
	}
}
