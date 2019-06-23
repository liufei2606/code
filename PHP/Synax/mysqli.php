<?php

$host = 'localhost:3306';
$user = 'root';  // MySQL用户帐号
$pass = '';  // MySQL用户帐号对应的密码
$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
echo 'Connected successfully';

$sql = 'CREATE Database mydb';
if (mysqli_query($conn, $sql)) {
    echo "Database mydb created successfully.";
} else {
    echo "Sorry, database creation failed ".mysqli_error($conn);
}

$sql = "create table emp5(id INT AUTO_INCREMENT,name VARCHAR(20) NOT NULL, emp_salary INT NOT NULL,primary key (id))";
if (mysqli_query($conn, $sql)) {
    echo "Table emp5 created successfully";
} else {
    echo "Could not create table: ". mysqli_error($conn);
}

$sql = 'INSERT INTO emp4(name,salary) VALUES ("maxsu", 9000)';
if (mysqli_query($conn, $sql)) {
    echo "Record inserted successfully";
} else {
    echo "Could not insert record: ". mysqli_error($conn);
}

$id=2;
$name="Rahul";
$salary=80000;
$sql = "update emp4 set name=$name, salary=$salary where id=$id";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Could not update record: ". mysqli_error($conn);
}

$id=2;
$sql = "delete from emp4 where id=$id";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Could not deleted record: ". mysqli_error($conn);
}

$sql = 'SELECT * FROM emp4';
$retval=mysqli_query($conn, $sql);

if (mysqli_num_rows($retval) > 0) {
    while ($row = mysqli_fetch_assoc($retval)) {
        echo "EMP ID :{$row['id']}  <br> ".
                "EMP NAME : {$row['name']} <br> ".
                "EMP SALARY : {$row['salary']} <br> ".
                "--------------------------------<br>";
    }
} else {
    echo "0 results";
}

$sql = 'SELECT * FROM emp4 order by name';
$retval=mysqli_query($conn, $sql);

if (mysqli_num_rows($retval) > 0) {
    while ($row = mysqli_fetch_assoc($retval)) {
        echo "EMP ID :{$row['id']}  <br> ".
         "EMP NAME : {$row['name']} <br> ".
         "EMP SALARY : {$row['salary']} <br> ".
         "--------------------------------<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
