<?php

class Rsa2
{
	private static $PRIVATE_KEY = 'private_key.pem 内容';
	private static $PUBLIC_KEY = 'public_key.pem 内容';

	private static function getPrivatekey(){
		$privateKey = self::$PRIVATE_KEY;
		return openssl_pkey_get_private($privateKey);
	}

	private static function getPublickey(){
		$privateKey = self::$PUBLIC_KEY;
		return openssl_pkey_get_public($privateKey);
	}

	/**
	 * openssl_private_encrypt return bool, value 第二个参数
	 *
	 * @param string $data
	 * @return void
	 */
	public static function privateEncrypt($data = ''){
		if(!is_string($data)) {
			return null;
		}
		return openssl_private_encrypt($data, $encrypted,self::getPrivatekey()) ? base64_encode($encrypted) : null;
	}

	public static function publicEncrypt($data = ''){
		if(!is_string($data)) {
			return null;
		}
		return openssl_public_encrypt($data, $encrypted,self::getPublickey()) ? base64_encode($encrypted) : null;
	}

	public static function privateDecrypt($encrypted = ''){
		if(!is_string($encrypted)) {
			return null;
		}
		return openssl_private_decrypt(base64_decode($encrypted), $decrypted,self::getPrivatekey()) ? $decrypted : null;
	}

	public static function publicDecrypt($encrypted = ''){
		if(!is_string($encrypted)) {
			return null;
		}
		return openssl_public_decrypt(base64_decode($encrypted), $decrypted,self::getPublickey()) ? $decrypted : null;
	}

	public function createSign($data = '') {
		if(!is_string($data)) {
			return null;
		}
		return openssl_sign($data, $sign,self::getPrivatekey(), OPENSSL_ALGO_SHA256) ? base64_encode($sign) : null;
	}

	public function verifySign($data = '', $sign= '') {
		if(!is_string($data) || !is_string($sign)) {
			return null;
		}
		return (bool)openssl_verify($data, base64_decode($sign), self::getPublickey(), OPENSSL_ALGO_SHA256);
	}
}
