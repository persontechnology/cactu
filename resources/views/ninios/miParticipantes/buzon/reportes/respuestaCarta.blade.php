<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
        <title>Cartas</title>
    </head>
    <body>
        @if ($buzonCarta->tipoCarta->nombre=="Contestación")       
            @include('ninios.miParticipantes.buzon.reportes.contestacion',$buzonCarta)
        @endif

        @if ($buzonCarta->tipoCarta->nombre=="Agradecimiento")       
            @include('ninios.miParticipantes.buzon.reportes.agradecimiento',$buzonCarta)
        @endif

        @if ($buzonCarta->tipoCarta->nombre=="Presentación")
            @if ($ninio->fechaNacimiento && $buzonCarta->respuesta)            
                @php
                    $edad=\Carbon\Carbon::parse($ninio->fechaNacimiento)->age;
                    $res=explode('\-',$buzonCarta->respuesta);
                @endphp
            {{-- 6244 --}}
                @if ($res[0]=="mayor")            
                    @include('ninios.miParticipantes.buzon.reportes.presentacion',$buzonCarta)
                @else
                    @include('ninios.miParticipantes.buzon.reportes.presentacionMenores',$buzonCarta)
                @endif    
            @else
                @include('ninios.miParticipantes.buzon.reportes.sinrespuesta',$buzonCarta)
            @endif
        @endif
        @if ($buzonCarta->tipoCarta->nombre=="Unión")       
            @include('ninios.miParticipantes.buzon.reportes.union',$buzonCarta)
        @endif

        @if ($buzonCarta->tipoCarta->nombre=="Iniciadas")       
            @include('ninios.miParticipantes.buzon.reportes.iniciadas',$buzonCarta)
        @endif
    </body>
</html>