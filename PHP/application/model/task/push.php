<?php

set_time_limit(0);
//配置
//include  '../../SinglePHP/config.php';
//======================redis======================
/*
$config['Redis_host'] = '139.196.222.64';        //redis服务器
$config['Redis_port'] = '6379';             //redis端口
$config['Redis_timeout'] = '300';           //redis超时时间
$config['Redis_auth'] = 'ihub@64';                 //redis密码
$config['Redis_dbid'] = '8';                 //redis数据库 第几个库
$config['Redis_prefix'] = 'apiswitch_';      //redis key值前缀*/
$config['Redis_host'] = '10.1.2.68';        //redis服务器
$config['Redis_port'] = '6379';             //redis端口
$config['Redis_timeout'] = '300';           //redis超时时间
$config['Redis_auth'] = '20$%18Red*(iS';                 //redis密码
$config['Redis_dbid'] = '8';                 //redis数据库 第几个库
$config['Redis_prefix'] = 'apiswitch_';      //redis key值前缀

//权限中心配置
$config['Center_host'] = 'https://crmd.smgtech.net/';
$config['Center_getproductbyaid'] = 'api/product/getproductbyaid';  //?aid=42  || wxid=gh_49999b6339c6
$config['Center_getall'] = 'api/product/getall';
$config['Center_weixintoken'] = 'api/weixintoken/get';  //?appid=appid

foreach ($config as $key => $val) {
    define($key, $val);
}

//连接redis
$redis = new Redis();
$redis->connect($config['Redis_host'], $config['Redis_port'], $config['Redis_timeout']);
$redis->auth($config['Redis_auth']);
$redis->select($config['Redis_dbid']);

//curl post
/**
 * @curl 升级版    by chris.gong   20170725
 * @param  url 目标地址
 * @param data   数据
 * @param  method  默认post
 * @param  postjson  需要把参数进行json包发送
 */
function curl_data($url, $data, $method = "post", $postjson = false)
{
    $data_string = $data;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "context-Type: text/xml",
        "context-Length: ".strlen($data_string)
    ));
    if ($method == "post") {
        curl_setopt($ch, CURLOPT_post, 1);
        curl_setopt($ch, CURLOPT_postFIELDS, $data_string);
    }
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $curl_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($curl_code == 200) { // 成功
        return $result;
    }
}

//获取微信号授权了哪些平台
function getinfobywxid($wxid, $redis, $cache = true)
{
    $key = Redis_prefix . 'wxid_info_'.$wxid;
    if ($cache) {
        $arr = $redis->get($key);
        if (!empty($arr)) { //缓存中没有
            return json_decode($arr, true);
        }
    }
    $url = Center_host . Center_getproductbyaid . '?wxid='.$wxid;
    $arr = curl_data($url, '', 'GET');
    if (!empty($arr)) {
        $arr = json_decode($arr, true);
        //缓存进redis
        $redis->set($key, json_encode($arr));
        $redis->expire($key, 300);
    }
    return $arr;
}

while (true) {
    $key = Redis_prefix . 'weixin_msg_queue';
    $arr = $redis->lPop($key);
    if (!empty($arr)) {
        $arr = json_decode($arr, true);
        $info = getinfobywxid($arr['wxid'], true, $redis);
        if (!empty($info) && $info['code']=='10000' && !empty($info['data'])) {
            foreach ($info['data'] as $key => $val) {
                $urlStr = '';
                if (!empty($arr['get'])) {
                    $urlStr = http_build_query($arr['get']);
                }

                if ($val['model_type'] == 2 && !empty($val['three_msg_url'])) {
                    $curlUrl = $val['three_msg_url'].'?'.$urlStr;
                    $res = curl_data($curlUrl, $arr['msg']);
                    var_dump($curlUrl.$urlStr, $arr['msg'], $res);
                }
                if ($val['model_type'] == 1 && !empty($val['msg_url'])) {
                    if (count($arr['get']) > 0) {
                        $curlUrl = $val['msg_url'].'?'.$urlStr;
                        $res = curl_data($curlUrl, $arr['msg']);
                    } else {
                        $curlUrl = $val['msg_url'];
                        $res = curl_data($curlUrl, $arr['msg']);
                    }

                    var_dump($curlUrl, $arr['msg'], $res);
                }
            }
        }
        //curl post消息
        //$res = curl_data($url,$arr['msg']);
        echo date('Y-m-d H:i:s')."处理数据\n\r";
    } else {
        echo date('Y-m-d H:i:s')."\n\r";
        //没有数据处理时 休息2秒
        sleep(2);
    }
}
