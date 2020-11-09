// 声明一个长度为256字节以0填充的Buffer
const buf1 = new Buffer.alloc(256);
len = buf1.write('Hello World！', 12);
console.log('写入字节数：' + len);
console.log(buf1.toString('utf8'));

// 创建一个Buffer包含ascii.
const buf2 = Buffer.from('a')
console.log(buf2, buf2.toString())

// 创建Buffer包含UTF-8字节
const buf3 = Buffer.from('中文')
console.log(buf3)

var buf = new Buffer.alloc(26);
for (var i = buf.length - 1; i >= 0; i--) {
	buf[i] = i + 97;
}
console.log(buf.toString('ascii'));
console.log(buf.toString('ascii', 5, 10));
console.log(buf.toJSON(buf));

// 方法
console.log(Buffer.concat([buf, buf1]).toString());

buf.copy(buf1, 15, 20)
console.log(buf1.toString());

const buf5 = buf.slice(5, 10);
console.log(buf5.toString());
console.log(buf2.length);


const buf4 = Buffer.from([0x1, 0x2, 0x3, 0x4, 0x5]);
const json = JSON.stringify(buf4);

// 输出: {"type":"Buffer","data":[1,2,3,4,5]}
console.log(json);

const copy = JSON.parse(json, (key, value) => {
	return value && value.type === 'Buffer' ?
		Buffer.from(value.data) :
		value;
});

// 输出: <Buffer 01 02 03 04 05>
console.log(copy);


var buffer1 = Buffer.from('ABC');
var buffer2 = Buffer.from('ABCD');
var result = buffer1.compare(buffer2);

if (result < 0) {
	console.log(buffer1 + " 在 " + buffer2 + "之前");
} else if (result == 0) {
	console.log(buffer1 + " 与 " + buffer2 + "相同");
} else {
	console.log(buffer1 + " 在 " + buffer2 + "之后");
}
