

<div class="container">
    <br>
    <br>

    @php
    $date = (\Carbon\Carbon::now());
    @endphp
    <div class="card p-3">
        <p>Fecha {{ \Carbon\Carbon::parse($date)->format('d/M/Y')}}</p>
    
        <div class="golden-forms">
            <form action="#">
                <span class="text-danger">Este formulario es de ayuda recuerda llenar con tus datos</span>
                <div class="input-group input-group-sm mb-3 rounded-round">   
                    <div class="input-group-prepend">   
                        <span class="input-group-text" id="small">Hola</span> 
                    </div>   
                    <input type="text" required name="hola" id="hola" class="form-control input " >
                </div>
                <div class="input-group input-group-sm mb-3 rounded-round">   
                    <div class="input-group-prepend">   
                        <span class="input-group-text" id="small">Escribo a nombre de</span> 
                    </div>   
                    <input type="text" required name="escribo" id="escribo" value="Anita" class="form-control input " >
                </div>
                <div class="input-group input-group-sm mb-3 rounded-round">   
                    <div class="input-group-prepend">   
                        <span class="input-group-text" id="small">mi</span> 
                    </div>   
                    <input type="text" required name="mi" id="mi" value="hija" class="form-control input " >
                </div>
                <div class="input-group input-group-sm mb-3 rounded-round">   
                    <div class="input-group-prepend">   
                        <span class="input-group-text" id="small">, que el </span> 
                    </div>   
                    <input type="text" required name="queel" id="queel" value="26 de agosto" class="form-control input " >
                </div>
                <div class="input-group input-group-sm mb-3 rounded-round">   
                    <div class="input-group-prepend">   
                        <span class="input-group-text" id="small">Cumple</span> 
                    </div>   
                    <input type="text" required name="cumple" id="cumple" value="4 años" class="form-control input ">
                </div>      
                <div class="input-group input-group-sm mb-3 rounded-round">   
                    <div class="input-group-prepend">   
                        <span class="input-group-text" id="small">de edad y aún <br> no sabe escribir pero</span> 
                    </div>   
                    <textarea required name="noSabe" id="noSabe" rows="3" class="form-control input " >llena de salud</textarea>
                </div>

                <div class="input-group input-group-sm mb-3 rounded-round">   
                    <div class="input-group-prepend">   
                        <span class="input-group-text" id="small">Además a </span> 
                    </div>   
                    <input type="text" required name="ademas" id="ademas" value="Anita" class="form-control input " >
                </div> 
            
                <div class="input-group input-group-sm mb-3 rounded-round">   
                    <div class="input-group-prepend">   
                        <span class="input-group-text" id="small">le gusta </span> 
                    </div>   
                    <textarea required name="leGusta" id="leGusta" rows="3" class="form-control input " > jugar con sus muñecas</textarea>
                </div>
            
                <div class="input-group input-group-sm mb-3 rounded-round">   
                    <div class="input-group-prepend">   
                        <span class="input-group-text" id="small">El lugar <br> donde aprende es </span> 
                    </div>   
                    <textarea type="text" required name="dondeAprendo" id="dondeAprendo" class="form-control input " rows="3">en la guardería</textarea>
                </div> 
                <div class="input-group input-group-sm mb-3 rounded-round">   
                    <div class="input-group-prepend">   
                        <span class="input-group-text" id="small">En este <br> mes aprendimos </span> 
                    </div>   
                    <textarea type="text" required name="gustaAprendes" id="gustaAprendes" class="form-control input " rows="3"> la canción de la vaca Lola</textarea>
                </div> 
                    <span class="text-danger">Recuerda que debes ser una foto solo de ti presiona el icono <i class="icon-video-camera2  " ></i> para encender tu cámara</span>
                

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">y lo más importante que nos pasó últimamente es</label>
                        <div class="col-lg-10">
                            <textarea type="text" required name="mePaso" id="mePaso" class="form-control input " rows="3">que adoptamos a un perrito para que juegue con Anita</textarea>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Lo que esperamos aprender con el programa de ChildFund es</label>
                        <div class="col-lg-10">
                            <textarea type="text" required name="meGustaria" id="meGustaria" class="form-control input " rows="3">a mejorar la motricidad de mi hija para que pueda desarrollar mejor</textarea>

                        </div>
                    </div>
                    <div class="input-group input-group-sm mb-3 mt-2 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">Mi nombre es </span> 
                        </div>   
                        <input type="text" required name="miNombre" id="miNombre" value="Pedro" class="form-control input " >
                    </div> 
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">y soy </span> 
                        </div>   
                        <input type="text" required name="ysoy" id="ysoy" value="el papá" class="form-control input " >
                    </div> 
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">de </span> 
                        </div>   
                        <input type="text" required name="de" id="de" value="Anita" class="form-control input " >
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Los otros miembros de nuestra familia son</label>
                        <div class="col-lg-10">
                            <textarea type="text" required name="mifamila" id="mifamila" class="form-control input " rows="3">Sandra mi esposa, Juan el hermano mayor de Anita</textarea>

                        </div>
                    </div>     
                    <span class="text-danger">Recuerda que debes ser una foto con tu famila presiona el icono <i class="icon-video-camera2  " ></i> para encender tu cámara</span>
                   
                    
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">Nosotros vivmos <br> en la provincia de</span> 
                        </div>   
                        <input type="text" required name="nuestraPro" id="nuestraPro" value="Cotopaxi" class="form-control input " >
                    </div> 
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">y el idioma que hablamos es</span> 
                        </div>   
                        <input type="text" required name="idioma" id="idioma" value="español" class="form-control input " >
                    </div>
                    <p>Nuestra provincia tiene sitios muy hermosos, a nosotros nos gusta ir a</p>
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        
                        <input type="text" required name="lugarFavorito" id="lugarFavorito" class="form-control input " value="visitar el campo porque es muy tranquilo" >
                    </div>
                    <p>También tenemos comida típica, por ejemplo</p>
                    <div class="form-group row">                
                        <div class="col-lg-12">
                            <textarea type="text" required name="comidaTipica" id="comidaTipica" class="form-control input " rows="3">las papas con cuy, ceviches y encebollados.  Y a Anita le gusta el cuy</textarea>

                        </div>
                    </div>
                    <div class="input-group input-group-sm mb-3 mt-2 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">y a </span> 
                        </div>   
                        <input type="text" required name="ya" id="ya" class="form-control input " >
                    </div>
                    <div class="input-group input-group-sm mb-3 mt-2 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">le gusta</span> 
                        </div>   
                        <input type="text" required name="comer" id="comer" class="form-control input " >
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">De nuestras tradiciones, <br> la que compartimos juntos es</label>
                        <div class="col-lg-10">
                            <textarea type="text" required name="masMeGusta" id="masMeGusta" class="form-control input " rows="3">es la navidad</textarea>

                        </div>
                    </div>
                    <label class="col-form-label ">Nos gustaría saber más sobre ti y tu familia y hacerles una pregunta</label>
                    <div class="form-group row">
                        <div class="col-lg-10">
                            <textarea type="text" required name="pregunta" id="pregunta" class="form-control input " rows="3">como es el clima donde vives, Espero volver a escribirte pronto.</textarea>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Aquí tu despedida</label>
                        <div class="col-lg-10">
                            <textarea type="text" required name="despedida" id="despedida" class="form-control input " rows="3">Gracias por patrocinar a Anita Porque con tu apoyo tendrá mas oportunidades de aprender y a desarrollar sus habilidades, en su motricidad. </textarea>

                        </div>
                    </div>
              
            </form>
        </div>
    </div>
  
</div>

    <link href="{{ asset('buzon/css/camara1.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('buzon/css/form.css') }}" rel="stylesheet" type="text/css">
 