   
    
    @if($buzonCarta->buzon->estado=='Respondida' || $buzonCarta->estado=='Respondida')
        <div class="alert alert-primary" role="alert">
            <strong>Esta carta ya fue respondida</strong>
        </div>
        
    @else
    <div>
        <p style="float: right">Ecuador {{ \Carbon\Carbon::parse(now())->format('d/M/Y') }} </p>
        <p>Mínimo: 400, Máximo: 680 caracteres</p>
        <form action="{{ route('registroDeotrasCartas') }}" method="POST" id="formularioContestacion" enctype="multipart/form-data">
            @csrf
            <input type="hidden" required name="getIp" id="getIp" value="{{ Crypt::encryptString($buzonCarta->id) }}"
                class="form-control " placeholder="Ingresa el nombre a quién escribes">
            <input type="hidden" required name="token" id="token"
                value="{{ Crypt::encryptString($buzonCarta->buzon->ninio->token) }}" class="form-control "
                placeholder="Ingresa el nombre a quién escribes">
        
                <textarea class="form-control" id="respuesta" name="respuesta" placeholder="Redacte aquí..." id="exampleFormControlTextarea1" rows="5">{{ $buzonCarta->respuesta }}</textarea>
            @php
                $img=Storage::url($buzonCarta->imagen);
            @endphp
            
                @include('cartas.camara')

        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Enviar carta</button>
        </form>
    </div>
    @endif




<script>
    var  imagenCapturada=null;
    {{--  esto biene desde camara.js  --}}
    function procesarImagen(arg){
        $("#scanned-img").attr("src", arg);
        imagenCapturada=b64ToUint8Array(arg);
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
 

    $("#formularioContestacion").submit(function(e) {
        e.preventDefault();        
        
        var form = new FormData($(this)[0]);
        form.append("foto", new Blob([ imagenCapturada ], {type: "image/jpg"}));
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data:form,                  
            processData: false, 
            contentType: false,
            success : function(data) {
             if(data.success){
                notificar('success',data.success)
             }else{
                notificar('info',data.info)
             }

            },
            error : function(data) {
                var errors = data.responseJSON;
                errorsHtml = '';
                $.each(errors.errors,function (k,v) {
                        errorsHtml +=v ;
                });
                notificar('info',errorsHtml)
            },
            complete : function(jqXHR, status) {
                console.log(jqXHR)
            }
        });


    });

</script>
