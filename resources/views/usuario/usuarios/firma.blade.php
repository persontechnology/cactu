@extends('layouts.app',['title'=>'Actualizar usuario'])

@section('breadcrumbs', Breadcrumbs::render('editarUsuario',$usuario))


@section('content')

    
    <div class="card">
        <div class="card-header">
            Complete información
            <br>
            <label for="">Ingrese la firma<i class="text-danger">*</i></label>
        </div>
        
        <div class="card-body text-center text-info">
            <button class="btn btn-warning" onclick="remover()"><i class="icon-rotate-ccw3"></i> Remover Firma</button>
            <button type="button" onclick="procesarImagen(this);" class="btn btn-primary">{{ __('Actualizar') }} <i class="icon-paperplane ml-2"></i></button><br>
            <canvas id="sketchpad" class="border border-dark mt-2"></canvas>
        

            <img src="{{ $usuario->firma }}" class="img-fluid img-thumbnail" alt="" >

         
        <br>
    </div>
    </div>


@push('linksCabeza')
<script src="{{ asset('admin/plus/sketchpad/scripts/sketchpad.js') }}"></script>

@endpush

@prepend('linksPie')
    <script>
        $('#menuUsuarios').addClass('active');

        var sketchpad = new Sketchpad({
            element: '#sketchpad',
            width: 600,
            height: 300,
           
          });
          function color() {
                sketchpad.color = "#0b62a7";
            }
            color();
       
        function procesarImagen(arg){
            var canvas = document.getElementById('sketchpad');
            var dataURL = canvas.toDataURL();
            
            swal({
                title: "¿Confirmación?",
                text: "Procesar firma.!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                cancelButtonClass: "btn-danger",
                confirmButtonText: "¡Sí, guardar!",
                cancelButtonText:"Cancelar",
                closeOnConfirm: false
            },
            function(){
                swal.close();
                $.blockUI({message:'<h1>Espere por favor.!</h1>'});
                var urlFoto="{{ route('procesarFirma') }}";
                  var u8Image  = b64ToUint8Array(dataURL);

                  var formData = new FormData();
                  formData.append("foto", new Blob([ u8Image ], {type: "image/jpg"}));
                  formData.append("user","{{ $usuario->id }}" );                 
                  $.ajax({
                      url: urlFoto,
                      type: "POST",
                      data:formData,                  
                      processData: false,  // tell jQuery not to process the data
                      contentType: false,   // tell jQuery not to set contentType
                      success : function(data) {
                       
                        if(data.success){
                          notificar('success',data.success);
                          location.replace("{{ route('firmaUsuario',$usuario->id) }}");                                
                        }
                        if(data.error){
                          notificar('info',data.info);
                        } 
                      },
                      error : function(xhr, status) {
                         notificar("error","Ocurrio un error");
                      },
                      complete : function(jqXHR, status) {
                            $.unblockUI();
                      }
                  });             
    
            });
        }

    function remover() {
       
        sketchpad.undo()
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
</script>
    
@endprepend

@endsection
