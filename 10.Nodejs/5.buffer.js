/*二进制数据缓存区，*/
var buf1 = new Buffer(256);

len = buf1.write('Hello World！', 12);

console.log('写入字节数：' + len);

console.log(buf1.toString('utf8'));

var buf = new Buffer(26);

for (var i = buf.length - 1; i >= 0; i--) {
	buf[i] = i + 97;
}
console.log(buf.toString('ascii'));
console.log(buf.toString('ascii', 5, 10));
console.log(buf.toJSON(buf));
console.log(Buffer.concat([buf, buf1]).toString());
console.log(buf.compare(buf1));
buf.copy(buf1,15,20)
console.log(buf1.toString());
var buf2 = buf.slice(5, 10);
console.log(buf2.toString());
console.log(buf2.length);
