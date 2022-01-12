@extends('layouts.app',['title'=>'Planificaciones modelos'])
@section('breadcrumbs', Breadcrumbs::render('planificaionModelos',$planificacion))


@section('content')

@can('creaPlanificacionModelo', $planificacion)
<form action="{{ route('asignar-modelo') }}" method="POST">
    @csrf
    <input type="hidden" name="planificacion" value="{{$planificacion->id}}">
    <div class="card">
        <div class="card-header">
            Asignar modelo programático <strong>{{ $planificacion->nombre }}</strong> desde {{ $planificacion->desde }} hasta {{ $planificacion->hasta }} en estado <strong>{{ $planificacion->estado }}</strong>
        </div>
        <div class="card-body">
            <label for="">Selecione un Modelo programático </label>
            <div class="input-group">
                <select class="form-control selectpicker  @error('modeloProgramatico') is-invalid @enderror" data-live-search="true" name="modeloProgramatico" title="Selecione..."  required>
                    @foreach ($mpSinAsignar as $can)
                        <option data-subtext="{{ $can->codigo }}" value="{{ $can->id }}" {{ (old("modeloProgramatico") == $can->id ? "selected":"") }}>{{ $can->nombre }}</option>
                    @endforeach
                </select>

                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Asignar</button>
        </div>
    </div>
</form> 
@endcan


 
      
<div class="row">
    @foreach ($planificacion->planificacionModelos as $planificacionModelo)
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header bg-{{ $planificacionModelo->planificacion->estado=='proceso'?'primary':'warning' }}">
                    <h1>
                        <strong>
                                {{ $planificacionModelo->modeloProgramatico->nombre }}
                        </strong>
                    </h1>
                    <small class="float-right">{{ $planificacionModelo->planificacion->estado }}</small>
                </div>
                
                <div class="card-body">
                        <ul class="media-list">
                            @foreach($planificacionModelo->poas as $poa)
                            
                                <li class="media">
                                    <div class="mr-3">
                                        <a href="#">
                                            <img src="{{ asset('img/cactu.png') }}"  class="rounded-circle" width="40" height="40" alt="">
                                        </a>
                                    </div>
        
                                    <div class="media-body">
                                        <div class="media-title font-weight-semibold">{{$poa->actividad->nombre}}</div>
                                        <span class="text-muted">Creado por:{{$poa->creadoPor($poa->creadoPor)->email}}</span>
                                        
                                    </div>
                                    
                                </li>
                            @endforeach
                        </ul>
                </div>

                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    @can('creaPlanificacionModelo', $planificacion)
                        <button type="button" class="btn btn-danger" onclick="eliminar(this);" data-id="{{ $planificacionModelo->id }}" data-toggle="tooltip" data-placement="top" title="Eliminar  {{ $planificacionModelo->modeloProgramatico->nombre }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    @endcan
                    <a href="{{ route('armarPoa',$planificacionModelo->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Crear actividades en {{ $planificacionModelo->modeloProgramatico->nombre }}" >
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
            
        </div>
        @endforeach
</div>

@push('linksCabeza')
    <link rel="stylesheet" href="{{ asset('admin/plus/select/css/bootstrap-select.min.css') }}">
    <script src="{{ asset('admin/plus/select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('admin/plus/select/js/lg/defaults-es_ES.min.js') }}"></script>
@endpush

@prepend('linksPie')
 
<script type="text/javascript">
    function eliminar(arg){            
        var id=$(arg).data('id');
        swal({
            title: "¿Estás seguro?",
            text: "Tu no podrás recuperar esta información.!",
            type: "error",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            cancelButtonClass: "btn-danger",
            confirmButtonText: "¡Sí, bórralo!",
            cancelButtonText:"Cancelar",
            closeOnConfirm: false
        },
        function(){
            swal.close();
            $.blockUI({message:'<h1>Espere por favor.!</h1>'});
            $.post( "{{ route('elimminar-asignarmodelo') }}", { idPlanificacionModelo: id })
            .done(function( data ) {
                if(data.success){                    
                    notificar("info",data.success);
                    window.location.replace("{{route('planificaciones-modelo',$planificacion->id)}}");
                }
                if(data.default){
                    notificar("default",data.default);   
                }
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                notificar("error","Ocurrio un error");
            });

        });
    }    
</script>

<script>
    $('#menuPlanificacion').addClass('active');
</script>
@endprepend

@endsection