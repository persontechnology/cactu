    
    @php
        $edad=\Carbon\Carbon::parse($buzonCarta->buzon->ninio->fechaNacimiento)->age
    @endphp
    
    @if($buzonCarta->buzon->estado=='Respondida' || $buzonCarta->estado=='Respondida')
        <div class="alert alert-primary" role="alert">
            <strong>Cara ya fue respondida</strong>
        </div>
    @else
        @if ($edad>5)    
            @include('buzon.respuesta.formularioPresentacionMayores',$buzonCarta)
        @else
            @include('buzon.respuesta.formularioPresentacionMenores',$buzonCarta)
        @endif    
    @endif        
        
    


{{-- {{$buzonCarta->buzon->ninio}} --}}