<?php

namespace Test;


use PHPUnit\Framework\TestCase;

class CalculateUtilTest extends TestCase
{
    public function testSum()
    {
        $a = new \Utils\CalculateUtil();
        $data = $a->sum(3, 5);

        $this->assertEquals(8, $data);
    }
}
