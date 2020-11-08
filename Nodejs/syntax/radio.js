var util = require('util');
var EventEmitter = require('events').EventEmitter;

var Radio = function (station) {
	var self = this;

	setTimeout(function () {
		self.emit('open', station);
	}, 0);
	setTimeout(function () {
		self.emit('close', station);
	}, 5000);

	this.on('newListener', function (listener) {
		console.log('Event Listener: ' + listener);
	});
};

// 继承 Event Emitter 接口的]方法
util.inherits(Radio, EventEmitter);
module.exports = Radio;
