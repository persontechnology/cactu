{{--  <link href="{{ asset('webcodecamjs/css/style.css') }}" rel="stylesheet">  --}}
 <script type="text/javascript" src="{{ asset('webcodecamjs/js/qrcodelib.js') }}"></script>
 <script type="text/javascript" src="{{ asset('webcodecamjs/js/webcodecamjquery.js') }}"></script>

<div id="QR-Code" class="mt-1">
    <div class="row">
        
        <div class="col-md-6 col-sm-12">
            <div class="btn-group">
                <button title="Encender" class="btn btn-success" id="play" type="button" data-toggle="tooltip">
                    <i class="fas fa-play"></i>
                </button>
                <button title="Image shoot" class="btn btn-info" disabled id="grab-img" type="button" data-toggle="tooltip">
                    <i class="fas fa-camera"></i>
                </button>
                <button title="Pausar" class="btn btn-warning" id="pause" type="button" data-toggle="tooltip">
                    <i class="fas fa-pause"></i>
                </button>
                <button title="Detener" class="btn btn-danger" id="stop" type="button" data-toggle="tooltip">
                    <i class="fas fa-stop"></i>
                </button>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <select   class="form-select form-select-lg mb-3 form-control" id="camera-select"></select>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="well" >
                <canvas class="border" style="width: 100%; height: 240;" id="webcodecam-canvas"></canvas>
                <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
            </div>
            <div class="well" style="width: 100%;">
                <label id="zoom-value" width="100">Zoom: 2</label>
                <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20">
            </div>
        </div>
        <div class="col-md-6">
            <div class="thumbnail" id="result">
                <div class="well row" style="overflow: hidden;">
                    <div class="col-md-6">
                        <label for="">Foto personal</label>
                        <img width="100%" height="240" id="scanned-img" src="">
                    </div>
                    <div class="col-md-6">
                        <label for="">Foto con familia</label>
                        <img width="100%" height="240" id="scanned-img2" src="">
                    </div>
                </div>
                <div class="caption">
                    <h3>Resultado escaneado</h3>
                    <p id="scanned-QR"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('cartas/camara.js') }}"></script>
