console.log('Hello World!');
console.log('a', 'b', 'c');
console.log(' %s + %s = %s', 1, 1, 2);

var number = 11 * 9;
var color = 'red';
console.log('%d %s balloons', number, color);
console.log(
	'%cThis text is styled!',
	'color: red; background: yellow; font-size: 24px;'
)
console.log(' %s + %s ', 1, 1, '= 2')

console.info('Something happened…');
console.warn('Something strange happened…');
console.error('Something horrible happened…');


console.time('Array initialize');
var array= new Array(1000000);
for (var i = array.length - 1; i >= 0; i--) {
  array[i] = new Object();
};
console.timeEnd('Array initialize');

console.memory // （是属性，不是函数）来检的堆大小状态
console.profile('profileName') & console.profileEnd('profileName') //

console.trace()


console.assert(list.childNodes.length < 500, '节点个数大于等于500')

console.group('一级分组');
console.log('一级分组的内容');

console.group('二级分组');
console.log('二级分组的内容');

console.groupEnd(); // 二级分组结束
console.groupEnd(); // 一级分组结束


var languages = [{
		name: "JavaScript",
		fileExtension: ".js"
	},
	{
		name: "TypeScript",
		fileExtension: ".ts"
	},
	{
		name: "CoffeeScript",
		fileExtension: ".coffee"
	}
];
console.table(languages);

console.clear() // 清空控制台

console.dir({
	f1: 'foo',
	f2: 'bar'
})
// Object
//   f1: "foo"
//   f2: "bar"
//   __proto__: Object
console.dir(obj, {
	colors: true
})

console.dirxml(document.body)

['log', 'info', 'warn', 'error'].forEach(function (method) {
	console[method] = console[method].bind(
		console,
		new Date().toISOString()
	);
});

console.log("出错了！");
// 2014-05-18T09:00.000Z 出错了！


function greet(user) {
	console.count(user);
	return "hi " + user;
}

greet('bob')
// bob: 1
// "hi bob"

greet('alice')
// alice: 1
// "hi alice"

greet('bob')
// bob: 2
// "hi bob"
