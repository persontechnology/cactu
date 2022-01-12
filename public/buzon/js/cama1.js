var controls = document.querySelector('.controls');
var cameraOptions = document.querySelector('.video-options>select');
var video = document.querySelector('.video1');
var canvas = document.querySelector('.canvas1');
var screenshotImage = document.querySelector('.image1');
var screenshotImageFoto = document.querySelector('#imagenfoto');
var buttons = [...controls.querySelectorAll('a')];
var streamStarted = false;
var [play, pause, screenshot] = buttons;
var constraints = {
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

var getCameraSelection = async() => {
    var devices = await navigator.mediaDevices.enumerateDevices();
    var videoDevices = devices.filter(device => device.kind === 'videoinput');
    var options = videoDevices.map(videoDevice => {
        return `<option value="${videoDevice.deviceId}">${videoDevice.label}</option>`;
    });
    cameraOptions.innerHTML = options.join('');
};

play.onclick = () => {

    if (streamStarted) {
        video.play();
        play.classList.add('d-none');
        pause.classList.remove('d-none');
        return;
    } else {
        // $('.mesageError').html('¡¡La API de síntesis de voz no está soportada en este navegador!!. Usa Firefox, Chrome o algún navegador moderno...')

    }
    if ('mediaDevices' in navigator && navigator.mediaDevices.getUserMedia) {
        var updatedConstraints = {
            ...constraints,
            deviceId: {
                exact: cameraOptions.value
            }
        };
        startStream(updatedConstraints);
    }
};

var startStream = async(constraints) => {
    var stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleStream(stream);
};

var handleStream = (stream) => {
    video.srcObject = stream;
    play.classList.add('d-none');
    pause.classList.remove('d-none');
    screenshot.classList.remove('d-none');
    streamStarted = true;
};

getCameraSelection();

cameraOptions.onchange = () => {
    const updatedConstraints = {
        ...constraints,
        deviceId: {
            exact: cameraOptions.value
        }
    };
    startStream(updatedConstraints);
};

function apagar(params) {

}

var pauseStream = () => {
    video.pause();
    play.classList.remove('d-none');
    pause.classList.add('d-none');
};


pause.onclick = pauseStream;
screenshot.onclick = doScreenshot;

//validar
$("#formPresentacionMenores").validate({
    rules: {
        hola: {
            required: true,
            maxlength: 35,
            minlength: 5
        },
        escribo: {
            required: true,
            maxlength: 40,
            minlength: 5
        },
        mi: {
            required: true,
            maxlength: 40,
            minlength: 5
        },
        queel: {
            required: true,
            maxlength: 30,
            minlength: 5
        },
        cumple: {
            required: true,
            maxlength: 20,
            minlength: 5
        },
        noSabe: {
            required: true,
            maxlength: 150,
            minlength: 5
        },
        ademas: {
            required: true,
            maxlength: 20,
            minlength: 5
        },
        leGusta: {
            required: true,
            maxlength: 150,
            minlength: 5
        },
        dondeAprendo: {
            required: true,
            maxlength: 150,
            minlength: 5
        },
        gustaAprendes: {
            required: true,
            maxlength: 150,
            minlength: 5
        },
        mePaso: {
            required: true,
            maxlength: 150,
            minlength: 5
        },
        meGustaria: {
            required: true,
            maxlength: 150,
            minlength: 5
        },
        miNombre: {
            required: true,
            maxlength: 50,
            minlength: 5
        },
        ysoy: {
            required: true,
            maxlength: 20,
            minlength: 5
        },
        de: {
            required: true,
            maxlength: 50,
            minlength: 5
        },
        mifamila: {
            required: true,
            maxlength: 150,
            minlength: 5
        },
        nuestraPro: {
            required: true,
            maxlength: 20,
            minlength: 5
        },
        idioma: {
            required: true,
            maxlength: 20,
            minlength: 5
        },
        lugarFavorito: {
            required: true,
            maxlength: 150,
            minlength: 5
        },
        comidaTipica: {
            required: true,
            maxlength: 150,
            minlength: 5
        },
        ya: {
            required: true,
            maxlength: 50,
            minlength: 5
        },
        comer: {
            required: true,
            maxlength: 90,
            minlength: 5
        },
        masMeGusta: {
            required: true,
            maxlength: 100,
            minlength: 5
        },
        pregunta: {
            required: true,
            maxlength: 150,
            minlength: 5
        },
        despedida: {
            required: true,
            maxlength: 150,
            minlength: 5
        }
    }
})
var validarMayores = $("#formPresentacionMayo").validate({
    rules: {
        hola: {
            required: true,
            maxlength: 35,
            minlength: 5
        },

        soy: {
            required: true,
            maxlength: 35,
            minlength: 5
        },
        meDicen: {
            required: true,
            maxlength: 10,
            minlength: 3
        },
        edad: {
            required: true,
            maxlength: 10,
            minlength: 5
        },
        miMejorAmigo: {
            required: true,
            maxlength: 20,
            minlength: 5
        },
        esMejorAmigo: {
            required: true,
            maxlength: 70,
            minlength: 5
        },
        loquehago: {
            required: true,
            maxlength: 70,
            minlength: 5
        },

        miSueno: {
            required: true,
            maxlength: 70,
            minlength: 5
        },
        dondeAprendo: {
            required: true,
            maxlength: 70,
            minlength: 5
        },
        gustaAprendes: {
            required: true,
            maxlength: 70,
            minlength: 5
        },

        mePaso: {
            required: true,
            maxlength: 130,
            minlength: 5
        },
        meGustaria: {
            required: true,
            maxlength: 100,
            minlength: 5
        },
        miFamilia: {
            required: true,
            maxlength: 150,
            minlength: 5
        },

        nuestraPro: {
            required: true,
            maxlength: 15,
            minlength: 5
        },
        idioma: {
            required: true,
            maxlength: 10,
            minlength: 5
        },
        lugarFavorito: {
            required: true,
            maxlength: 30,
            minlength: 5
        },
        comidaTipica: {
            required: true,
            maxlength: 80,
            minlength: 5
        },
        comer: {
            required: true,
            maxlength: 50,
            minlength: 5
        },
        masMeGusta: {
            required: true,
            maxlength: 50,
            minlength: 5
        },
        pregunta: {
            required: true,
            maxlength: 100,
            minlength: 5
        },
        despedida: {
            required: true,
            maxlength: 150,
            minlength: 5
        },

    }
});