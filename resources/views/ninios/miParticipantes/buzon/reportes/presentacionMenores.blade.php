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
        <p>Fecha {{ \Carbon\Carbon::parse($res[1])->format('d/M/Y') }} </p>
    </div>
    <div class="cuerpo">
        <p>
            Hola {{ $res[2] }}<br>
            Escribo a nombre de {{ $res[3] }} <br>

            mi {{ $res[4] }} ,que el {{ $res[5] }} cumple <br>
            {{ $res[6] }} de edad y aun no sabe escribir pero <br>
            {{ $res[7] }} </p>

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
                        <p>Además a {{ $res[8] }} le gusta {{ $res[9] }} </p>
                    </td>
                    <td rowspan="2">
                        <div class="medidaIma">
                            <img id="imagenfoto" src="{{ public_path($buzonCarta->imagen) }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>El lugar donde aprendo {{ $res[10] }} </p>
                    </td>
                </tr>


            </tbody>
        </table>
    </div>
    <div class="cuerpo2">
        <p>
            En este mes aprendimos {{ $res[11] }}
        </p>
    </div>
    <div class="cuerpo2">
        <p>
            Lo más importante que me pasó últimamente es {{ $res[12] }}
        </p>
    </div>
    <div class="cuerpo2">
        <p>
            Lo que me gustaría aprender en el programa de ChildFund es {{ $res[13] }}
        </p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="imgboeltas">
        @if ($buzonCarta->buzonCartaBoletas)
            @php($cont = 0)
            @foreach ($buzonCarta->buzonCartaBoletas as $boleta)
                @php($cont++)
                @if ($cont % 2 == 1)
                    <table style="width: 50%;" align="left" class="egt">
                        <tbody class="esta">
                            <div class=""> 
                                <img class=" card-img"
                                src="{{ public_path('/storage/boletas/' . $boleta->boleta) }}">
                            </div>
                        </tbody>
                    </table>
                @else
                    <table style="width: 50%;" align="right" class="egt">
                        <tbody class="esta">
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
                        <p>Mi nombre es </p>
                        <p>{{ $res[14] }}</p>
                        <p> y soy el {{ $res[15] }} de <br>
                            {{ $res[16] }}
                        </p>
                        <p>Los otros miembros de nuestra familia son {{ $res[17] }}</p>
                    </td>
                    <td>
                        <div class="medidaIma1">
                            <img id="imagenfoto1" src="{{ public_path($buzonCarta->imagen2) }}">
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="cuerpo3">
        <p>Nosotros vivimos en la provincia de {{ $res[18] }} <br>
            y el idioma que hablamos es {{ $res[19] }}</p>

    </div>
    <div class="cuerpo3">
        <p>Nuestra provincincia tiene lugares hermosos, a nosotros nos gusta ir a <br>
            {{ $res[20] }} <br>

        </p>
    </div>
    <div class="cuerpo3">
        <p>
            También tenemos comida típica, por ejemplo <br>{{ $res[21] }}
        </p>
    </div>
    <div class="cuerpo2">
        <p>y a {{ $res[22] ?? '' }} le gusta {{ $res[23] ?? '' }}<br></p>
        <p>De nuestra tradiciones, la que compartimos juntos es {{ $res[24] ?? '' }}</p>
    </div>
    <div class="cuerpo3">
        <p>Nos gustaría saber sobre ti y tu familia y hacerte una pregunta {{ $res[25] ?? '' }}</p>
    </div>


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table width="100%">
        <thead>
            <tr>
                <th width="45%"></th>
                <th style="text-align: left">
                    <p>
                        {{ $res[26] ?? '' }}
                    </p>
                </th>

            </tr>
        </thead>
    </table>
    <style>
        p {

            letter-spacing: 1px;
            font-family: Verdana, Geneva, sans-serif;
            font-size: 18px;
        }

        .esta {

            padding-left: 5em;

        }

        .imgboeltas {

            padding-left: 5em;
            font-family: Verdana, Geneva, sans-serif;
            font-size: 21px;
        }

        .medidaIma {
            padding-top: 12px;
            width: auto;
            height: 150px;
            overflow: hidden;
            padding-right: 3em !important;

        }

        .medidaIma1 {

            width: auto;
            height: 265px;
            overflow: hidden;
            padding-right: 3em !important;


        }

        .card-img {
            width: 40%;
            height: 145px;
            padding-left: 1em;
            float: left;

        }

        #imagenfoto1 {
            width: 80%;
            height: 305px;
            padding-left: 1em;


        }

        .imagencuerpo1 {
            height: 295px;
            font-size: 17px;
            padding-left: 6em;
            letter-spacing: 1px;

        }

        #imagenfoto {
            width: 80%;
            height: 145px;
            padding-left: 1em;

        }

        .contenedor {
            background-image: url("{!! public_path('/buzon/img/cuerpopremenor.jpg') !!}");
            background-repeat: no-repeat;
            background-size: 100% 1350px;
            width: 100%;
            height: 1290px;
            border­radius: 100%;
            overflow: hidden;

        }

        @if ($buzonCarta->buzon->ninio->comunidad->canton->provincia->nombre === 'COTOPAXI').contenedor2 {
            background-image: url("{!! public_path('/buzon/img/piepremenorCotopaxi.jpg') !!}");
            background-repeat: no-repeat;
            background-size: 100% 1350px;
            width: 100%;
            height: 1290px;
            border­radius: 100%;
            overflow: hidden;

        @else .contenedor2 {
                background-image: url("{!! public_path('/buzon/img/piepremenorTungurahua.jpg') !!}");
                background-repeat: no-repeat;
                background-size: 100% 1350px;
                width: 100%;
                height: 1290px;
                border­radius: 100%;
                overflow: hidden;
                @endif
            }

            .fecha {
                padding-left: 10em;
                font-family: Verdana, Geneva, sans-serif;
                font-size: 19px;
            }

            .cuerpo {
                padding-top: 0%;
                padding-left: 5em;
                padding-right: 7em;
                letter-spacing: 1px;
                height: 260px;
                line-height: 2em;
                font-family: Verdana, Geneva, sans-serif;
                font-size: 21px;


            }

            .cuerpo2 {
                padding-top: 0%;
                padding-left: 5em;

                letter-spacing: 1px;
                height: 100px;
                font-family: Verdana, Geneva, sans-serif;
                font-size: 20px;

            }

            .cuerpo3 {
                font-family: Verdana, Geneva, sans-serif;
                font-size: 20px;

                padding-left: 5em;
                padding-right: 5em;
                height: 60px;
            }

            .imagencuerpo {
                padding-top: 0%;
                padding-left: 5em;
                letter-spacing: 1px;
                font-family: Verdana, Geneva, sans-serif;
                font-size: 20px;
            }

    </style>
