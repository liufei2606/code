<?php

$host = 'localhost';
$user = 'root';
$pass = '4268';
$port = 3306;
$pdo = mysqli_connect($host.':'.$port, $user, $pass);
$dbName = 'mydb';
$tableName = 'emp4';
mysqli_set_charset($pdo, 'utf8mb4');

if (!$pdo) {
    die('MySQL Could not connect: '.mysqli_error($pdo)).PHP_EOL;
}
echo 'MySQL Connected successfully. Thread_id:'.mysqli_thread_id($pdo).PHP_EOL;

$dbName = 'mydb';
$sql = 'CREATE DATABASE IF NOT EXISTS '.$dbName;
if (mysqli_query($pdo, $sql)) {
    echo "Database  $dbName  created successfully.".PHP_EOL;
} else {
    die("Database $dbName creation failed ".mysqli_error($pdo).PHP_EOL);
}

if (mysqli_select_db($pdo, $dbName)) {
    echo "Select DB  $dbName successfully.".PHP_EOL;
} else {
    die("Select DB  $dbName  failed ".mysqli_error($pdo).PHP_EOL);
}

$sql = "CREATE TABLE  IF NOT EXISTS `$dbName`.`$tableName` (
                `id` INT NOT NULL AUTO_INCREMENT,
                name varchar(100) not null comment '名称',
                salary int(5) not null DEFAULT 0 comment '工资',
                PRIMARY KEY (`id`));";

if (mysqli_query($pdo, $sql)) {
    echo "TABLE  $tableName created successfully.".PHP_EOL;
} else {
    die("Create TABLE $tableName failed ".mysqli_error($pdo).PHP_EOL);
}

$insertId = 0;

$sql = "INSERT INTO $tableName(name,salary)  VALUES (?, ?)";
$name = 'maxsu';
$salary = 9000;
$stmt = mysqli_prepare($pdo, $sql);
mysqli_stmt_bind_param($stmt, 'si', $name, $salary);
if (mysqli_stmt_execute($stmt)) {
    echo "Record inserted successfully".PHP_EOL;
    printf("%d Row inserted.".PHP_EOL, mysqli_stmt_affected_rows($stmt));
    $insertId = mysqli_stmt_insert_id($stmt);
    mysqli_stmt_close($stmt);
} else {
    echo "Could not insert record: ".mysqli_error($pdo).PHP_EOL;
}

//$sql = "INSERT INTO $tableName(name,salary) VALUES ('maxsu', 9000)";
//if (mysqli_query($pdo, $sql)) {
//    echo "Record inserted successfully".PHP_EOL;
//    $insertId = mysqli_insert_id($pdo);
//} else {
//    echo "Could not insert record: ".mysqli_error($pdo).PHP_EOL;
//}

$sql = "SELECT * FROM $tableName order by name";
$retval = mysqli_query($pdo, $sql);

showLines($pdo, $tableName);

$name = 'Rahul😂';
$salary = 80000;
$sql = "update $tableName set name='$name', salary=$salary where id=$insertId";
if (mysqli_query($pdo, $sql)) {
    echo "Record updated successfully".PHP_EOL;
} else {
    echo "Could not update record $insertId: ".mysqli_error($pdo).PHP_EOL;
}
showLines2($pdo, $tableName);

$sql = "delete from $tableName where id=$insertId";
if (mysqli_query($pdo, $sql)) {
    echo "Record deleted successfully".PHP_EOL;
} else {
    echo "Could not deleted record: ".mysqli_error($pdo).PHP_EOL;
}
mysqli_close($pdo);


function showLines($pdo, $tableName)
{
    $sql = "SELECT * FROM $tableName order by name";
    $retval = mysqli_query($pdo, mysqli_escape_string($pdo, $sql));

    if (mysqli_num_rows($retval) > 0) {
        while ($row = mysqli_fetch_assoc($retval)) {
            echo "EMP ID :{$row['id']}".PHP_EOL.
                "EMP NAME : {$row['name']}".PHP_EOL.
                "EMP SALARY : {$row['salary']}".PHP_EOL.
                "--------------------------------".PHP_EOL;
        }
        mysqli_free_result($retval);
    } else {
        echo "0 results".PHP_EOL;
    }
}

function showLines1($pdo, $tableName)
{
    $sql = "SELECT * FROM $tableName order by name";
    $retval = mysqli_query($pdo, $sql);
//    $rows = mysqli_fetch_all($retval, MYSQLI_ASSOC);
//    var_dump($rows[0]);
    $rows = mysqli_fetch_row($retval);
    var_dump($rows);
    mysqli_free_result($retval);
}

class post
{
    public $id;
    public $name;
    public $salary;

    public function __toString()
    {
        return '[#'.$this->id.'] '.'Name:'.$this->name.' Salary:'.$this->salary.PHP_EOL;
    }
}

function showLines2($pdo, $tableName)
{
    $sql = "SELECT * FROM $tableName order by name";
    $retval = mysqli_query($pdo, $sql);
    $rows = mysqli_fetch_object($retval, post::class);
    echo $rows;
    mysqli_free_result($retval);
}