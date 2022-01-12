<button type="button" role="button" onclick="regresar(this)" class="btn btn-primary" title="Cancelar" style="float: right;">
    <span class="lnr lnr-cross"></span>
</button>
<div class="page-title">
    <h2>Carta de <span>{{$buzonCarta->tipoCarta->nombre}}</span></h2>
    
</div>

<div class="row">
    <div class=" col-xs-12 col-sm-12 ">
        {{--  @if ($buzonCarta->tipoCarta->nombre=="Contestación")
        @include('buzon.respuesta.formularioContestacion')
        @endif  --}}
        {{--  @if ($buzonCarta->tipoCarta->nombre=="Agradecimiento")
        @include('buzon.respuesta.formularioAgradecimiento')
        @endif  --}}
        @if ($buzonCarta->tipoCarta->nombre=="Presentación")
            @include('cartas.presentacion',$buzonCarta)
        @else
        @include('cartas.respuesta-camara-uno')
        @endif 
        {{--  @if ($buzonCarta->tipoCarta->nombre=="Unión")
        @include('buzon.respuesta.formularioUnion',$buzonCarta)
        @endif   --}}
        {{--  @if ($buzonCarta->tipoCarta->nombre=="Iniciadas")
            @include('buzon.respuesta.formularioIniciadas',$buzonCarta)
        @endif   --}}
    </div>
</div>