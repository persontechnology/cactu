<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    
    <a href="{{ route('coomunidadesEnCanton',$canton->id) }}" class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="Comunidades de {{ $canton->nombre }}">
        <i class="fas fa-map-marker-alt"></i>
    </a>

    <a href="{{ route('editarCantonEnProvincia',$canton->id) }}" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Editar {{ $canton->nombre }}">
        <i class="fas fa-edit"></i>
    </a>
    
    <button onclick="eliminar(this);" data-id="{{ $canton->id }}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $canton->nombre }}">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>