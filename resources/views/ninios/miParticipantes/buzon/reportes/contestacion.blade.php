<style>
    #bordeCuerpo {
        border-left: 1px solid #dd5c92;
        border-right: 1px solid #dd5c92;
        padding: 10px;
    }

</style>
<div class="container1">
    <div class="primer">
        <img height="300px" id="cabecera" src="{!! public_path('/buzon/img/ccontestacion.jpg') !!}" width="100%">
    </div>
    <div id="bordeCuerpo">
        <div class="fecha">
            @php
                $date = \Carbon\Carbon::now();
            @endphp
            <p>
                Ecuador {{ $buzonCarta->respuesta ? \Carbon\Carbon::parse($buzonCarta->fecha)->format('d/M/Y') : '' }}
            </p>
        </div>
        <div class="cuerpo">
            <p>
                {{ $buzonCarta->respuesta ? $buzonCarta->respuesta : '' }}
            </p>
        </div>
    </div>
    <div class="footer">
        <img id="imagenfooter" src="{{ $buzonCarta->respuesta ? public_path($buzonCarta->imagen) : '' }}">
        <br>
        <br>
        <br>
        <br>
        <table align="left" class="egt" style="width: 75%;">
            <tbody class="esta">
                <tr>
                    <th>
                        Número Niño/a.: {{ $buzonCarta->buzon->ninio->numeroChild }}
                    </th>
                    <th>
                        Tipo Carta.: {{ $buzonCarta->tipoCarta->nombre }}
                    </th>
                </tr>
            </tbody>
        </table>

    </div>
</div>
<br>
<br>
<br>
<div class="contenedor2">
    <div class="primer">
        <img height="480px" id="cabecera" src="{!! public_path('/buzon/img/cacontestacion.jpg') !!}" width="100%">
        </img>
    </div>
    <br>
    <br>
    @if ($buzonCarta->buzonCartaBoletas)
        @php($cont = 0)
        @foreach ($buzonCarta->buzonCartaBoletas as $boleta)
            @php($cont++)
            @if ($cont % 2 == 1)
                <table align="left" class="egt" style="width: 50%;">
                    <tbody class="esta">
                        <img class="card-img" src="{{ public_path('/storage/boletas/' . $boleta->boleta) }}">
                        </img>
                    </tbody>
                </table>
            @else
                <table align="right" class="egt" style="width: 50%;">
                    <tbody class="esta">
                        <img class="card-img" src="{{ public_path('/storage/boletas/' . $boleta->boleta) }}">
                        </img>
                    </tbody>
                </table>
            @endif
        @endforeach
    @endif
</div>
<br>
<div class="footer2">
    <p>
        With this letter, you will notice something is different that we are very excited about. We have introduced the
        use of tablets and cell phones that allow children to express themselves in their letters to you by not just
        writing, but also by taking photos of them and their drawings. We hope you enjoy this new kind of letter as much
        as children are enjoying creating them, and learning about technology in the process. Make sure you write back
        to your sponsor child and keep the conversation going!
    </p>
</div>
<style>
    p {

        letter-spacing: 1px;
        font-family: Verdana, Geneva, sans-serif;
        font-size: 22px;
    }

    .card-img {
        float: left;
        border-radius: 1px;
        width: 50%;
        height: 180px;

    }

    .esta {
        border-spacing: 10px 5px;
        color: rgb(2, 51, 12);

    }

    .footer {
        background-image: url("{!! public_path('/buzon/img/pcontestacion.jpg') !!}");
        background-repeat: no-repeat;
        background-size: 100% 350px;

        width: 100%;
        height: 360px;
        border­radius: 100%;
        overflow: hidden;
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

    #imagenfooter {
        width: 40%;
        height: 50%;
        padding-top: 7%;
        padding-left: 17%;
        -webkit-transform: rotate(-6deg);
        -moz-transform: rotate(-6deg);
        -ms-transform: rotate(-6deg);
        transform: rotate(-6deg);
    }

    .cuerpo {
        width: 100%;
        height: 500px;
        border­radius: 100%;
        overflow: hidden;
        font-size: 24px;
        line-height: 2em;
        text-transform: none;
        text-indent: 2em;
        font: condensed 120% sans-serif;
    }

    .fecha {

        text-align: right;
        font-size: 25px;
    }

</style>
