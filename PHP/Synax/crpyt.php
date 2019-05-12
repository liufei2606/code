<?php

/**
 * 单向md5加密
 */

function _createSign()
{
    $strSalt = 'sfdsagretrbfdbfd';
    $strVal = '';
    if($this->params) {
		$params = $this->parms;
		ksort($params);
		$strVal = http_build_query($params, '', '&', PHP_QUERY_RFC1738);
	}

	return md5(md5($strSalt) . md5($strVal));
}

$password = "12324434";
$strPwdHash = password_hash($password, PASSWORD_DEFAULT);

if (password_verify($password, $strPwdHash)) {

}
