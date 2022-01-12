<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

    <a  href="{{route('planificaciones-modelo',$planificacion->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Modelos programáticos de {{ $planificacion->nombre }}">
        <i class="fas fa-list"></i>
    </a>
    
    @can('actualizar', $planificacion)
        <a  href="{{route('editar-planificacion',$planificacion->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar {{ $planificacion->nombre }}">
            <i class="fas fa-edit"></i>
        </a> 
         <button type="button" onclick="eliminar(this);" data-id="{{ $planificacion->id }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $planificacion->nombre }}">
        <i class="fas fa-trash-alt"></i>
    </button> 

    @endcan 
    
        <a  href="{{route('materiales-planificacion',$planificacion->id)}}" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Acta recepción {{ $planificacion->nombre }}">
            <i class="icon-cash"></i>
        </a>
        {{--  <div class="align-self-center">
            Metodos para vincular con las consultas
            <div class="list-icons">
                <div class="dropdown" >
                    <button type="button" class="btn btn-light dropdown-toggle " data-placement="top" title="Más opciones {{ $planificacion->nombre }}"   data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></button>

                    <div class="dropdown-menu dropdown-menu-right bg-dark" x-placement="bottom-end" >
                        <a href="{{route('materiales-planificacion',$planificacion->id)}}" class="dropdown-item" ><i class="icon-cash"></i> Actas  </a>
                        <a href="{{route('vistaExportarExcelFechas',$planificacion->id)}}" class="dropdown-item"><i class="icon-calendar3"></i> Exportar asistencias</a>
                        <a href="{{route('listadoSinParticipacion',$planificacion->id)}}" class="dropdown-item" ><i class="icon-x"></i> Eliminar Asistencias</a>
                    </div>
                </div>
            </div>
        </div>          --}}
   
</div>