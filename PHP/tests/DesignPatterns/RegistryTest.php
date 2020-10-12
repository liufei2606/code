<?php

namespace Tests\DesignPatterns;

use DesignPatterns\Structural\Registry\Registry;
use PHPUnit\Framework\TestCase;

class RegistryTest extends TestCase
{
	public function testSetAndGetLogger()
	{
		Registry::set(Registry::LOGGER, new \StdClass());

		$logger = Registry::get(Registry::LOGGER);
		$this->assertInstanceOf('StdClass', $logger);
	}
}
