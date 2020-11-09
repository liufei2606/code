var EventEmitter = require('events').EventEmitter;
var emitter = new EventEmitter();

var listener1 = function () {
	console.log('监听器listener1执行');
}
var listener2 = function () {
	console.log('监听器listener2执行');
}

function onlyOnce() {
	console.log("You'll never see this again");
	emitter.removeListener("some_event", onlyOnce);
}

// 添加监听事件
emitter.on('some_event', function (arg1, arg2) {
	console.log('some_event事件触发', arg1, arg2);
});
emitter.on('some_event', listener1);
emitter.once('some_event', function (msg) {
	console.log('message: ' + msg);
});
emitter.addListener('some_event', listener2);
emitter.on("some_event", onlyOnce);
var eventListeners = EventEmitter.listenerCount('some_event');
console.log(eventListeners + '个监听器监听连接事件');

// 触发事件  事件参数作为回调函数参数传递
emitter.emit('some_event', 'hello', 'world');
console.log('\n=====================\n')

// 移除事件
emitter.removeListener('some_event', listener1);
console.log('监听器1 移除不在受监听');

emitter.emit('some_event', 'hello', 'world');
eventListeners = EventEmitter.listenerCount(emitter, 'some_event');
console.log(eventListeners + '个监听器监听连接事件');

emitter.removeAllListeners("some_event");
eventListeners = EventEmitter.listenerCount(emitter, 'some_event');
console.log(eventListeners + '个监听器监听连接事件');

console.log('========通过原型部接口=============')

function Dog(name) {
	this.name = name;
}

Dog.prototype.__proto__ = EventEmitter.prototype;
// 另一种写法
// Dog.prototype = Object.create(EventEmitter.prototype);

var simon = new Dog('simon');
simon.on('bark', function () {
	console.log(this.name + ' barked');
});

setInterval(function () {
	simon.emit('bark');
}, 500);

setTimeout(function () {
	simon.removeAllListeners('bark');
}, 1000);

console.log('==========通过继承部署事件===========')

var Radio = require('./radio.js');
var station = {
	freq: '80.16',
	name: 'Rock N Roll Radio',
};

var radio = new Radio(station);

radio.on('open', function (station) {
	console.log('"%s" FM %s 打开', station.name, station.freq);
	console.log('♬ ♫♬');
});

radio.on('close', function (station) {
	console.log('"%s" FM %s 关闭', station.name, station.freq);
});

console.log('=========错误捕获============')

emitter.on('beep', function () {
	console.log('beep');
});
emitter.on('beep', function () {
	throw Error('oops!');
});
emitter.on('beep', function () {
	console.log('beep again');
});
console.log('before emit');

try {
	emitter.emit('beep');
} catch (err) {
	console.error('caught while emitting:', err.message);
}

console.log('after emit');

console.log('=========Events 默认事件类型============')

emitter.on("newListener", function (evtName) {
	console.log("New Listener: " + evtName);
});

emitter.on("removeListener", function (evtName) {
	console.log("Removed Listener: " + evtName);
});

function foo() { }

emitter.on("save-user", foo);
emitter.removeListener("save-user", foo);
