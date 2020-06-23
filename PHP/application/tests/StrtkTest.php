<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__.'/../controller/strtk.php';
use PHPUnit\Framework\TestCase;

//一个测试用例即为一个继承了PHPUnit_TestCase的子类
class StrtkTest extends TestCase
{
    public function testStrtk($TestName)
    {
        $this->PHPUnit_($TestName);
    }

    public function setUp()
    {
    }

    public function teardown()
    {
    }

    public function testNoMatch()
    {
        $teststr="abcd";
        $rslt = strtk($teststr, "#");
        $this->assertEquals($teststr, $rslt, "无匹配字符时未返回原串");
    }
}

//执行指定的测试用例类中每一个名字以'test'开头的方法
//此时测试结果输出时将统一小写,故方法命名中用'_'
$tsStrtk=new PHPUnit_TestSuite(test_strtk);
$TestRslt=PHPUnit::run($tsStrtk);//执行获得结果
echo $TestRslt->toHTML();//结果在浏览器中输出
