<?php

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
        'msg'  => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ];
    echo json_encode($err) . PHP_EOL;
}

# 自定义
class proException extends Exception
{
    public function getErrorInfo($type = 2)
    {
        $err = [
            'code' => $this->getCode(),
            'msg'  => $this->getMessage(),
            'file'    => $this->getFile(),
            'line'   => $this->getLine()
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

class multyException extends Exception
{

    public function getErrorInfo($type = 2)
    {
        $err = [
            'code' => $this->getCode(),
            'msg'  => $this->getMessage(),
            'file'    => $this->getFile(),
            'line'   => $this->getLine()
        ];
        if ($type == 1) {
            return json_encode($err);
        }
        return $err;
    }
}

try {
    if ($_GET['age'] > 100) {
        throw new multyException('自定义的异常处理', 1002);
    } else {
        throw new Exception('系统的异常处理', 1002);
    }
} catch (proException $e) {
    $info =  $e->getErrorInfo();
    var_dump($info);
} catch (Exception $e) {
    echo $e->getMessage();
}

# ?age=110 输出：array(4) { ["code"]=> int(1002) ["msg"]=> string(24) "自定义的异常处理" ["file"]=> string(17) "/data/mi/demo.php" ["line"]=> int(64) }
# ?age=20 输出：系统的异常处理。


//禁止错误输出
error_reporting(0);
//设置错误处理器
set_error_handler('errorHandler');
//在脚本结束时运行的函数
register_shutdown_function('fatalErrorHandler');

/**
 * 错误处理
 * @param int    $err_no      错误代码
 * @param string $err_msg  错误信息
 * @param string $err_file    错误文件
 * @param int    $err_line     错误行号
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
        //这里发生一个警告错误，出发errorHandler
        echo $undefinedVarible;
    }
}

$demo_1 = new DemoClass_1();
//这里发生一个警告错误,被errorHandler 捕获
$demo_1->index();
//发生致命错误，脚本停止运行触发 fatalErrorHandler
$demo_2 = new DemoClass_2();
$demo_2->index();
