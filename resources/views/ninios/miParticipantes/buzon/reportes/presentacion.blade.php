<div class="contenedor">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="fecha">
        @php
            $date = \Carbon\Carbon::now();
            $res = explode('\-', $buzonCarta->respuesta);
        @endphp
        <p>Fecha {{ $buzonCarta->respuesta ? \Carbon\Carbon::parse($res[1])->format('d/M/Y') : '' }} </p>

    </div>
    <div class="cuerpo">
        <p>Hola {{ $buzonCarta->respuesta ? $res[2] : '' }} </p>
        <p>Soy {{ $buzonCarta->respuesta ? $res[3] : '' }} </p>
        <p>y mis amigos me dicen {{ $buzonCarta->respuesta ? $res[4] : '' }} .Tengo años
            {{ $buzonCarta->respuesta ? $res[5] : '' }} </p>
        </p>
        <p>Mi mejor amigo se llama {{ $buzonCarta->respuesta ? $res[6] : '' }} </p>
        </p>
        <p>y es mi mejor amigo porque {{ $buzonCarta->respuesta ? $res[7] : '' }} </p>
        </p>

    </div>    
    <div class="imagencuerpo">
        <table width="100%">
            <thead>
                <tr>
                    <th width="70%"></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p>Lo que más me gusta hacer es {{ $buzonCarta->respuesta ? $res[8] : '' }} </p>
                        </p>
                    </td>
                    <td rowspan="3">
                        <div class="medidaIma">

                            <img id="imagenfoto" class="rotateimg180" style="margin-top: 40px;" src="{{ public_path($buzonCarta->imagen) }}">

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p> Cuando sea grande mi sueño es {{ $buzonCarta->respuesta ? $res[9] : '' }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>El lugar donde aprendo es {{ $buzonCarta->respuesta ? $res[10] : '' }}</p>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="cuerpo2">
        <p>
            y lo que me gusta aprender es {{ $buzonCarta->respuesta ? $res[11] : '' }}
        </p>
    </div>
    <div class="cuerpo2">
        <p>
            Lo más importante que me pasó últimamente es {{ $buzonCarta->respuesta ? $res[12] : '' }}
        </p>
    </div>
    <div class="cuerpo2">
        <p>
            Lo que me gustaría aprender en el programa de ChildFund es <br>
            {{ $buzonCarta->respuesta ? $res[13] : '' }}
        </p>
    </div>
    <br>
    <br>
    <br>
     <div class="imgboeltas" style="margin-bottom: 10px;">
        <p style="margin-top: 90px"></p>
        @if ($buzonCarta->buzonCartaBoletas)        
            @php($cont = 0)
            @foreach ($buzonCarta->buzonCartaBoletas as $boleta)
                @php($cont++)
                @if ($cont % 2 == 1)
                    <table style="width: 50%;" align="center" class="egt">
                        <tbody class="esta" style="text-align: center">
                            <div class=""> 
                                <img class="card-img " style="margin-right: 30px; margin-left: 1px;"
                                src="{{ public_path('/storage/boletas/' . $boleta->boleta) }}">
                            </div>
                        </tbody>
                    </table>
                @else
                    <table style="width: 50%;" align="right" class="egt">
                        <tbody class="esta" style="text-align: center">
                            <div class=""> 
                                <img  class=" card-img" 
                                src="{{ public_path('/storage/boletas/' . $boleta->boleta) }}">
                            </div>
                        </tbody>
                    </table>
                @endif
            @endforeach
        @endif
    </div>
</div>
<div class="contenedor2">
    <br>
    <br>
    <br>
    <div class="imagencuerpo1">
        <table width="100%">
            <thead>
                <tr>
                    <th width="35%"></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="cuerpo6">
                            <p>Esta es mi familia <br> {{ $buzonCarta->respuesta ? $res[14] : '' }}</p>
                        </div>
                    </td>
                    <td>
                        <div class="medidaIma2">
                            <img class="card-img2" src="{{ public_path($buzonCarta->imagen2) }}">
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="cuerpo4">
        <p>También quiero contarte del lugar donde vivo</p>
        <p>Nuestra provincia se llama {{ $buzonCarta->respuesta ? $res[15] : '' }}</p>
        <p>y el idioma que hablamos es {{ $buzonCarta->respuesta ? $res[16] : '' }}</p>
        <p>Donde nosotros vivimos hay unos sitios muy hermosos</p>
        <p>mi lugar favorito es {{ $buzonCarta->respuesta ? $res[17] : '' }}</p>
    </div>
    <div class="cuerpo3">
        <p>También tenemos comida típica, por ejemplo <br>
            {{ $buzonCarta->respuesta ? $res[18] : '' }} </p>
    </div>
    <div class="cuerpo4">
        <p>y a mí me gusta comer {{ $buzonCarta->respuesta ? $res[19] : '' }}</p>
    </div>
    <div class="cuerpo3">
        <p>De nuestras tradiciones, la que más me gusta es <br>
            {{ $buzonCarta->respuesta ? $res[20] : '' }}</p>
    </div>
    <div class="cuerpo4">
        <p><span style="color: rgb(245, 12, 12)">Me gustaría hacerte una pregunta</span></p>
        <p>{{ $buzonCarta->respuesta ? $res[21] : '' }}</p>

    </div>
    <br><br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table width="100%">
        <thead>
            <tr>
                <th width="45%"> </th>
                <th style="text-align: left">
                    <div class="cuerpo5">
                        <p>
                            {{ $buzonCarta->respuesta ? $res[22] : '' }}
                        </p>
                    </div>
                </th>
            </tr>
        </thead>
    </table>
</div>

<style>
    .esta {

        /* padding-left: 200px; */
        align-content: center;

    }

    .imgboeltas {

        padding-left: 7em;
    }

    .medidaIma {

        width: auto;
        height: 150px;
        overflow: hidden;
        padding-right: 3em !important;

    }

    .medidaIma1 {

        width: auto;
        padding-right: 4em !important;


    }

    .card-img {
        width: 40%;
        height: 145px;
        padding-left: 1em;
        float: left;

    }

    .medidaIma2 {

        width: auto;
        height: 265px;
        overflow: hidden;
        padding-right: 3em !important;


    }

    .card-img2 {
        width: 80%;
        height: 265px;
        padding-left: 1em;
        float: left;

    }

    .imagenfoto1 {
        width: 30%;
        height: 185px;



    }

    .imagencuerpo1 {


        height: 295px;
        font-size: 17px;
        padding-left: 6em;
        letter-spacing: 1px;
    }

    #imagenfoto {
        width: 80%;
        height: 155px;
        padding-left: 1em;

    }
    .rotateimg180 {
  -webkit-transform:rotate(10deg);
  -moz-transform: rotate(10deg);
  -ms-transform: rotate(10deg);
  -o-transform: rotate(10deg);
  transform: rotate(10deg);
}

    @if ($buzonCarta->buzon->ninio->comunidad->canton->provincia->nombre === 'COTOPAXI')
        .contenedor2 {
            background-image: url("{!! public_path('/buzon/img/piepremayoresCotopaxi.jpg') !!}");
            background-repeat: no-repeat;
            background-size: 100% 1350px;
            width: 100%;
            height: 1290px;
            border­radius: 100%;
            overflow: hidden;
            font-family: 'Handlee', cursive;
        }

    @else 
    .contenedor2 {
            background-image: url("{!! public_path('/buzon/img/piepremayoresTungurahua.jpg') !!}");
            background-repeat: no-repeat;
            background-size: 100% 1350px;
            width: 100%;
            height: 1290px;
            border­radius: 100%;
            overflow: hidden;
            font-family: 'Handlee', cursive;
        }

    @endif
        .contenedor {
            background-image: url("{!! public_path('/buzon/img/cuerpopremayores.jpg') !!}");
            background-repeat: no-repeat;
            background-size: 100% 1350px;
            width: 100%;
            height: 1290px;
            border­radius: 100%;
            overflow: hidden;
            font-family: 'Handlee', cursive;
        }


        .fecha {
            padding-left: 10em;
            font-size: 19px;
        }

        .cuerpo {
            padding-top: 0%;
            font-size: 17px;
            padding-left: 8em;
            padding-right: 8em;

            letter-spacing: 1px;


        }

        .cuerpo2 {
            padding-top: 0%;
            font-size: 18px;
            padding-left: 8em;
            padding-right: 8em;

            letter-spacing: 1px;

            height: 120px;
        }

        .cuerpo3 {

            font-size: 18px;
            padding-left: 6em;

            letter-spacing: 1px;
            padding-right: 6em;
            height: 40px;
        }

        .cuerpo4 {

            font-size: 18px;

            padding-left: 6em;
            letter-spacing: 1px;
            padding-right: 6em;

        }

        .cuerpo5 {
            font-size: 19px;
            letter-spacing: 1px;
            padding-right: 6em;
        }

        .cuerpo6 {
            font-size: 19px;
            letter-spacing: 1px;

        }

        .imagencuerpo {
            padding-top: 0%;
            font-size: 17px;
            padding-left: 8em;
            letter-spacing: 1px;
        }

</style>
