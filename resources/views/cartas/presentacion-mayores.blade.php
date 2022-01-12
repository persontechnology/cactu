
    <p>Fecha {{ \Carbon\Carbon::parse(now())->format('d/M/Y') }}</p>
    <form action="{{ route('registroPerMayosUno') }}" method="POST" id="formPresentacionMayo" enctype="multipart/form-data">

        @csrf

        <input type="hidden" required name="getIp" id="getIp" value="{{ Crypt::encryptString($buzonCarta->id) }}">
        <input type="hidden" required name="token" id="token" value="{{ Crypt::encryptString($buzonCarta->buzon->ninio->token) }}">
        <input type="hidden" required name="op" id="op" value="{{ Crypt::encryptString('mayor') }}">

        <div class="mb-2">
            <label for="hola">Hola</label>
            <input type="text" required name="hola" id="hola" class="form-control input "
                placeholder="Ingresa el nombre de tu patrocinador">
        </div>
        


        <div class="mb-2">
            <label for="soy">Soy</label>
            <input type="text" required name="soy" id="soy" class="form-control input "
                placeholder="Ingresa tu nombre">

        </div>
        <div class="mb-2">
            <label for="meDicen">y mis amigos me dicen</label>
            <input type="text" required name="meDicen" id="meDicen" class="form-control input "
                placeholder="Como te dicen">

        </div>
        <div class="mb-2">
            <label for="edad">tengo</label>
            <input type="text" required name="edad" id="edad" class="form-control input "
                placeholder="Ingresa tu edad Ejm: 11 años">

        </div>
        <div class="mb-2">
            <label for="miMejorAmigo">Mi mejor amigo se llama</label>
            <input type="text" required name="miMejorAmigo" id="miMejorAmigo" class="form-control input "
                placeholder="Como se llama tu mejor amigo ">

        </div>
        <div class="mb-2">
            <label for="esMejorAmigo">es mi mejor amigo porque,</label>
            <textarea required name="esMejorAmigo" id="esMejorAmigo" rows="3"
                class="form-control textarea no-resize"></textarea>

        </div>
        <div class="mb-2">
            <label for="loquehago">Lo que maś me gusta hacer es,</label>
            <textarea required name="loquehago" id="loquehago" rows="3"
                class="form-control textarea no-resize"></textarea>

        </div>

        <div class="mb-2">
            <label for="miSueno">Cuando sea grande <br> mi sueño es</label>
            <textarea type="text" required name="miSueno" id="miSueno" class="form-control textarea no-resize"
                rows="3"></textarea>


        </div>
        <div class="mb-2">
            <label for="dondeAprendo">El lugar donde aprendo es,</label>
            <textarea type="text" required name="dondeAprendo" id="dondeAprendo"
                class="form-control textarea no-resize" rows="3"></textarea>

        </div>
        <div class="mb-2">
            <label for="gustaAprendes">lo que me gusta aprender es,</label>
            <textarea type="text" required name="gustaAprendes" id="gustaAprendes"
                class="form-control textarea no-resize " rows="3"></textarea>

        </div>

        <div class="mb-2">
            <label for="mePaso">Lo más importante que me pasó últimamente es</label>
            <textarea type="text" required name="mePaso" id="mePaso" class="form-control textarea no-resize" rows="3"></textarea>
        </div>
        <div class="mb-2">
            <label for="meGustaria">Lo que me gustaría aprender en el programa de ChildFund es</label>
            <textarea type="text" required name="meGustaria" id="meGustaria" class="form-control textarea no-resize" rows="3"></textarea>
        </div>
        <div class="mb-2">
            <label for="miFamilia">Esta es mi famila</label>
            <textarea type="text" required name="miFamilia" id="miFamilia" class="form-control textarea no-resize" rows="3"></textarea>
        </div>
       
        <p>También quiero contarte del lugar donde vivo</p>
        <div class="mb-2">
            <label for="nuestraPro">Nuestra provincia se llama</label>
            <input type="text" required name="nuestraPro" id="nuestraPro" class="form-control input ">

        </div>
        <div class="mb-2">
            <label for="idioma">y el idioma que hablamos es</label>
            <input type="text" required name="idioma" id="idioma" class="form-control input ">

        </div>
        <p>Donde nosotros vivimos hay sitios muy hermosos,</p>
        <div class="mb-2">
            <label for="lugarFavorito">mi lugar favorito es</label>
            <input type="text" required name="lugarFavorito" id="lugarFavorito" class="form-control input ">

        </div>
        <p>También tenemos comida típica, por ejemplo</p>
        <div class="mb-2">
            <label for="comidaTipica">comidaTipica</label>
            <textarea type="text" required name="comidaTipica" id="comidaTipica" class="form-control textarea no-resize" rows="3"></textarea>
        </div>
        <div class="mb-2">
            <label for="comer">y a mi me gusta comer</label>
            <input type="text" required name="comer" id="comer" class="form-control input ">
        </div>
        <div class="mb-2">
            <label for="masMeGusta">De nuestras tradiciones, lo que más me gusta es</label>
            <textarea type="text" required name="masMeGusta" id="masMeGusta" class="form-control textarea no-resize" rows="3"></textarea>
        </div>
        <div class="mb-2">
            <label for="pregunta">Me gustaría hacerte una pregunta</label>
            <textarea type="text" required name="pregunta" id="pregunta" class="form-control textarea no-resize" rows="3"></textarea>
        </div>
        <div class="mb-2">
            <label for="despedida">Cuéntale por qué quisieras que te conteste tu patrocinador, envíale un mensaje de despedida</label>
            <textarea type="text" required name="despedida" id="despedida" class="form-control textarea no-resize" rows="3"></textarea>
        </div>

        @include('cartas.camara-dos')

        <button type="submit" class="btn btn-primary">
            Responder <i class="icon-paperplane ml-2"></i>
        </button>

        
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

        $("#formPresentacionMayo").submit(function(e) {
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
    

