`这是一个
多行
字符串`;

("Hello \
World!");

var name = "小明";
var age = 20;
var message = "你好, " + name + ", 你今年" + age + "岁了!";
var message = `你好, ${name}, 你今年${age}岁了!`;

typeof new String("John"); // 返回 Object

var s = "Hello, world!";
s.length; // 13

s[0]; // 'H'
s[12]; // '!'
s[13]; // undefined 超出范围的索引不会报错，但一律返回undefined

s[0] = "X";
alert(s); // s仍然为'Test'

s.toUpperCase();
s.toLowerCase();
s.indexOf("world"); // 指定字符串出现的第一个字符位置 返回7
s.indexOf("World"); // 没有找到指定的子串，返回-1
s.replace();
s.search();
s.match();

s.substring(0, 5); // 从索引0开始到5（不包括5），返回'hello'
s.substring(7); // 从索引7开始到结束，返回'world'

var str = "HELLO WORLD";
str.charAt(str.length - 1);
