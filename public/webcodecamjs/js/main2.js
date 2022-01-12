/*!
 * WebCodeCamJS 2.1.0 javascript Bar code and QR code decoder2 
 * Author: Tóth András
 * Web: http://atandrastoth.co.uk
 * email: atandrastoth@gmail.com
 * Licensed under the MIT license
 */
(function(undefined) {
    "use strict";

    function Q(el) {
        if (typeof el === "string") {
            var els = document.querySelectorAll(el);
            return typeof els === "undefined" ? undefined : els.length > 1 ? els : els[0];
        }
        return el;
    }
    var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
    var scannerLaser2 = Q(".scanner-laser2"),
        imageUrl2 = new Q("#image-url2"),
        play2 = Q("#play2"),
        scannedImg2 = Q("#scanned-img2"),
        scannedQR2 = Q("#scanned-QR2"),
        grabImg2 = Q("#grab-img2"),
        decodeLocal2 = Q("#decode-img2"),
        pause2 = Q("#pause2"),
        stop2 = Q("#stop2"),
        contrast2 = Q("#contrast2"),
        contrastValue2 = Q("#contrast-value2"),
        zoom2 = Q("#zoom2"),
        zoomValue2 = Q("#zoom-value2"),
        brightness2 = Q("#brightness2"),
        brightnessValue2 = Q("#brightness-value2"),
        threshold2 = Q("#threshold2"),
        thresholdValue2 = Q("#threshold-value2"),
        sharpness2 = Q("#sharpness2"),
        sharpnessValue2 = Q("#sharpness-value2"),
        grayscale2 = Q("#grayscale2"),
        grayscaleValue2 = Q("#grayscale-value2"),
        flipVertical2 = Q("#flipVertical2"),
        flipVerticalValue2 = Q("#flipVertical-value2"),
        flipHorizontal2 = Q("#flipHorizontal2"),
        flipHorizontalValue2 = Q("#flipHorizontal-value2");
    var args2 = {
        autoBrightnessValue: 100,
        resultFunction2: function(res) {
            [].forEach.call(scannerLaser2, function(el) {
                fadeOut(el, 0.5);
                setTimeout(function() {
                    fadeIn(el, 0.5);
                }, 300);
            });
            scannedImg2.src = res.imgData;
            scannedQR2[txt] = res.format + ": " + res.code;
        },
        getDevicesError2: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            for (p in error) {
                message += p + ": " + error[p] + "\n";
            }
            alert(message);
        },
        getUserMediaError2: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            for (p in error) {
                message += p + ": " + error[p] + "\n";
            }
            alert(message);
        },
        cameraError2: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            if (error.name == "NotSupportedError") {
                var ans = confirm("Your browser does not support getUserMedia via HTTP!\n(see: https:goo.gl/Y0ZkNV).\n You want to see github demo page in a new window?");
                if (ans) {
                    window.open("https://andrastoth.github.io/webcodecamjs/");
                }
            } else {
                for (p in error) {
                    message += p + ": " + error[p] + "\n";
                }
                alert(message);
            }
        },
        cameraSuccess2: function() {
            grabImg2.classList.remove("disabled");
        }
    };
    var decoder2 = new WebCodeCamJS("#webcodecam-canvas2").buildSelectMenu("#camera-select2", "environment|back").init(args);
    decodeLocal2.addEventListener("click", function() {
        Page.decodeLocalImage();
    }, false);
    play2.addEventListener("click", function() {
        if (!decoder2.isInitialized()) {
            scannedQR2[txt] = "Scanning ...";
        } else {
            scannedQR2[txt] = "Scanning ...";
            decoder2.play();
        }
    }, false);
    grabImg2.addEventListener("click", function() {
        if (!decoder2.isInitialized()) {
            return;
        }
        var src = decoder2.getLastImageSrc();
        scannedImg2.setAttribute("src", src);
    }, false);
    pause2.addEventListener("click", function(event) {
        scannedQR2[txt] = "Paused";
        decoder2.pause();
    }, false);
    stop2.addEventListener("click", function(event) {
        grabImg2.classList.add("disabled");
        scannedQR2[txt] = "Stopped";
        decoder2.stop();
    }, false);
    Page.changeZoom2 = function(a) {
        if (decoder2.isInitialized()) {
            var value = typeof a !== "undefined" ? parseFloat(a.toPrecision(2)) : zoom2.value / 10;
            zoomValue2[txt] = zoomValue2[txt].split(":")[0] + ": " + value.toString();
            decoder2.options.zoom = value;
            if (typeof a != "undefined") {
                zoom2.value = a * 10;
            }
        }
    };
    Page.changeContrast2 = function() {
        if (decoder2.isInitialized()) {
            var value = contrast.value;
            contrastValue[txt] = contrastValue[txt].split(":")[0] + ": " + value.toString();
            decoder2.options.contrast = parseFloat(value);
        }
    };
    Page.changeBrightness2 = function() {
        if (decoder2.isInitialized()) {
            var value = brightness2.value;
            brightnessValue2[txt] = brightnessValue2[txt].split(":")[0] + ": " + value.toString();
            decoder2.options.brightness = parseFloat(value);
        }
    };
    Page.changeThreshold2 = function() {
        if (decoder2.isInitialized()) {
            var value = threshold2.value;
            thresholdValue2[txt] = thresholdValue2[txt].split(":")[0] + ": " + value.toString();
            decoder2.options.threshold = parseFloat(value);
        }
    };
    Page.changeSharpness2 = function() {
        if (decoder2.isInitialized()) {
            var value = sharpness2.checked;
            if (value) {
                sharpnessValue2[txt] = sharpnessValue2[txt].split(":")[0] + ": on";
                decoder2.options.sharpness = [0, -1, 0, -1, 5, -1, 0, -1, 0];
            } else {
                sharpnessValue2[txt] = sharpnessValue2[txt].split(":")[0] + ": off";
                decoder2.options.sharpness = [];
            }
        }
    };
    Page.changeVertical2 = function() {
        if (decoder2.isInitialized()) {
            var value = flipVertical2.checked;
            if (value) {
                flipVerticalValue2[txt] = flipVerticalValue2[txt].split(":")[0] + ": on";
                decoder2.options.flipVertical = value;
            } else {
                flipVerticalValue2[txt] = flipVerticalValue2[txt].split(":")[0] + ": off";
                decoder2.options.flipVertical = value;
            }
        }
    };
    Page.changeHorizontal2 = function() {
        if (decoder2.isInitialized()) {
            var value = flipHorizontal2.checked;
            if (value) {
                flipHorizontalValue2[txt] = flipHorizontalValue2[txt].split(":")[0] + ": on";
                decoder2.options.flipHorizontal = value;
            } else {
                flipHorizontalValue2[txt] = flipHorizontalValue2[txt].split(":")[0] + ": off";
                decoder2.options.flipHorizontal = value;
            }
        }
    };
    Page.changeGrayscale2 = function() {
        if (decoder2.isInitialized()) {
            var value = grayscale2.checked;
            if (value) {
                grayscaleValue2[txt] = grayscaleValue2[txt].split(":")[0] + ": on";
                decoder2.options.grayScale = true;
            } else {
                grayscaleValue2[txt] = grayscaleValue2[txt].split(":")[0] + ": off";
                decoder2.options.grayScale = false;
            }
        }
    };
    Page.decodeLocalImage2 = function() {
        if (decoder2.isInitialized()) {
            decoder2.decodeLocalImage(imageUrl2.value);
        }
        imageUrl2.value = null;
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

    function fadeOut(el, v) {
        el.style.opacity = 1;
        (function fade() {
            if ((el.style.opacity -= 0.1) < v) {
                el.style.display = "none";
                el.classList.add("is-hidden");
            } else {
                requestAnimationFrame(fade);
            }
        })();
    }

    function fadeIn(el, v, display) {
        if (el.classList.contains("is-hidden")) {
            el.classList.remove("is-hidden");
        }
        el.style.opacity = 0;
        el.style.display = display || "block";
        (function fade() {
            var val = parseFloat(el.style.opacity);
            if (!((val += 0.1) > v)) {
                el.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    }
    document.querySelector("#camera-select2").addEventListener("change", function() {
        if (decoder2.isInitialized()) {
            decoder2.stop().play();
        }
    });
}).call(window.Page = window.Page || {});