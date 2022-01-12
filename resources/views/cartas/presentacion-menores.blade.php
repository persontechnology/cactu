<p>Fecha {{ \Carbon\Carbon::parse(now())->format('d/M/Y') }}</p>
<form action="{{ route('registroPerMayosUno') }}" method="POST" id="formPresentacionMenores" enctype="multipart/form-data">
    @csrf
    <input type="hidden" required name="getIp" id="getIp" value="{{ Crypt::encryptString($buzonCarta->id) }}">
    <input type="hidden" required name="token" id="token" value="{{ Crypt::encryptString($buzonCarta->buzon->ninio->token) }}">
    <input type="hidden" required name="op" id="op" value="{{ Crypt::encryptString('menor') }}">

    <div class="mb-2">
        <label for="hola">Hola</label>
        <input type="text" required name="hola" id="hola" class="form-control input " placeholder="Ingresa el nombre a quién escribes">
    </div>
    <div class="mb-2">
        <label for="escribo">Escribo a nombre de</label>
        <input type="text" required name="escribo" id="escribo" class="form-control input " placeholder="Ingresa el nombre de quien representa">
    </div>
    <div class="mb-2">
        <label for="mi">mi</label>
        <input type="text" required name="mi" id="mi" class="form-control input " placeholder="Ingresa el parentesco">
    </div>
    <div class="mb-2">
        <label for="queel">, que el </label>
        <input type="text" required name="queel" id="queel" class="form-control input " placeholder="fecha">
    </div>
    <div class="mb-2">
        <label for="cumple">Cumple</label>
        <input type="text" required name="cumple" id="cumple" class="form-control input " placeholder="Cuantos años">
    </div>
    <div class="mb-2">
        <label for="noSabe">de edad y aún no sabe escribir pero</label>
        <textarea required name="noSabe" id="noSabe" rows="3" class="form-control input "></textarea>
    </div>

    <div class="mb-2">
        <label for="ademas">Además a</label>
        <input type="text" required name="ademas" id="ademas" class="form-control input ">
    </div>

    <div class="mb-2">
        <label for="leGusta">le gusta</label>
        <textarea required name="leGusta" id="leGusta" rows="3" class="form-control input "></textarea>
    </div>

    <div class="mb-2">
        <label for="dondeAprendo">El lugar  donde aprende es</label>
        <textarea type="text" required name="dondeAprendo" id="dondeAprendo" class="form-control input " rows="3"></textarea>
    </div>
    <div class="mb-2">
        <label for="gustaAprendes">En este  mes aprendimos</label>
        <textarea type="text" required name="gustaAprendes" id="gustaAprendes" class="form-control input " rows="3"></textarea>
    </div>
    
    <div class="mb-2">
        <label for="mePaso">y lo más importante que nos pasó últimamente es</label>
        <textarea type="text" required name="mePaso" id="mePaso" class="form-control input " rows="3"></textarea>
    </div>

    <div class="mb-2">
        <label for="meGustaria">Lo que esperamos aprender con el programa de ChildFund es</label>
        <textarea type="text" required name="meGustaria" id="meGustaria" class="form-control input " rows="3"></textarea>
    </div>
    <div class="mb-2">
        <label for="miNombre">Mi nombre es</label>
        <input type="text" required name="miNombre" id="miNombre" class="form-control input ">
    </div>
    <div class="mb-2">
        <label for="ysoy">y soy</label>
        <input type="text" required name="ysoy" id="ysoy" class="form-control input ">
    </div>
    <div class="mb-2">
        <label for="de">de</label>
        <input type="text" required name="de" id="de" class="form-control input ">
    </div>
    <div class="md-2">
        <label for="mifamilia">Los otros miembros de nuestra familia son</label>
        <textarea type="text" required name="mifamila" id="mifamila" class="form-control input " rows="3"></textarea>
    </div>

    <div class="mb-2">
        <label for="nuestraPro">Nosotros vivimos  en la provincia de</label>
        <input type="text" required name="nuestraPro" id="nuestraPro" class="form-control input ">
    </div>
    <div class="mb-2">
        <label for="idioma">y el idioma que hablamos es</label>
        <input type="text" required name="idioma" id="idioma" class="form-control input ">
    </div>
    
    <div class="mb-2">
        <label for="lugarFavorito">Nuestra provincia tiene sitios muy hermosos, a nosotros nos gusta ir a</label>
        <input type="text" required name="lugarFavorito" id="lugarFavorito" class="form-control input ">
    </div>
    
    <div class="mb-2">
        <label for="comidaTipica">También tenemos comida típica, por ejemplo</label>
        <textarea type="text" required name="comidaTipica" id="comidaTipica" class="form-control input " rows="3"></textarea>
    </div>
    <div class="mb-2">
        <label for="ya">y a </label>
        <input type="text" required name="ya" id="ya" class="form-control input ">
    </div>
    <div class="mb-2">
        <label for="comer">le gusta</label>
        <input type="text" required name="comer" id="comer" class="form-control input ">
    </div>
    <div class="mb-2">
        <label for="masMeGusta">De nuestras tradiciones, la que compartimos juntos es</label>
        <textarea type="text" required name="masMeGusta" id="masMeGusta" class="form-control input " rows="3"></textarea>
    </div>
    <div class="mb-2">
        <label for="pregunta">Nos gustaría saber más sobre ti y tu familia y hacerles una pregunta</label>
        <textarea type="text" required name="pregunta" id="pregunta" class="form-control input " rows="3"></textarea>
    </div>
    <div class="mb-2">
        <label for="despedida">Cuéntale por qué quisieras que te conteste tu patrocinador, envíale un mensaje de despedida </label>
        <textarea type="text" required name="despedida" id="despedida" class="form-control input " rows="3"></textarea>
    </div>
    @include('cartas.camara-dos')
    <button type="submit" class="btn btn-primary">Responder<i class="icon-paperplane ml-2"></i></button>
</form>

<script>
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
    
    var orden=0;
    var imagenCapturada=null;
    var imagenCapturada2=null;
    function procesarImagen(img){
        switch (orden) {
            case 0:
                $("#scanned-img").attr("src", img);
                orden=1;
                imagenCapturada=b64ToUint8Array(img);
              break;
            case 1:
                $("#scanned-img2").attr("src", img);
                orden=0;
                imagenCapturada2=b64ToUint8Array(img);
              break;
          }
    }

    $("#formPresentacionMenores").submit(function(e) {
        e.preventDefault();      
        
        var form = new FormData($(this)[0]);
        form.append("fotoPersonal", new Blob([ imagenCapturada ], {type: "image/jpg"}));
        form.append("fotoFamiliar", new Blob([ imagenCapturada2 ], {type: "image/jpg"}));
        $.blockUI({ message: '  <i class="fas fa-circle-notch fa-spin fa-3x text-primary"></i>' });        
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data:form,                  
            processData: false, 
            contentType: false,
            success: function(data) {
                console.log(data)
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
                $.unblockUI();
            }
        });


    });

</script>
