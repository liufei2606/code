<?php
// isset 对null过滤，而empty对所有false值过滤
// header("content-type:text/html;charset=utf-8");
// if (isset($_POST['ac']) && $_POST['ac'] == 'login') {
//     $username = $_POST["username"];
//     $password = $_POST["password"];
//     echo 'User:' . $username . ', Password:'.$password.'<hr>';
// }

$arr = [1,3,5,6];
foreach ($arr as &$v) {
}
foreach ($arr as $v) {
}
var_dump($arr);

$array = array(
    1    => "a",
    "1"  => "b",
    1.5  => "c",
    true => "d",
);
var_dump($array);
?>

<?php
setcookie("user", "Maxsu");
?>
<html>
<body>
<?php
if (!isset($_COOKIE["user"])) {
    echo "Sorry, cookie is not found!";
} else {
    echo "<br/>Cookie Value: " . $_COOKIE["user"];
}
?>
</body>
</html>
<?php
session_start();

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    $_SESSION['counter']++;
}
echo("Page Views: ".$_SESSION['counter']);
