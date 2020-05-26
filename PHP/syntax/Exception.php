<?php

class MyException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__.": [{$this->code}]: {$this->message}".PHP_EOL;
    }

    public function customFunction()
    {
        echo "A custom function for this type of exception".PHP_EOL;
    }
}

class TestException
{
    public $var;

    const THROW_NONE    = 0;
    const THROW_CUSTOM  = 1;
    const THROW_DEFAULT = 2;

    public function __construct($avalue = self::THROW_NONE)
    {
        switch ($avalue) {
            case self::THROW_CUSTOM:
                throw new MyException('1 is an invalid parameter', 5);
                break;
            case self::THROW_DEFAULT:
                throw new Exception('2 is not allowed as a parameter', 6);
                break;
            default:
                $this->var = $avalue;
                break;
        }
    }
}

try {
    $o = new TestException(TestException::THROW_CUSTOM);
} catch (MyException $e) {
    echo "Caught my exception\n", $e;
    $e->customFunction();
} catch (Exception $e) {
    echo "Caught Default Exception\n", $e;
}
var_dump($o);
echo "\n\n";

// 例子 2
try {
    $o = new TestException(TestException::THROW_DEFAULT);
} catch (MyException $e) {      //  不能匹配异常的种类，被忽略

    echo "Caught my exception\n", $e;
    $e->customFunction();
} catch (Exception $e) {        // 捕获异常
    echo "Caught Default Exception\n", $e;
}

// 执行后续代码
var_dump($o); // Null
echo "\n\n";


// 例子 3
try {
    $o = new TestException(TestException::THROW_CUSTOM);
} catch (Exception $e) {        // 捕获异常
    echo "Default Exception caught\n", $e;
}

// 执行后续代码
var_dump($o); // Null
echo "\n\n";


// 例子 4
try {
    $o = new TestException();
} catch (Exception $e) {        // 没有异常，被忽略
    echo "Default Exception caught\n", $e;
}

// 执行后续代码
var_dump($o); // TestException
echo "\n\n";


header("Content-type:text/html;charset=utf-8");

# 系统自带
try {
    //业务处理 错误时抛出异常。
    $age = 130;
    if ($age > 120) {
        throw new Exception('年龄不能大于120岁。', 1001);
    }
} catch (Exception $e) {
    $err = [
        'code' => $e->getCode(),
        'msg' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ];
    echo json_encode($err).PHP_EOL;
}

# 自定义
class proException extends Exception
{
    public function getErrorInfo($type = 2)
    {
        $err = [
            'code' => $this->getCode(),
            'msg' => $this->getMessage(),
            'file' => $this->getFile(),
            'line' => $this->getLine()
        ];
        if ($type == 1) {
            return json_encode($err);
        }
        return $err;
    }
}

try {
    //业务处理 错误时抛出异常。
    $age = 130;
    if ($age > 120) {
        throw new proException('年龄不能大于120岁。', 1001);
    }
} catch (proException $e) {
    $info = $e->getErrorInfo();
    var_dump($info);
    echo PHP_EOL;
}

try {
    if ($_GET['age'] > 100) {
        throw new multyException('自定义的异常处理', 1002);
    } else {
        throw new Exception('系统的异常处理', 1002);
    }
} catch (proException $e) {
    $info = $e->getErrorInfo();
    var_dump($info);
} catch (Exception $e) {
    echo $e->getMessage();
}


error_reporting(0);
//设置错误处理器
set_error_handler('errorHandler');
//在脚本结束时运行的函数
register_shutdown_function('fatalErrorHandler');

/**
 * 错误处理
 *
 * @param  int     $err_no    错误代码
 * @param  string  $err_msg   错误信息
 * @param  string  $err_file  错误文件
 * @param  int     $err_line  错误行号
 *
 * @return string
 */
function errorHandler($err_no = 0, $err_msg = '', $err_file = '', $err_line = 0)
{
    $log = [
        '['.date('Y-m-d h-i-s').']',
        '|',
        $err_no,
        '|',
        $err_msg,
        '|',
        $err_file,
        '|',
        $err_line
    ];
    $log_path = './debug.log';
    error_log(implode(' ', $log)."\r\n", 3, $log_path);
    //echo implode(' ',$log)."<br>";
}

/**
 * 捕捉致命错误
 *
 * @return string
 */
function fatalErrorHandler()
{
    $e = error_get_last();
    switch ($e['type']) {
        case 1:
            errorHandler($e['type'], $e['message'], $e['file'], $e['line']);
            break;
    }
}

class DemoClass_1
{
    public function index()
    {
        echo $undefinedVarible;
    }
}

$demo_1 = new DemoClass_1();
$demo_1->index();
$demo_2 = new DemoClass_2();
$demo_2->index();

function getItemFromBook($book, $key)
{
    if (empty($book) || !key_exists($key, $book)) {
        throw new InvalidArgumentException("数组为空或者对应索引不存在！");
    }
    return $book[$key];
}

try {
    $val = getItemFromBook($book, 'desc');
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage();
    exit();
}
var_dump($val);