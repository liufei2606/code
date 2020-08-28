'use strict';

const mediaStreamContrains = {
    video: {
        width: 1280,
        height: 720,
        frameRate: 15,
    },
    audio: false
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
    // return;
}

// 枚举 cameras and microphones.
navigator.mediaDevices.enumerateDevices()
    .then(function(deviceInfos) {
        //打印出每一个设备的信息
        deviceInfos.forEach(function(deviceInfo) {
            console.log(deviceInfo.kind + ": " + deviceInfo.label + " id = " + deviceInfo.deviceId);
        });
    })
    .catch(function(err) {
        console.log(err.name + ": " + err.message);
    });

navigator.mediaDevices.getUserMedia(mediaStreamContrains).then(
    getLocalMediaStream
).catch(
    handleLocalMediaStreamError
);

var picture = document.querySelector('canvas#picture');
picture.width = 640;
picture.height = 480;

picture.getContext('2d').drawImage(localVideo, 0, 0, picture.width, picture.height);

function downLoad(url) {
    var oA = document.createElement("a");
    oA.download = 'photo';
    oA.href = url;
    document.body.appendChild(oA);
    oA.click();
    oA.remove();
}

document.querySelector("button#save").onclick = function() {
    downLoad(picture.toDataURL("image/jpeg"));
}

var filtersSelect = document.querySelector('select#filter');
picture.className = filtersSelect.value;