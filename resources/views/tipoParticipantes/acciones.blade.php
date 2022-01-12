<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    
    @can('actualizar', $tipoParticipante)
        <a  href="{{route('editar-participante',$tipoParticipante->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar {{ $tipoParticipante->nombre }}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan

    @can('eliminar', $tipoParticipante)
        <button type="button" onclick="eliminar(this);" data-id="{{$tipoParticipante->id }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $tipoParticipante->nombre }}">
            <i class="fas fa-trash-alt"></i>
        </button>
    @endcan
    
</div>