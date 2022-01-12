<div class="contenedor">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div id="bordeCuerpo">
        <div class="fecha">
            @php
                $date = (\Carbon\Carbon::now());
            @endphp
            <p>
                Ecuador {{$buzonCarta->respuesta?\Carbon\Carbon::parse($buzonCarta->fecha)->format('d/M/Y'):''}}
            </p>
        </div>
        <div class="cuerpo">
            <p>
                {{$buzonCarta->respuesta?$buzonCarta->respuesta:''}}
            </p>
        </div>
    </div>
    <div class="footer">
        <div class="medidaIma1">
            <img id="imagenfooter" src="{{$buzonCarta->respuesta?public_path($buzonCarta->imagen):'' }}">
            </img>
        </div>
        <br>
        <br>
        <table align="left" class="egt" style="width: 75%;">
            <tbody class="esta">
                <tr>
                    <th>
                        Número Niño/a.: {{$buzonCarta->buzon->ninio->numeroChild}}
                    </th>
                    <th>
                        Tipo Carta.: {{$buzonCarta->tipoCarta->nombre}}
                    </th>
                </tr>
            </tbody>
        </table>
        
    </div>
                                                                    
</div>
<br>
<br>
<br>
    <div class="contenedor1">
        <div class="contenedorboletas">
            @if($buzonCarta->buzonCartaBoletas)
                @php($cont=0)
                @foreach($buzonCarta->buzonCartaBoletas as $boleta)
                    @php($cont++)
                    @if($cont%2==1)
                        <table align="left" class="egt" style="width: 50%;">
                            <tbody class="esta">
                                <img class="card-img" src="{{ public_path('/storage/boletas/'.$boleta->boleta) }}">
                                </img>
                            </tbody>
                        </table>
                        @else
                        <table align="right" class="egt" style="width: 50%;">
                            <tbody class="esta">
                                <img class="card-img" src="{{ public_path('/storage/boletas/'.$boleta->boleta) }}">
                                </img>
                            </tbody>
                        </table>
                    @endif                  
                @endforeach
            @endif
        </div>
        <div class="footer2">
            <p>
                With this letter, you will notice something is different that we are very excited about. We have introduced the
                use of tablets and cell phones that allow children to express themselves in their letters to you by not just
                writing, but also by taking photos of them and their drawings. We hope you enjoy this new kind of letter as much
                as children are enjoying creating them, and learning about technology in the process. Make sure you write back
                to your sponsor child and keep the conversation going!
            </p>
        </div>
    </div>
<style>
    p{
        
        letter-spacing:1px;
        font-family:Verdana, Geneva, sans-serif;
        font-size: 18px;
    }
    .esta{
        border-spacing: 10px 5px;
        color: rgb(2, 51, 12);
        
    }
    .card-img {
        float: left;
        border-radius: 1px;
        width: 50%;
        height: 180px;

    }
    .medidaIma1{
       
        height: 360px;
        padding-left: 1em;

       
    }
    .contenedor{
        background-image: url("{!! public_path('/buzon/img/cuerpounion.jpg') !!}");
        background-repeat: no-repeat;
        background-size: 100% 1350px; 
        width: 100%;
        height: 1300px;
        border­radius: 100%;
        overflow: hidden;
        border-left: 1px solid #dd5c92;
        border-right: 1px solid #dd5c92;
    }
    .contenedor1{
        background-image: url("{!! public_path('/buzon/img/pieunion.jpg') !!}");
        background-repeat: no-repeat;
        background-size: 100% 1350px; 
        width: 100%;
        height: 1200px;
        border­radius: 100%;
        overflow: hidden;
   
    }
    .cuerpo{
        height: 450px;         
        font-size: 22px;
        line-height: 2em;
   
        font-family:Verdana, Geneva, sans-serif;
        padding-left: 5em;
      
    }
    .fecha{
        
        text-indent: 12em;
        font-size: 25px;
    }
    .footer2 {
        container-type: inline-size;
        background-repeat: no-repeat;
        background-size: 100% 350px;
        text-align: justify;
        width: 100%;
        height: 360px;
        border­radius: 100%;
        overflow: hidden;
    }
    #imagenfooter{
        width: 40%;
        height: 80%;       
        padding-top: 7%;
        padding-left: 17%;
        -webkit-transform: rotate(-6deg);
        -moz-transform: rotate(-6deg);
        -ms-transform: rotate(-6deg);
        transform: rotate(-6deg);
    }
    .footer{
        width: 100%;
        height: 450px;
    }
    .contenedorboletas{
        padding-top: 37em;
    }
</style>
