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
    public $originRequestcontextString = '';

    /**
     * 原始请求字符串拆得的列表
     *
     * @var array
     */
    private $originRequestcontextList = [];

    /**
     * 原始请求字符串拆得的键值对
     *
     * @var array
     */
    private $originRequestcontextMap = [];

    /**
     * 定义响应头信息
     *
     * @var array
     */
    private $responseHead = [
        'http'         => 'HTTP/1.1 200 OK',
        'context-type' => 'context-Type: text/html',
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
     * @param string $context
     * @return void
     */
    public function request($context = '')
    {
        if (empty($context)) {
            // exception
        }
        $this->originRequestcontextList = explode("\r\n", $this->originRequestcontextString);
        if (empty($this->originRequestcontextList)) {
            // exception
        }
        foreach ($this->originRequestcontextList as $k => $v) {
            if ($v === '') {
                // 过滤空
                continue;
            }
            if ($k === 0) {
                // 解析http method/request_uri/version
                list($http_method, $http_request_uri, $http_version) = explode(' ', $v);
                $this->originRequestcontextMap['Method'] = $http_method;
                $this->originRequestcontextMap['Request-Uri'] = $http_request_uri;
                $this->originRequestcontextMap['Version'] = $http_version;
                continue;
            }
            list($key, $val) = explode(': ', $v);
            $this->originRequestcontextMap[$key] = $val;
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
