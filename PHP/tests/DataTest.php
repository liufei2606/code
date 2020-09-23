<?php

namespace Tests;

use Helper\CsvFileIterator;
use PHPUnit\Framework\TestCase;

class DataTest extends TestCase
{
	public function addtionOProvider()
	{
		return [
			[0, 1, 1],
			[1, 0, 1],
			[1, 0, 1],
			[1, 1, 2],
		];
	}

	public function addtionWithNameProvider()
	{
		return [
			'adding zeros' => [0, 0, 0],
			'zero plus one' => [0, 1, 1],
			'one plus zero' => [1, 0, 1],
			'one plus one' => [1, 1, 2]
		];
	}

	public function addtionWithCsvProvider()
	{
		return new CsvFileIterator('/home/henry/IdeaProjects/PHP/assets/files/data.csv');
	}


	/**
	 * @dataProvider addtionOProvider
	 * @dataProvider addtionWithNameProvider
	 * @dataProvider addtionWithCsvProvider
	 *
	 */
	public function testAdd($a, $b, $expected)
	{
		$this->assertEquals($expected, $a + $b);
	}
}
