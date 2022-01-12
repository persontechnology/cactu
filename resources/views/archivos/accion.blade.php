<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
     <a href="{{ route('editarArchivo',$ar->id) }}" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Editar {{ $ar->nombre }}">
        <i class="fas fa-edit"></i>
    </a>
    
    <button onclick="eliminar(this);" data-id="{{ $ar->id }}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $ar->nombre }}">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>