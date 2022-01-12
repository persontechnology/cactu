<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    
    <a href="{{ route('cantonesEnProvincia',$pro->id) }}" class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="Cantones de {{ $pro->nombre }}">
        <i class="fas fa-map-marker-alt"></i>
    </a>

    <a href="{{ route('editarProvincia',$pro->id) }}" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Editar {{ $pro->nombre }}">
        <i class="fas fa-edit"></i>
    </a>
    
    <button onclick="eliminar(this);" data-id="{{ $pro->id }}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $pro->nombre }}">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>