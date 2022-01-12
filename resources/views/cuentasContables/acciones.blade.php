<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    @can('materialesCuentaContable', $cuentaContable)    
        <a  href="{{route('editar-cuenta',$cuentaContable->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar {{ $cuentaContable->nombre }}">
            <i class="fas fa-edit"></i>
        </a>
        <button type="button" onclick="eliminar(this);" data-id="{{$cuentaContable->id }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $cuentaContable->nombre }}">
            <i class="fas fa-trash-alt"></i>
        </button>
    @elsecan('materialesCuentaContableCrear', $cuentaContable)
        <a  href="{{route('materiales')}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Crear productos en {{ $cuentaContable->nombre }}">
            <i class="icon-clippy"></i>
        </a>
    @endcan
    
    
</div>