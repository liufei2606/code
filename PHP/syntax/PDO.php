<?php

$host = 'localhost';
$db   = 'theitstuff';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$conn = new PDO($dsn, $user, $pass, $options);

$tis = $conn->query('SELECT name, age FROM students');
while ($row = $tis->fetch()) {
    echo $row['name'] . "\t".$row['age'] . "<br>";
}

# 预处理
$tis = $conn->prepare("INSERT INTO STUDENTS(name, age) values(?, ?)");
$tis->bindValue(1, 'mike');
$tis->bindValue(2, 22);
$tis->execute();

$name='Rishabh';
$age=20;
$tis = $conn->prepare("INSERT INTO STUDENTS(name, age) values(?, ?)");
$tis->bindParam(1, $name);
$tis->bindParam(2, $age);
$tis->execute();

$name='Rishabh';
$age=20;
$tis = $conn->prepare("INSERT INTO STUDENTS(name, age) values(:name, :age)");
$tis->bindParam(':name', $name);
$tis->bindParam(':age', $age);
$tis->execute();

$tis = $conn->prepare("SELECT * FROM STUDENTS");
$tis->execute();
$result = $tis->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $lnu) {
    echo $lnu['name'];
    echo $lnu['age']."<br>";
}
