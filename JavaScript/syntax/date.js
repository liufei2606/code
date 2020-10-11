Date()
// "Tue Dec 01 2015 09:34:43 GMT+0800 (CST)"

var now = new Date(); // Wed Jun 24 2015 19:49:22 GMT+0800 (CST)
today
// "Tue Dec 01 2015 09:34:43 GMT+0800 (CST)"

var d = new Date(2015, 5, 19, 20, 15, 30, 123); // Fri Jun 19 2015 20:15:30 GMT+0800 (CST)
// 参数为时间零点开始计算的毫秒数

new Date(1378218728000)
// Tue Sep 03 2013 22:32:08 GMT+0800 (CST)

// 参数为日期字符串
new Date('January 6, 2013');
// Sun Jan 06 2013 00:00:00 GMT+0800 (CST)

// 参数为多个整数，
// 代表年、月、日、小时、分钟、秒、毫秒
new Date(2013, 0, 1, 0, 0, 0, 0)
// Tue Jan 01 2013 00:00:00 GMT+0800 (CST)
new Date(-1378218728000)
// Fri Apr 30 1926 17:27:52 GMT+0800 (CST)

new Date(2013)
// Thu Jan 01 1970 08:00:02 GMT+0800 (CST)
// 2013被解释为毫秒数

now.toUTCString(); // Thu, 29 Mar 2018 16:00:21 GMT
now.getUTCDate();
now.getUTCMonth()
now.getUTCDay()
now.getUTCHours()
now.getUTCMinutes()
now.getUTCSeconds()
now.getUTCMilliseconds()

now.getFullYear(); // 2015, 年份
now.getMonth(); // 5, 月份，注意月份范围是0~11，5表示六月
now.getDate(); // 24, 表示24号
now.getDay(); // 3, 表示星期三
now.getHours(); // 19, 24小时制
now.getMinutes(); // 49, 分钟
now.getSeconds(); // 22, 秒
now.getMilliseconds(); // 875, 毫秒数
now.getTime(); // 1435146562875, 以number形式表示的时间戳


// 创建一个指定日期和时间的方法是解析一个符合ISO 8601格式的字符串
var d = Date.parse("2015-06-24T19:49:22.875+08:00"); // 1435146562875
var d = new Date(1435146562875); // Wed Jun 24 2015 19:49:22 GMT+0800 (CST)
d.toLocaleString(); // '2015/6/24 下午7:49:22'，本地时间（北京时区+8:00），显示的字符串与操作系统设定的格式有关

var d1 = new Date(2000, 2, 1);
var d2 = new Date(2000, 3, 1);

d2 - d1
// 2678400000
d2 + d1
// "Sat Apr 01 2000 00:00:00 GMT+0800 (CST)Wed Mar 01 2000 00:00:00 GMT+0800 (CST)"

Date.parse('Aug 9, 1995')
Date.parse('January 26, 2011 13:51:50')
Date.parse('Mon, 25 Dec 1995 13:30:00 GMT')
Date.parse('Mon, 25 Dec 1995 13:30:00 +0430')
Date.parse('2011-10-10')
Date.parse('2011-10-10T14:48:00')

Date.UTC(2011, 0, 1, 2, 3, 4, 567)
// 1293847384567

var d = new Date(2013, 0, 1);
d.toUTCString()
// "Mon, 31 Dec 2012 16:00:00 GMT"
d.toISOString()
// "2012-12-31T16:00:00.000Z"
d.toJSON()
// "2012-12-31T16:00:00.000Z"
d.toDateString() // "Tue Jan 01 2013"
d.toTimeString() // "00:00:00 GMT+0800 (CST)"

d.toLocaleString('en-US') // "1/1/2013, 12:00:00 AM"
d.toLocaleString('zh-CN') // "2013/1/1 上午12:00:00"

d.toLocaleDateString('en-US') // "1/1/2013"
d.toLocaleDateString('zh-CN') // "2013/1/1"

d.toLocaleTimeString('en-US') // "12:00:00 AM"
d.toLocaleTimeString('zh-CN') // "上午12:00:00"


d.toLocaleDateString('en-US', {
	weekday: 'long',
	year: 'numeric',
	month: 'long',
	day: 'numeric'
})
// "Tuesday, January 1, 2013"

d.toLocaleDateString('en-US', {
	day: "2-digit",
	month: "long",
	year: "2-digit"
});
// "January 01, 13"

d.toLocaleTimeString('en-US', {
	timeZone: 'UTC',
	timeZoneName: 'short'
})
// "4:00:00 PM UTC"

d.toLocaleTimeString('en-US', {
	timeZone: 'Asia/Shanghai',
	timeZoneName: 'long'
})
// "12:00:00 AM China Standard Time"

d.toLocaleTimeString('en-US', {
	hour12: false
})
// "00:00:00"

d.toLocaleTimeString('en-US', {
	hour12: true
})
// "12:00:00 AM"


var myDate = new Date();
myDate.setFullYear(2008, 7, 9); // 1218211323336 2008 年 8 月 9 日
myDate.setDate(myDate.getDate() + 5); // 设置为 5 天后的日期

d1.setDate(32) // 1359648000000
d2.setDate(-1) // 1356796800000
