<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <a  href="{{route('editar-modelo',$modelo->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar {{ $modelo->nombre }}">
        <i class="fas fa-edit"></i>
    </a>
    <button type="button" onclick="eliminar(this);" data-id="{{ $modelo->id }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $modelo->nombre }}">
        <i class="fas fa-trash-alt"></i>
    </button>
    
</div>