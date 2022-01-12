<div aria-label="Basic example" class="btn-group btn-group-sm" role="group">
    @can('verAfiliado', $ninio)
        @php
            $numAr=8-$ninio->carpetaNinio()->count();
        @endphp
    <button class="btn btn-{{$numAr<2?'light':'warning' }}" data-getip="{{ Crypt::encryptString($ninio->id) }}" data-placement="center" data-toggle="tooltip" data-url="{{ route('buscararchivoPart') }}" data-urla="{{ route('actualizararchivoPart') }}" data-urlc="{{ route('guarararchivoPart') }}" data-urle="{{ route('eliminararchivoPart') }}" onclick="archivos(this)" title="Archivos {{ $ninio->nombres }}" type="button">
        <i aria-hidden="true" class="fa fa-upload">
        </i>
    </button>
    <a class="btn btn-info" data-placement="top" data-toggle="tooltip" href="{{route('buzonNinio',$ninio->id)}}" title="Mesajería {{ $ninio->nombres }}">
        <i class="icon-mailbox">
        </i>
    </a>
    @endcan
</div>
