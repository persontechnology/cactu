    
    @php
    $edad=\Carbon\Carbon::parse($buzonCarta->buzon->ninio->fechaNacimiento)->age
@endphp

@if($buzonCarta->buzon->estado=='Respondida' || $buzonCarta->estado=='Respondida')
    <div class="alert alert-primary" role="alert">
        <strong>Carta ya fue respondida</strong>
    </div>
@else
    @if ($edad>5)    
        @include('cartas.presentacion-mayores',$buzonCarta)
    @else
        @include('cartas.presentacion-menores',$buzonCarta)
    @endif    
@endif        
    



{{-- {{$buzonCarta->buzon->ninio}} --}}