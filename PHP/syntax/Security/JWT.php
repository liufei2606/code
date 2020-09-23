<?php

class JWT
{
    protected $headers;

    protected $payload;

    public function __construct(array $headers, array $payload)
    {
        $this->setHeaders($headers);
        $this->setPayload($payload);
    }

    /**
     * 从 token 中获取数据
     *
     * @param  string  $token
     *
     * @return \Application\services\Modules\JWT\JWT
     * @throws \Application\services\Modules\JWT\JWTException
     */
    public static function fromToken(string $token): JWT
    {
        $arr = explode('.', $token);

        if (count($arr) !== 3) {
            throw new JWTException('token 错误');
        }

        if (!static::checkSignature("{$arr[0]}.{$arr[1]}", $arr[2])) {
            throw new JWTException('签名错误');
        }

        $headers = json_decode(static::decodeStr($arr[0]), true);
        $payload = json_decode(static::decodeStr($arr[1]), true, 512, JSON_THROW_ON_ERROR);

        return new static($headers, $payload);
    }

    /**
     * 校验签名
     *
     * @param  string  $signStr
     * @param  string  $sign
     *
     * @return bool
     */
    protected static function checkSignature(string $signStr, string $sign): bool
    {
        return static::signature($signStr) === $sign;
    }

    /**
     * 解码
     *
     * @param  string  $string
     *
     * @return string
     */
    protected static function decodeStr(string $string): string
    {
        return base64_decode(strtr($string, '-_', '+/'));
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    public function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * 生成 token
     *
     * @return string
     */
    public function token(): string
    {
        $signStr = $this->signatureStr();

        $token = $signStr.'.'.$this::signature($signStr);

        return $token;
    }

    /**
     * 获取用于签名的字符串
     *
     * @return string
     */
    public function signatureStr(): string
    {
        $headersStr = $this::encodeStr(json_encode($this->headers));
        $payloadStr = $this::encodeStr(json_encode($this->payload));

        return "{$headersStr}.{$payloadStr}";
    }

    /**
     * 编码
     *
     * @param  string  $string
     *
     * @return string
     */
    protected static function encodeStr(string $string): string
    {
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }

    /**
     * 签名，此时的 secret 为 qbhy
     *
     * @param  string  $string
     *
     * @return string
     */
    protected static function signature(string $string): string
    {
        return md5($string.'qbhy');
    }
}
