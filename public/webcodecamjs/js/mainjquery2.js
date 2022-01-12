/*!
 * WebCodeCamJQuery 2.1.0 javascript Bar-Qr code decoder2 
 * Author: Tóth András
 * Web: http://atandrastoth.co.uk
 * email: atandrastoth@gmail.com
 * Licensed under the MIT license
 */
(function(undefined) {
    
    var decoder2 = $("#webcodecam-canvas2").WebCodeCamJQuery(args).data().plugin_WebCodeCamJQuery;
    decoder2.buildSelectMenu("#camera-select2", "environment|back").init();
    decodeLocal.on("click", function() {
        Page.decodeLocalImage();
    });
    play.on("click", function() {
        scannedQR.text("Escaneando ...");
        grabImg.removeClass("disabled");
        decoder2.play();
    });
    grabImg.on("click", function() {
        scannedImg.attr("src", decoder2.getLastImageSrc());

        decoder2.getLastImageSrc()&&pasarImagen2(decoder2.getLastImageSrc())
    });
    pause.on("click", function(event) {
        scannedQR.text("Pausado");
        decoder2.pause();
    });
    stop.on("click", function(event) {
        grabImg.addClass("disabled");
        scannedQR.text("Detenido");
        decoder2.stop();
    });
    Page.changeZoom = function(a) {
        if (decoder2.isInitialized()) {
            var value = typeof a !== "undefined" ? parseFloat(a.toPrecision(2)) : zoom.val() / 10;
            zoomValue.text(zoomValue.text().split(":")[0] + ": " + value.toString());
            decoder2.options.zoom = value;
            if (typeof a != "undefined") {
                zoom.val(a * 10);
            }
        }
    };
    Page.changeContrast = function() {
        if (decoder2.isInitialized()) {
            var value = contrast.val();
            contrastValue.text(contrastValue.text().split(":")[0] + ": " + value.toString());
            decoder2.options.contrast = parseFloat(value);
        }
    };
    Page.changeBrightness = function() {
        if (decoder2.isInitialized()) {
            var value = brightness.val();
            brightnessValue.text(brightnessValue.text().split(":")[0] + ": " + value.toString());
            decoder2.options.brightness = parseFloat(value);
        }
    };
    Page.changeThreshold = function() {
        if (decoder2.isInitialized()) {
            var value = threshold.val();
            thresholdValue.text(thresholdValue.text().split(":")[0] + ": " + value.toString());
            decoder2.options.threshold = parseFloat(value);
        }
    };
    Page.changeSharpness = function() {
        if (decoder2.isInitialized()) {
            var value = sharpness.prop("checked");
            if (value) {
                sharpnessValue.text(sharpnessValue.text().split(":")[0] + ": on");
                decoder2.options.sharpness = [0, -1, 0, -1, 5, -1, 0, -1, 0];
            } else {
                sharpnessValue.text(sharpnessValue.text().split(":")[0] + ": off");
                decoder2.options.sharpness = [];
            }
        }
    };
    Page.changeGrayscale = function() {
        if (decoder2.isInitialized()) {
            var value = grayscale.prop("checked");
            if (value) {
                grayscaleValue.text(grayscaleValue.text().split(":")[0] + ": on");
                decoder2.options.grayScale = true;
            } else {
                grayscaleValue.text(grayscaleValue.text().split(":")[0] + ": off");
                decoder2.options.grayScale = false;
            }
        }
    };
    Page.changeVertical = function() {
        if (decoder2.isInitialized()) {
            var value = flipVertical.prop("checked");
            if (value) {
                flipVerticalValue.text(flipVerticalValue.text().split(":")[0] + ": on");
                decoder2.options.flipVertical = value;
            } else {
                flipVerticalValue.text(flipVerticalValue.text().split(":")[0] + ": off");
                decoder2.options.flipVertical = value;
            }
        }
    };
    Page.changeHorizontal = function() {
        if (decoder2.isInitialized()) {
            var value = flipHorizontal.prop("checked");
            if (value) {
                flipHorizontalValue.text(flipHorizontalValue.text().split(":")[0] + ": on");
                decoder2.options.flipHorizontal = value;
            } else {
                flipHorizontalValue.text(flipHorizontalValue.text().split(":")[0] + ": off");
                decoder2.options.flipHorizontal = value;
            }
        }
    };
    Page.decodeLocalImage = function() {
        if (decoder2.isInitialized()) {
            decoder2.decodeLocalImage(imageUrl.val());
        }
        imageUrl.val(null);
    };
    var getZomm = setInterval(function() {
        var a;
        try {
            a = decoder2.getOptimalZoom();
        } catch (e) {
            a = 0;
        }
        if (!!a && a !== 0) {
            Page.changeZoom(a);
            clearInterval(getZomm);
        }
    }, 500);
    $("#camera-select2").on("change", function() {
        if (decoder2.isInitialized()) {
            decoder2.stop().play();
        }
    });
}).call(window.Page = window.Page || {});