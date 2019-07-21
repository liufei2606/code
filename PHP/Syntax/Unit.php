<?php

$autoload = dirname(__DIR__) . DIRECTORY_SEPARATOR . "../vendor/autoload.php";
if(file_exists($autoload)){
    include_once $autoload;
}
class PHPTest extends \PHPUnit\Framework\TestCase
{
    public function testRun()
    {
        $tests = [
            '\stdClass',
        ];
        foreach ($tests as $test) {
            $this->assertEquals(
                true,
                class_exists($test),
                "$test class not found"
            );
        }
    }
}
