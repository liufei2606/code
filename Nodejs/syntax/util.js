const util = require('util');

async function fn() {
	return 'hello world';
}
const callbackFunction = util.callbackify(fn);

callbackFunction((err, ret) => {
	if (err) throw err;
	console.log(ret);
});

function fn() {
	return Promise.reject(null);
}
const callbackFunction = util.callbackify(fn);

callbackFunction((err, ret) => {
	// 当 Promise 被以 `null` 拒绝时，被包装为 Error 并且原始值存储在 `reason` 中。
	err && err.hasOwnProperty('reason') && err.reason === null;  // true
});

function Base() {
	this.name = 'base';
	this.base = 1991;
	this.sayHello = function () {
		console.log('Hello ' + this.name);
	};
}
Base.prototype.showName = function () {
	console.log(this.name);
};
function Sub() {
	this.name = 'sub';
}
util.inherits(Sub, Base);
var objBase = new Base();
objBase.showName();
objBase.sayHello();
console.log(objBase);
var objSub = new Sub();
objSub.showName();
//objSub.sayHello();
console.log(objSub);


function Person() {
	this.name = 'byvoid';
	this.toString = function () {
		return this.name;
	};
}
var obj = new Person();
console.log(util.inspect(obj));
console.log(util.inspect(obj, true));
