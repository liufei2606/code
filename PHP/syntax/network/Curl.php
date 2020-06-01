<?php
// 初始化句柄
$ch = curl_init("http://www.example.com/");
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "example.com");

$fp = fopen("example_homepage.txt", "w");

curl_setopt($ch, CURLOPT_TIMEOUT, 200);

curl_setopt($ch, CURLOPT_FILE, $fp);

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_postFIELDS, "username=".$username."&password=".$password);

curl_setopt($ch, CURLOPT_post, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3); // 整个curl请求过程（http request & response）的超时限制，以秒为单位，设置为0则无限制
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$options = array(CURLOPT_URL => 'http://www.example.com/',
                 CURLOPT_HEADER => false
                );
curl_setopt_array($ch, $options);

$ch2 = curl_copy_handle($ch); // 复制一个cURL句柄并保持相同的选项

$result = curl_exec($ch); // 成功时返回 TRUE， 或者在失败时返回 FALSE。 然而，如果 设置了 CURLOPT_RETURNTRANSFER 选项，函数执行成功时会返回执行的结果，失败时返回 FALSE 。

if (curl_errno($ch) || curl_exec($ch) === false) { // 返回最后一次的错误代码
    echo 'Curl error: ' . curl_error($ch); // 返回当前会话最后一次错误的字符串
    $info = curl_getinfo($ch);
    echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
} else {
    echo $result;
}

curl_close($ch); # 关闭 cURL 会话并且释放所有资源。cURL 句柄 ch 也会被删除
curl_close($ch2);
fclose($fp);

function multiCurl()
{
    // 创建一对cURL资源
    $ch1 = curl_init();
    $ch2 = curl_init();

    // 设置URL和相应的选项
    curl_setopt($ch1, CURLOPT_URL, "http://www.example.com/");
    curl_setopt($ch1, CURLOPT_HEADER, 0);
    curl_setopt($ch2, CURLOPT_URL, "http://www.php.net/");
    curl_setopt($ch2, CURLOPT_HEADER, 0);

    // 创建批处理cURL句柄
    $mh = curl_multi_init();

    // 增加2个句柄
    curl_multi_add_handle($mh, $ch1);
    curl_multi_add_handle($mh, $ch2);

    $active=null;
    $mrc = '';
    // 执行批处理句柄
    do {
        $result = curl_multi_exec($mh, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);

    while ($active && $mrc == CURLM_OK) {
        if (curl_multi_select($mh) != -1) {
            do {
                $mrc = curl_multi_exec($mh, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }

        if (curl_multi_errno($mh)) { // 返回最后一次的错误代码
            echo 'Curl error: ' . curl_error($ch1); // 返回当前会话最后一次错误的字符串
            $info = curl_getinfo($ch1);
            echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
        } else {
            echo $result;
        }

        // 关闭全部句柄
        curl_multi_remove_handle($mh, $ch1);
        curl_multi_remove_handle($mh, $ch2);
        curl_multi_close($mh);

        $urls = array(
            "http://www.cnn.com/",
            "http://www.bbc.co.uk/",
            "http://www.yahoo.com/"
            );

        // 例子 2
        $mh = curl_multi_init();

        foreach ($urls as $i => $url) {
            $pdo[$i] = curl_init($url);
            curl_setopt($pdo[$i], CURLOPT_RETURNTRANSFER, 1);
            curl_multi_add_handle($mh, $pdo[$i]);
        }

        do {
            $status = curl_multi_exec($mh, $active);
            $info = curl_multi_info_read($mh);
            if (false !== $info) {
                var_dump($info);
            }
        } while ($status === CURLM_CALL_MULTI_PERFORM || $active);

        foreach ($urls as $i => $url) {
            $res[$i] = curl_multi_getcontext($pdo[$i]);
            curl_close($pdo[$i]);
        }

        var_dump(curl_multi_info_read($mh));
    }


    function geturl($url, array $data)
    {
        $headerArray = array("context-type:application/json;", "Accept:application/json");
        $ch = curl_init();
        if (!empty($data)) {
            $url = $url.'?'.http_bulid_query($data);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($url, CURLOPT_HTTPHEADER, $headerArray);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }


    function posturl($url, $data)
    {
        $data = json_encode($data);
        $headerArray = array("context-type:application/json;charset='utf-8'", "Accept:application/json");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_post, 1);
        curl_setopt($curl, CURLOPT_postFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);

        return json_decode($output, true);
    }


    function puturl($url, $data)
    {
        $data = json_encode($data);
        $ch = curl_init(); //初始化CURL句柄
        curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('context-type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); //设置请求方式
        curl_setopt($ch, CURLOPT_postFIELDS, $data);//设置提交的字符串
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }

    function delurl($url, $data)
    {
        $data  = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('context-type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_postFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);

        $output = json_decode($output, true);
    }

    function patchurl($url, $data)
    {
        $data  = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('context-type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_postFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }

    function curl_request($url, $post='', $cookie='', $returnCookie=0)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_REFERER, "http://XXX");
        if ($post) {
            curl_setopt($curl, CURLOPT_post, 1);
            curl_setopt($curl, CURLOPT_postFIELDS, http_build_query($post));
        }
        if ($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        if ($returnCookie) {
            list($header, $body) = explode("\r\n\r\n", $data, 2);
            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
            $info['cookie'] = substr($matches[1][0], 1);
            $info['context'] = $body;
            return $info;
        } else {
            return $data;
        }
    }
}
