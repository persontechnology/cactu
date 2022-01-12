@extends('layouts.app',['title'=>'Administración'])

@section('breadcrumbs', Breadcrumbs::render('poaActividad',$poa))

@section('content')



@can('crearPoaActividad', $poa)
    <form action="{{ route('poaActividadGuardar') }}" method="POST">            
    @csrf
    <div class="card">
        <div class="card-header">
            Selecione tipo de actividad
        </div>
        <div class="card-body">
            
            
            <input type="hidden" name="poa" value="{{ $poa->id }}">
            <div class="form-group">
                <select class="form-control" id="tipoActividad" name="tipoActividad">
                    @foreach ($tipoActividades as $tipoAc)
                        <option value="{{ $tipoAc->id }}">{{ $tipoAc->nombre }}</option>
                    @endforeach
                </select>
            </div>
                
            
        </div>
        <div class="card-body">
            <button type="submit" class="btn btn-primary">Guardar tipo de actividad <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
</form> 
@endcan 


@can('actualizarPoaActividad', $poa)
    <form action="{{ route('poaActividadGuardar') }}" method="POST">            
    @csrf
    <input type="hidden" name="poa" value="{{ $poa->id }}">
    <div class="card">
        <div class="card-header">
            Selecione tipo de actividad
        </div>
        <div class="card-body">

            <div class="form-group">
                <select class="form-control" id="tipoActividad" name="tipoActividad">
                    @foreach ($tipoActividades as $tipoAc)
                        <option value="{{ $tipoAc->id }}" {{ $poa->poaActividad->tipoActividad->id==$tipoAc->id?'selected':'' }}>{{ $tipoAc->nombre }}</option>
                    @endforeach
                </select>
            </div>
                
            
        </div>
        
        <div class="card-body">
            <button type="submit" class="btn btn-primary">Actualizar tipo de actividad <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
</form> 

@endcan 

<form action="{{ route('actualizarValorMesPoaActividad') }}" method="POST">
    @csrf
    <input type="hidden" name="poa" value="{{ $poa->id }}" required>
    <div class="card">
        <div class="card-header">
            Meses
        </div>
        <div class="card-body">
            @if ($poaActividad)
                @if (count($poaActividad->meses)>0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    @foreach ($poaActividad->meses as $mh)
                                        <th scope="col">{{ $mh->mes }}</th>
                                    @endforeach
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
        
                                    @foreach ($poaActividad->meses as $mb)
                                        <th scope="row">
                                            
                                            <input type="hidden" name="poaActMes[{{ $mb->poaActividadMes->id }}]" value="{{ $mb->poaActividadMes->id }}">
                                            @can('actualizarPoaActividad', $poa)
                                            <input style="width: 70px;" type="number" name="valores[{{ $mb->poaActividadMes->id }}]" value="{{ $mb->poaActividadMes->valor }}" class="form-control form-control-sm" required>
                                            @else
                                            {{ $mb->poaActividadMes->valor }}
                                            @endcan
                                        </th>
                                    @endforeach
                                    <td>
                                        {{ 
                                            $poaActividad->meses->sum('poaActividadMes.valor')
                                        }}
                                    </td>
                                    
                                </tr>
                                
                            </tbody>
                        </table> 
                        <p>Número maximo de sesiones a asignar <strong>{{ $poa->numeroSesiones }}</strong></p>
                    </div>   
                @else
                    <p>no tiene meses</p>
                @endif
            @else
            <div class="alert alert-primary">
                <span class="font-weight-semibold">Sin actividades</span>
            </div>
            @endif
        </div>
        @can('actualizarPoaActividad', $poa)
        <div class="card-body">
            <button class="btn btn-primary">Guardar <i class="icon-paperplane ml-2"></i></button>
        </div>
        @endcan
    </div>
</form>








@push('linksCabeza')

@endpush

@prepend('linksPie')
    <script>
        $('#menuPlanificacion').addClass('active');
    </script>
@endprepend

@endsection
