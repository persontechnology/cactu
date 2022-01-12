
@extends('layouts.app',['title'=>'Registro de asistencia a actividades'])

@section('breadcrumbs', Breadcrumbs::render('registrarAsistencia',$asis))


@section('content')


@can('puedoTomarAsistencia', $asis)


<div class="card" id="QR-Code">
    <div class="card-header bg-transparent header-elements-sm-inline py-sm-0">
        Control de asistencia
        <div class="header-elements">
            <select class="form-control mr-1" id="camera-select"></select>
            <div class="btn-group">
                <button title="Encender" class="btn btn-primary" id="play" type="button" data-toggle="tooltip">
                    <i class="fas fa-play"></i>
                </button>
                <button title="Pausar" class="btn btn-warning" id="pause" type="button" data-toggle="tooltip">
                    <i class="fas fa-pause"></i>
                </button>
                <button title="Detener" class="btn btn-danger" id="stop" type="button" data-toggle="tooltip">
                    <i class="fas fa-stop"></i>
                </button>
            </div>
            
        </div>
    </div>
    
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="well" style="position: relative;display: inline-block;">
                    <canvas style="width: 100%; height: 240;" id="webcodecam-canvas"></canvas>
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
                    <div class="well" style="overflow: hidden;">
                        <img width="320" height="240" id="scanned-img" src="">
                    </div>
                    <div class="caption">
                        <h3>Resultado escaneado</h3>
                        <p id="scanned-QR"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endcan

<div class="card">
    <div id="cargaListado">
    </div>
</div>


@push('linksCabeza')

    {{-- camara --}}
    <link href="{{ asset('webcodecamjs/css/style.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('webcodecamjs/js/qrcodelib.js') }}"></script>
    <script type="text/javascript" src="{{ asset('webcodecamjs/js/webcodecamjquery.js') }}"></script>
    
@endpush

@prepend('linksPie')
    
    <script>
        $('#menuRegistroAsistencia').addClass('active');

        //camara
        var scannerLaser = $(".scanner-laser"),
            imageUrl = $("#image-url"),
            decodeLocal = $("#decode-img"),
            play = $("#play"),
            scannedImg = $("#scanned-img"),
            scannedQR = $("#scanned-QR"),
            grabImg = $("#grab-img"),
            pause = $("#pause"),
            stop = $("#stop"),
            contrast = $("#contrast"),
            contrastValue = $("#contrast-value"),
            zoom = $("#zoom"),
            zoomValue = $("#zoom-value"),
            brightness = $("#brightness"),
            brightnessValue = $("#brightness-value"),
            threshold = $("#threshold"),
            thresholdValue = $("#threshold-value"),
            sharpness = $("#sharpness"),
            sharpnessValue = $("#sharpness-value"),
            grayscale = $("#grayscale"),
            grayscaleValue = $("#grayscale-value"),
            flipVertical = $("#flipVertical"),
            flipVerticalValue = $("#flipVertical-value"),
            flipHorizontal = $("#flipHorizontal"),
            flipHorizontalValue = $("#flipHorizontal-value");
    
        var args = {
            autoBrightnessValue: 100,
            resultFunction: function(res) {
                [].forEach.call(scannerLaser, function(el) {
                    $(el).fadeOut(300, function() {
                        $(el).fadeIn(300);
                    });
                });
                scannedImg.attr("src", res.imgData);
                scannedQR.text(res.format + ": " + res.code);
                /*procesar la imagen con la asistencia server*/
                procesar(res.code,res.imgData)
            },
            getDevicesError: function(error) {
                var p, message = "Error detected with the following parameters:\n";
                for (p in error) {
                    message += (p + ": " + error[p] + "\n");
                }
                alert(message);
            },
            getUserMediaError: function(error) {
                var p, message = "Error detected with the following parameters:\n";
                for (p in error) {
                    message += (p + ": " + error[p] + "\n");
                }
                alert(message);
            },
            cameraError: function(error) {
                var p, message = "Error detected with the following parameters:\n";
                if (error.name == "NotSupportedError") {
                    var ans = confirm("Your browser does not support getUserMedia via HTTP!\n(see: https://goo.gl/Y0ZkNV).\n You want to see github demo page in a new window?");
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
            cameraSuccess: function() {
                grabImg.removeClass("disabled");
            }
        };

        function procesar(content,image){
            
            $.blockUI({message:'<h1>Espere por favor.!</h1>'});      
            var urlFoto="{{ route('guardarAsistencia') }}";
            var u8Image  = b64ToUint8Array(image);

              var formData = new FormData();
              formData.append("foto", new Blob([ u8Image ], {type: "image/jpg"}));
              formData.append("asis","{{ $asis->id }}" );
              formData.append("ninio", content);
              $.ajax({
                  url: urlFoto,
                  type: "POST",
                  data:formData,                  
                  processData: false,  // tell jQuery not to process the data
                  contentType: false,   // tell jQuery not to set contentType
                  success : function(data) {
                   
                    if(data.success){
                      notificar('success',data.success); 
                       cargaListado();             
                                           
                    }
                    if(data.info){
                        notificar('info',data.info);
                    }
                    if(data.default){
                      notificar('info',data.default);
                    } 
                  },
                  error : function(xhr, status) {
                     notificar("error","Ocurrio un error");
                  },
                  complete : function(jqXHR, status) {
                        $.unblockUI();
                  }
              });      
          
  
        }

       function b64ToUint8Array(b64Image) {
            var img = atob(b64Image.split(',')[1]);
            var img_buffer = [];
            var i = 0;
            while (i < img.length) {
                img_buffer.push(img.charCodeAt(i));
                i++;
            }
            return new Uint8Array(img_buffer);
        }


        function cargaListado(){
            $("#cargaListado" ).load( "{{ route('cargaListado',$asis->id) }}",function( response, status, xhr ){
                if ( status == "error" ) {
                    notificar('warning','No se pudo cargar el listado')
                }
            }); 
        }
        cargaListado();




        //esta  funcion esta tambien es lista
        function actualizar(arg){
            var cuentaContable=$(arg).val();
            var lista=$(arg).data('lista');

            $.blockUI({message:'<h1>Espere por favor.!</h1>'});
            $.post("{{ route('actualiuzarCuentasContablesLista') }}", { cuentaContable:cuentaContable,lista:lista})
            .done(function( data ) {
                if(data.success){
                    notificar('success',data.success);
                }
                if(data.info){
                    notificar('info',data.info);
                }
                if(data.default){
                    notificar('default',data.default);
                }
                cargaListado();
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                notificar("error","Ocurrio un error");
            });
        }


        //esta funcion esta tambien en lista
        function opcion(arg){
            
            var lista=$(arg).val();
            var opcion=$(arg).data('opcion');
            var estado="no";
            if($(arg).is(':checked')){
                estado="si";
            }

            $.blockUI({message:'<h1>Espere por favor.!</h1>'});
            $.post("{{ route('actualizarOpcionLista') }}", { lista:lista,opcion:opcion,estado:estado})
            .done(function( data ) {
                if(data.success){
                    notificar('success',data.success);
                }
                if(data.info){
                    notificar('info',data.info);
                }
                if(data.default){
                    notificar('default',data.default);
                }
                cargaListado();
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                notificar("error","Ocurrio un error");
            });
        }

        //esto esta en lista tambien
        function detalle(arg){
            var asis=$(arg).data('asis');
            var detalle=$(arg).val();
            $.post("{{ route('actualizarDetalleAsistencia') }}", { asis:asis,detalle:detalle})
            .done(function( data ) {
                if(data.success){
                    $('#msg_detalle_'+asis).addClass('text-success');
                    $('#msg_detalle_'+asis).html('Guardado exitosamente');
                }
                if(data.default){
                    $('#msg_detalle_'+asis).addClass('text-danger');
                    $('#msg_detalle_'+asis).html(data.default);
                }
                
            }).always(function(){
                
            }).fail(function(){
                $('#msg_detalle_'+asis).addClass('text-danger');
                $('#msg_detalle_'+asis).html('Ocurrio un error');
            });
        }
    </script>
    {{-- camara --}}
    <script type="text/javascript" src="{{ asset('webcodecamjs/js/mainjquery.js') }}"></script>
@endprepend

@endsection
