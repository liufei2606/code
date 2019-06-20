<?php

class DES
{
    public $key;
    public $iv; //偏移量

    public function __construct($key = '11001100', $iv=0)
    {
        //key长度8例如:1234abcd
        $this->key = $key;
        if ($iv == 0) {
            $this->iv = $key; //默认以$key 作为 iv
        } else {
            $this->iv = $iv; //mcrypt_create_iv ( mcrypt_get_block_size (MCRYPT_DES, MCRYPT_MODE_CBC), MCRYPT_DEV_RANDOM );
        }
    }

    public function encrypt($str)
    {
        //加密，返回大写十六进制字符串
        $size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);
        $str = $this->pkcs5Pad($str, $size);
        return strtoupper(bin2hex(mcrypt_cbc(MCRYPT_DES, $this->key, $str, MCRYPT_ENCRYPT, $this->iv)));
    }

    public function decrypt($str)
    {
        //解密
        $strBin = $this->hex2bin(strtolower($str));
        $str = mcrypt_cbc(MCRYPT_DES, $this->key, $strBin, MCRYPT_DECRYPT, $this->iv);
        $str = $this->pkcs5Unpad($str);
        return $str;
    }

    public function hex2bin($hexData)
    {
        $binData = "";
        for ($i = 0; $i < strlen($hexData); $i += 2) {
            $binData .= chr(hexdec(substr($hexData, $i, 2)));
        }
        return $binData;
    }

    public function pkcs5Pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public function pkcs5Unpad($text)
    {
        $pad = ord($text {strlen($text) - 1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;

            return substr($text, 0, - 1 * $pad);
        }
    }
}

class Acs
{
	protected $method;
	protected $secert_key;
	/**
	 * 加解密向量
	 *
	 * @var [type]
	 */
	protected $iv;
	protected $options;

	public function __contruct($key = '', $method = 'AES-128-CBC', $iv = '', $options = OPENSSL_RAW_DATA)
	{
		$this->secert_key = isset($key) ? $key : 'sdfsgrtgrhgd';
		$this->method = in_array($method, openssl_get_cipher_methods) ? $method : 'AES-128-CBC';
		$this->iv = $iv;
		$this->options = in_array($options, [OPENSSL_RAW_DATA, OPENSSL_ZERO_PADDING]) ? $options : OPENSSL_RAW_DATA;
	}

	public function encrypt($data = '')
	{
		return base64_encode(openssl_encrypt($data, $this->method, $this->secert_key, $this->options, $this->iv));
	}

	public function decrypt($data = '')
	{
		return openssl_decrypt(base64_decode($data), $this->method, $this->secert_key, $this->options, $this->iv);
	}
}

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

/**
 * 单向md5加密
 */

function _createSign()
{
    $strSalt = 'sfdsagretrbfdbfd';
    $strVal = '';
    if ($this->params) {
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

$aes = new Aes('sfgafgrrerd');
$encrypted = $aes->encrypt('锄禾日耽误');

echo '加密前：锄禾日耽误<br>加密后：', $encrypted, '<hr>';
$decrypted = $aes->decrypt($encrypted);
echo '加密后 ：', $encrypted, '<br>解密后：', $decrypted;

$des = new DES();
$temp =  $des->encrypt('hello');
echo $temp;
echo $des->decrypt($temp);
