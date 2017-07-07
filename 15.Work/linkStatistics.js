/*
文件：http://acts.xianyugame.com/zjzr/Download_Android_Zjzr2_3_1.html?gid=zjzr&ctype=60
功能：通过渠道id获取资源链接
      记录页面点击次数
      记录页面下载次数
使用：1.本文件引入jQuery文件为前提
      2.引入文件<script src="http://xy-sh-plat.oss-cn-shanghai.aliyuncs.com/platform/common/js/linkStatistics.js"></script>
      3.获取元素赋值下载链接：linkStatstics.getLinks('#down2');
      4.通过元素操作增加下载次数：linkStatstics.downloadCountIncr('#down2');  

*/


var url = location.href;
var param = url.slice(url.indexOf('?')+1);

var tid = '&tid=' + url.slice(url.lastIndexOf('/')+1, url.lastIndexOf('.'));
param += tid;
console.log(param);

linkStatstics=new Object();
// 获取链接
linkStatstics.getLinks=function(linkTag){
    var ua = navigator.userAgent.toLowerCase();
    $.ajax(  
    {   
        type:'get',  
        url : 'http://actsapi.xianyugame.com/getlinks?' + param,  
        dataType : 'jsonp',  
        jsonp:"jsoncallback",
        success  : function(data) {    
            var linksObj = data.data;
            console.log(linksObj); 
            if (/iphone|ipad|ipod/.test(ua)) {
                    $(linkTag).attr('href', data.data.ios_url);
                } else if (/android/.test(ua)) {
                    $(linkTag).attr('href', data.data.android_url);
                }         
           
        },  
        error : function() {  
            alert(data.msg);  
        }  
    }); 
}

// 点击增加
$.ajax(  
    {  
        type:'get',  
        url : 'http://actsapi.xianyugame.com/click/increase?' + param,  
        dataType : 'jsonp',  
        jsonp:"jsoncallback",  
        success  : function(data) {  
            console.log(data);
        },  
        error : function() {  
            alert(data.msg);  
        }  
    }  
);  

// 下载增加 
linkStatstics.downloadCountIncr=function(downloadTag){
    $(downloadTag).click(function(){

        $.ajax(  
            {  
                async:false,
                type:'get',  
                url : 'http://actsapi.xianyugame.com/download/increase?' + param,  
                dataType : 'jsonp',  
                jsonp:"jsoncallback",  
                success  : function(data) { 
                    console.log(data);  
                },  
                error : function() {  
                    alert(data.msg);  
                }  
            }
        )  
    }); 
}  