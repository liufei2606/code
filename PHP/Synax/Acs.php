<?php

class Acs {
	protected $method;
	protected $secert_key;
	/**
	 * 加解密向量
	 *
	 * @var [type]
	 */
	protected $iv;
	protected $options;

	public function __contruct($key='',$method='AES-128-CBC', $iv = '', $options=OPENSSL_RAW_DATA){
		$this->secert_key = isset($key) ? $key : 'sdfsgrtgrhgd';
		$this->method = in_array($method, openssl_get_cipher_methods) ? $method : 'AES-128-CBC';
		$this->iv = $iv;
		$this->options = in_array($options, [OPENSSL_RAW_DATA, OPENSSL_ZERO_PADDING]) ? $options : OPENSSL_RAW_DATA;
	}

	public function encrypt($data = ''){
		return base64_encode(openssl_encrypt($data, $this->method, $this->secert_key, $this->options, $this->iv));
	}

	public function decrypt($data = ''){
		return openssl_decrypt(base64_decode($data), $this->method, $this->secert_key, $this->options, $this->iv);
	}
}

$aes = new Aes('sfgafgrrerd');
$encrypted = $aes->encrypt('锄禾日耽误');

echo '加密前：锄禾日耽误<br>加密后：',$encrypted, '<hr>';
$decrypted = $aes->decrypt($encrypted);
echo '加密后 ：', $encrypted, '<br>解密后：', $decrypted;

