<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <a href="{{route('qrNinioParticipante',$ninio->id)}}" target="_blanck" class="btn btn-success"  data-toggle="tooltip" data-placement="top" title="Código Qr {{ $ninio->nombres }}">
        <i class="fas fa-qrcode"></i>
    </a>
    <a href="{{route('informacionMiParticipante',$ninio->id)}}" class="btn btn-dark"  data-toggle="tooltip" data-placement="top" title="Información de {{ $ninio->nombres }}">
        <i class="fas fa-eye"></i>
    </a>
    <a  href="{{route('editarMiParticipante',$ninio->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar {{ $ninio->nombres }}">
        <i class="fas fa-edit"></i>
    </a>
    <button type="button" onclick="eliminar(this);" data-id="{{ $ninio->id }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $ninio->nombres }}">
        <i class="fas fa-trash-alt"></i>
    </button>
    
</div>