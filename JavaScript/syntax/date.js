var now = new Date(); // Wed Jun 24 2015 19:49:22 GMT+0800 (CST)
now.toUTCString(); // Thu, 29 Mar 2018 16:00:21 GMT
now.getFullYear(); // 2015, 年份
now.getMonth(); // 5, 月份，注意月份范围是0~11，5表示六月
now.getDate(); // 24, 表示24号
now.getDay(); // 3, 表示星期三
now.getHours(); // 19, 24小时制
now.getMinutes(); // 49, 分钟
now.getSeconds(); // 22, 秒
now.getMilliseconds(); // 875, 毫秒数
now.getTime(); // 1435146562875, 以number形式表示的时间戳

var d = new Date(2015, 5, 19, 20, 15, 30, 123); // Fri Jun 19 2015 20:15:30 GMT+0800 (CST)

// 创建一个指定日期和时间的方法是解析一个符合ISO 8601格式的字符串
var d = Date.parse("2015-06-24T19:49:22.875+08:00"); // 1435146562875
var d = new Date(1435146562875); // Wed Jun 24 2015 19:49:22 GMT+0800 (CST)
d.toLocaleString(); // '2015/6/24 下午7:49:22'，本地时间（北京时区+8:00），显示的字符串与操作系统设定的格式有关

var myDate = new Date();
myDate.setFullYear(2008, 7, 9); // 1218211323336 2008 年 8 月 9 日
myDate.setDate(myDate.getDate() + 5); // 设置为 5 天后的日期
