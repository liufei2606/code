<?php

// isset 对null过滤，而empty对所有false值过滤
// header("content-type:text/html;charset=utf-8");
// if (isset($_POST['ac']) && $_POST['ac'] == 'login') {
//     $username = $_POST["username"];
//     $password = $_POST["password"];
//     echo 'User:' . $username . ', Password:'.$password.'<hr>';
// }

error_reporting(0);

$arr = [1, 3, 5, 6];
foreach ($arr as &$v) { }
foreach ($arr as $v) { }
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
echo ("Page Views: " . $_SESSION['counter']);
var_dump(!empty($world));
?>

<?php
$arr1 = ['PHP', 'apache'];
$arr2 = ['hello', 'MySQl', 'HTML', 'CSS'];
$mergeArr = array_merge($arr1, $arr2);
$plusArr = $arr1 + $arr2;
var_dump($mergeArr);
var_dump($plusArr);

$arr2 = [["hello", "MySQl", "HTML", "CSS"]];
echo json_encode($arr2, JSON_PRETTY_PRINT) . '<br>';

// mcrypt_get_block_siz  This function has been DEPRECATED as of PHP 7.1.0 and REMOVED as of PHP 7.2.0
// echo mcrypt_get_block_size('tripledes', 'ecb');

# char length eng and chn
echo 'hello world' . '<br>';
echo 'ｈｅｌｌｏ　ｗｏｒｌｄ' . ' length:' .strlen('ｈｅｌｌｏ　ｗｏｒｌｄ') . '<hr>';


// var_dump(spl_autoload_functions());

var_dump(0+ "3+4+5");

echo 8367 & 8192 . "\n";
echo 8366 & 8192 . "\n";


$a= 45;
$b = $a;
$b = 56;
echo $a;
echo $b;
