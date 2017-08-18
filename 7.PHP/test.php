<?php
// isset 对null过滤，而empty对所有false值过滤
header("content-type:text/html;charset=utf-8");
if (isset($_POST['ac']) && $_POST['ac'] == 'login') {
	$username = $_POST["username"];
	$password = $_POST["password"];
	echo 'User:' . $username . ', Password:'.$password.'<hr>';
}
?>
<form method="post" accept-charset="utf-8">
User:<input type="text" name="username" value="" placeholder="">
Password:<input type="text" name="password" value="" placeholder="">
<input type="submit" value="submit">
<input type="hidden" name="ac" value="login">
</form>
