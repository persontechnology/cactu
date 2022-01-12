<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

        <a href="{{ route('editarComunidadEnCanton',$comunidad->id) }}" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Editar {{ $comunidad->nombre }}">
            <i class="fas fa-edit"></i>
        </a>
        @can('eliminarComunidad', $comunidad)
        <button onclick="eliminar(this);" data-id="{{ $comunidad->id }}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $comunidad->nombre }}">
            <i class="fas fa-trash-alt"></i>
        </button>
        @endcan
    </div>