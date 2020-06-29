<?php
setcookie("user", "Maxsu");
?>
<html>

<body>
<?php
if (!isset($_COOKIE["user"])) {
    echo "Sorry, cookie is not found!";
} else {
    echo "<br/>Cookie Value: ".$_COOKIE["user"];
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
var_dump(!empty($world));
?>
