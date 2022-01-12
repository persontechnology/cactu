//Camara dos

var controls1 = document.querySelector('.controls1');
var cameraOptions1 = document.querySelector('.video-options1>select');
var video1 = document.querySelector('.video2');
var canvas1 = document.querySelector('.canvas2');
var screenshotImage1 = document.querySelector('.imagen2');
var screenshotImageFoto1 = document.querySelector('#imagenfoto2');
var buttons1 = [...controls1.querySelectorAll('a')];
var streamStarted1 = false;
var [play1, pause1, screenshot1] = buttons1;
var constraints1 = {
    video: {
        width: {
            min: 1280,
            ideal: 1920,
            max: 2560,
        },
        height: {
            min: 720,
            ideal: 1080,
            max: 1440
        },
    }
};
var getCameraSelection1 = async() => {
    var devices = await navigator.mediaDevices.enumerateDevices();
    var videoDevices = devices.filter(device => device.kind === 'videoinput');
    var options = videoDevices.map(videoDevice => {
        return `<option value="${videoDevice.deviceId}">${videoDevice.label}</option>`;
    });
    cameraOptions1.innerHTML = options.join('');
};
play1.onclick = () => {
    if (streamStarted1) {
        video1.play();
        play1.classList.add('d-none');
        pause1.classList.remove('d-none');
        return;
    }
    if ('mediaDevices' in navigator && navigator.mediaDevices.getUserMedia) {
        var updatedConstraints = {
            ...constraints1,
            deviceId: {
                exact: cameraOptions1.value
            }
        };

        startStream1(updatedConstraints);
    }
};
//se prende la camara
var startStream1 = async(constraints1) => {
    var stream = await navigator.mediaDevices.getUserMedia(constraints1);
    handleStream1(stream);
};
var handleStream1 = (stream) => {
    video1.srcObject = stream;
    play1.classList.add('d-none');
    pause1.classList.remove('d-none');
    screenshot1.classList.remove('d-none');
    streamStarted1 = true;
};
getCameraSelection1();
cameraOptions1.onchange = () => {
    var updatedConstraints = {
        ...constraints1,
        deviceId: {
            exact: cameraOptions1.value
        }
    };
    startStream1(updatedConstraints);

};
var pauseStream1 = () => {
    video1.pause();
    play1.classList.remove('d-none');
    pause1.classList.add('d-none');
};
pause1.onclick = pauseStream1;
screenshot1.onclick = doScreenshot1;