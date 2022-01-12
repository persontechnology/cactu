<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <a href="{{ route('participanteNuevoAsignacion',$user->id) }}" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Asignar comunidades a {{ $user->name }}">
        <i class="fas fa-map-marker-alt"></i>
    </a>
</div>