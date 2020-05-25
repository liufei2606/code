<?php


use PHPUnit\Framework\TestCase;

class TestWorker extends TestCase
{

    public function testSay(Person $person)
    {
        $person->say();
    }

    public function testWorkerSay(Worker $worker)
    {
        $worker->say();
    }
}

$docter = new Person('docter');

$worker = new Worker();
$test = new TestWorker();
$test->testSay($docter);
$test->testWorkerSay($worker);