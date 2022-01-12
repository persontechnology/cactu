<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
   
    @can('verificarComunidadNinio', $ninio)
        @php
            $numAr=8-$ninio->carpetaNinio()->count();
        @endphp
        <button type="button" class="btn btn-{{$numAr<2?'light ':'warning' }}" data-getip="{{ Crypt::encryptString($ninio->id) }}" data-url="{{ route('buscararchivoParticipante') }}" data-urla="{{ route('actualizararchivoParticipante') }}"  data-urlc="{{ route('guarararchivoParticipante') }}" data-urle="{{ route('eliminararchivoParticipante') }}" onclick="archivos(this)" data-toggle="tooltip" data-placement="center" title="Archivos {{ $ninio->nombres }}"><i class="fa fa-upload" aria-hidden="true"></i> </button>
        <a  href="{{route('buzonMiParticipante',$ninio->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Mesajería {{ $ninio->nombres }}">
            <i class="icon-mailbox"></i>
        </a>
    @endcan
  
</div>
