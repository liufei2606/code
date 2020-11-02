'use strict';

const mediaStreamContrains = {
	video: {
		width: 1280,
		height: 720,
		frameRate: 15,
	},
	audio: { echoCancellation: true, noiseSuppression: true, autoGainControl: true }
};

const localVideo = document.querySelector('video');

function getLocalMediaStream(mediaStream) {
	localVideo.srcObject = mediaStream;
}

function handleLocalMediaStreamError(error) {
	console.log('navigator.getUserMedia error: ', error);
}

if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) {
	console.log("enumerateDevices() not supported.");
}

// 枚举 cameras and microphones.
navigator.mediaDevices.enumerateDevices()
	.then(function (deviceInfos) {
		//打印出每一个设备的信息
		deviceInfos.forEach(function (deviceInfo) {
			console.log(deviceInfo.kind + ": " + deviceInfo.label + " id = " + deviceInfo.deviceId);
		});
	})
	.catch(function (err) {
		console.log(err.name + ": " + err.message);
	});

navigator.mediaDevices.getUserMedia(mediaStreamContrains).then(
	getLocalMediaStream
).catch(
	handleLocalMediaStreamError
);
