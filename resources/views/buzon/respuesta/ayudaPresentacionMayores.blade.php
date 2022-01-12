

    <div class="container1">
        <br>
        <br>
        @php
        $date = (\Carbon\Carbon::now());
        @endphp

    <div class="card p-3">
        <p>Fecha {{ \Carbon\Carbon::parse($date)->format('d/M/Y')}}</p>
        
            <div class="golden-forms">
                <form action="#" >
                    <span class="text-danger">Este formulario es de ayuda recuerda llenar con tus datos</span>
                    <div class="input-group input-group-sm mb-3 rounded-round">   
                        <div class="input-group-prepend">   
                            <span class="input-group-text" id="small">Hola</span> 
                        </div>   
                        <input type="text" required name="hola" id="hola" class="form-control input " value="Jerry Corns (Tu patrocinador)" >
                    </div>
                      <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">Soy</span> 
                            </div>   
                            <input type="text" required name="soy" id="soy" class="form-control input" value="Luis Miguel López Ayala (Tu nombre)">
                            
                        </div>
                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">y mis amigos me dicen</span> 
                            </div>   
                            <input type="text" required name="meDicen" id="meDicen" class="form-control input " value="Lucho (Como te dicen)">
                            
                        </div>      
                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">Tengo</span> 
                            </div>   
                            <input type="text" required name="edad" id="edad" class="form-control input " value="11 años">
                            
                        </div> 
                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">Mi mejor amigo se llama</span> 
                            </div>   
                            <input type="text" required name="miMejorAmigo" id="miMejorAmigo" class="form-control input " value="Hugo y Henry">
                            
                        </div> 
                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">es mi mejor amigo porque</span> 
                            </div>   
                            <textarea required name="esMejorAmigo" id="esMejorAmigo" rows="3" class="form-control textarea no-resize" >Juegan conmigo</textarea>
                            
                        </div>
                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">Lo que maś me <br>   gusta hacer es </span> 
                            </div>   
                            <textarea required name="loquehago" id="loquehago" rows="3" class="form-control textarea no-resize" >jugar fútbol e ir al pasto de mis animalitos al páramo</textarea>
                        
                        </div>

                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">Cuando sea grande <br> mi sueño es</span> 
                            </div>   
                            <textarea type="text" required name="miSueno" id="miSueno" class="form-control textarea no-resize" rows="3">Ser un gran futbolista</textarea>

                        
                        </div> 
                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">El lugar <br> donde aprendo es </span> 
                            </div>   
                            <textarea type="text" required name="dondeAprendo" id="dondeAprendo" class="form-control textarea no-resize" rows="3">la escuela y el páramo </textarea>

                        </div> 
                        <div class="input-group input-group-sm mb-3 rounded-round">   
                            <div class="input-group-prepend">   
                                <span class="input-group-text" id="small">lo que me gusta <br> aprender es </span> 
                            </div>   
                            <textarea type="text" required name="gustaAprendes" id="gustaAprendes" class="form-control textarea no-resize " rows="3">matemáticas, literatura, dibujar y pintar </textarea>

                        </div> 
                            <span class="text-danger">Recuerda que debes ser una foto solo de ti presiona el icono <i class="icon-video-camera2  " ></i> para encender tu cámara</span>
                            <div class="display-cov">
                              
                            </div>
                          

                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Lo más importante que me pasó últimamente es</label>
                                <div class="col-lg-10">
                                    <textarea type="text" required name="mePaso" id="mePaso" class="form-control textarea no-resize" rows="3">
                                        que celebramos el carnaval y bajamos a las fiestas tradicionales, hubo disfrazados, comida, toros de pueblo y mucha carioca
                                    </textarea>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Lo que me gustaría aprender en el programa de ChildFund es</label>
                                <div class="col-lg-10">
                                    <textarea type="text" required name="meGustaria" id="meGustaria" class="form-control textarea no-resize" rows="3">Deporte, pintar y aprender a danzar</textarea>


                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Esta es mi famila</label>
                                <div class="col-lg-10">
                                    <textarea type="text" required name="miFamilia" id="miFamilia" class="form-control textarea no-resize" rows="3">Yo estoy solo porque mis padres salieron a trabajar, mi madre a cuidar las papas y mi padre a pastar el ganado gravo.</textarea>


                                </div>
                            </div>     
                            <span class="text-danger">Recuerda que debes ser una foto con tu famila presiona el icono <i class="icon-video-camera2  " ></i> para encender tu cámara</span>
                            <div class="display-cov1">
                                
                            </div>
                       
                            <p>También quiero contarte del lugar donde vivo</p>
                            <div class="input-group input-group-sm mb-3 rounded-round">   
                                <div class="input-group-prepend">   
                                    <span class="input-group-text" id="small">Nuestra provincia se llama</span> 
                                </div>   
                                <input type="text" required name="nuestraPro" id="nuestraPro" class="form-control input " value="Cotopaxi" >
                                
                            </div> 
                            <div class="input-group input-group-sm mb-3 rounded-round">   
                                <div class="input-group-prepend">   
                                    <span class="input-group-text" id="small">y el idioma que hablamos es</span> 
                                </div>   
                                <input type="text" required name="idioma" id="idioma" class="form-control input " value="Español" >
                                
                            </div>
                            <p>Donde nosotros vivimos hay sitios muy hermosos,</p>
                            <div class="input-group input-group-sm mb-3 rounded-round">   
                                <div class="input-group-prepend">   
                                    <span class="input-group-text" id="small">mi lugar favorito es</span> 
                                </div>   
                                <input type="text" required name="lugarFavorito" id="lugarFavorito" class="form-control input " value="el páramo">
                                
                            </div>
                            <p>También tenemos comida típica, por ejemplo</p>
                            <div class="form-group row">                
                                <div class="col-lg-12">
                                    <textarea type="text" required name="comidaTipica" id="comidaTipica" class="form-control textarea no-resize" rows="3">la colada morada, el caldo de gallina y las papas con cuy</textarea>

                                </div>
                            </div>
                            <div class="input-group input-group-sm mb-3 mt-2 rounded-round">   
                                <div class="input-group-prepend">   
                                    <span class="input-group-text" id="small">y a mi me gusta comer</span> 
                                </div>   
                                <input type="text" required name="comer" id="comer" class="form-control input " value="caldo de gallina  " >
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">De nuestras tradiciones, <br> lo que más me gusta es</label>
                                <div class="col-lg-10">
                                    <textarea type="text" required name="masMeGusta" id="masMeGusta" class="form-control textarea no-resize" rows="3">la corrida de toros bravos y la vaca loca</textarea>


                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Me gustaría hacerte <br> una pregunta</label>
                                <div class="col-lg-10">
                                    <textarea type="text" required name="pregunta" id="pregunta" class="form-control textarea no-resize" rows="3">Cual es tu país y que tradiciones existen</textarea>


                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Aquí tu despedida</label>
                                <div class="col-lg-10">
                                    <textarea type="text" required name="despedida" id="despedida" class="form-control textarea no-resize" rows="3">Agradezco mucho por tu amistad, por tu cariño de haberme elegido. Espero me escribas pronto y contarte mas sobre mi y mi país Att: Miguel   
                                    </textarea>


                                </div>
                            </div>
                                       
                </form> 
            </div>
        </div> 
    </div>

    <link href="{{ asset('buzon/css/camara1.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('buzon/css/form.css') }}" rel="stylesheet" type="text/css">
 