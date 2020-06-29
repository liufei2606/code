<?php

namespace Test;

use PHPUnit\Framework\TestCase;

require 'CsvIterator.php';

class DataTest extends TestCase
{

    /**
     * @dataProvider addtionOProvider
     * @dataProvider addtionWithNameProvider
     * @dataProvider addtionWithCsvProvider
     */
    public function testAdd($a, $b, $expected)
    {
        $this->assertEquals($expected, $a + $b);
    }

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
        return new \CsvFileIterator('/home/henry/IdeaProjects/PHP/Test/data.csv');
    }
}
