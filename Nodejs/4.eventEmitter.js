var EventEmitter = require('events').EventEmitter;
var event = new EventEmitter();

event.on('some_event', function(arg1, arg2) {
	console.log('some_event事件触发', arg1, arg2);
});
event.on('some_event', function(arg1, arg2) {
	console.log('some_event同步', arg1, arg2);
});

var listener1 = function() {
	console.log('监听器listener1执行');
}

var listener2 = function() {
	console.log('监听器listener2执行');	
}

event.on('some_event', listener1);

event.addListener('some_event', listener2);

var eventListeners = require('events').EventEmitter.listenerCount(event, 'some_event');

console.log(eventListeners + '个监听器监听连接事件');


event.emit('some_event', 'hello', 'world');


event.removeListener('some_event', listener1);
console.log('监听器1 不在受监听');


event.emit('some_event', 'hello', 'world');

eventListeners = require('events').EventEmitter.listenerCount(event, 'some_event');

console.log(eventListeners + '个监听器监听连接事件');
console.log('程序执行完毕');
