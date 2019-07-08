<?php

/**
 * php实现简单的http协议
 */
class HttpProtocol
{
    /**
     * 原始请求字符串
     *
     * @var string
     */
    public $originRequestContentString = '';

    /**
     * 原始请求字符串拆得的列表
     *
     * @var array
     */
    private $originRequestContentList = [];

    /**
     * 原始请求字符串拆得的键值对
     *
     * @var array
     */
    private $originRequestContentMap = [];

    /**
     * 定义响应头信息
     *
     * @var array
     */
    private $responseHead = [
        'http'         => 'HTTP/1.1 200 OK',
        'content-type' => 'Content-Type: text/html',
        'server'       => 'Server: php/0.0.1',
    ];

    /**
     * 定义响应体信息
     *
     * @var string
     */
    private $responseBody = '';

    /**
     * 响应内容
     *
     * @var string
     */
    public $responseData = '';

    /**
     * 解析请求信息
     *
     * @param string $content
     * @return void
     */
    public function request($content = '')
    {
        if (empty($content)) {
            // exception
        }
        $this->originRequestContentList = explode("\r\n", $this->originRequestContentString);
        if (empty($this->originRequestContentList)) {
            // exception
        }
        foreach ($this->originRequestContentList as $k => $v) {
            if ($v === '') {
                // 过滤空
                continue;
            }
            if ($k === 0) {
                // 解析http method/request_uri/version
                list($http_method, $http_request_uri, $http_version) = explode(' ', $v);
                $this->originRequestContentMap['Method'] = $http_method;
                $this->originRequestContentMap['Request-Uri'] = $http_request_uri;
                $this->originRequestContentMap['Version'] = $http_version;
                continue;
            }
            list($key, $val) = explode(': ', $v);
            $this->originRequestContentMap[$key] = $val;
        }
    }

    /**
     * 组装响应内容
     *
     * @param [type] $responseBody
     * @return void
     */
    public function response($responseBody)
    {
        $count = count($this->responseHead);
        $finalHead = '';
        foreach ($this->responseHead as $v) {
            $finalHead .= $v . "\r\n";
        }
        $this->responseData = $finalHead . "\r\n" . $responseBody;
    }
}
