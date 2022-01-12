@extends('layouts.app',['title'=>'Administración'])

@section('breadcrumbs', Breadcrumbs::render('poaParticipantes',$poa))

@section('content')

<div class="card">
    <ul class="nav nav-tabs nav-tabs-solid bg-orange-400 border-0">
        <li class="nav-item">
            <a class="nav-link active" id="descripcion-tab" data-toggle="tab" href="#descripcion" role="tab" aria-controls="descripcion" aria-selected="true"> Descripción <i class="icon-menu7 mr-2"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="comunidades-tab" data-toggle="tab" href="#comunidades" role="tab" aria-controls="comunidades" aria-selected="false">Comunidades <i class="icon-home mr-2"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tipoParticipantes-tab" data-toggle="tab" href="#tipoParticipantes" role="tab" aria-controls="tipoParticipantes" aria-selected="false"> Tipo de participantes <i class="icon-magazine mr-2"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="coordinadores-tab" data-toggle="tab" href="#coordinadores" role="tab" aria-controls="coordinadores" aria-selected="false">Coordinadores  <i class="icon-reading mr-2"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="meses-tab" data-toggle="tab" href="#meses" role="tab" aria-controls="meses" aria-selected="false">
                Meses <i class=" icon-calendar52 mr-2"></i>
            </a>
        </li>
    </ul>      
    <div class="tab-content">
        <div class="tab-pane active" id="descripcion" role="tabpanel" aria-labelledby="descripcion-tab">
            <form action="{{ route('actualizarPoaParticipante') }}" method="POST">   
                @csrf
                <input type="hidden" name="poa" value="{{ $poa->id }}">
                <div class="card">
                    <div class="card-header">
                        Descripción
                    </div>
                    <div class="card-body">            
                        <div class="form-group">
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" required  placeholder="Ingrese descripción..">{{ old('descripcion',$poa->poaParticipante->descripcion??'') }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-primary" type="submit">Guardar <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="comunidades" role="tabpanel" aria-labelledby="comunidades-tab">
            <form action="{{ route('actualizarPoaParticipanteComunidades') }}" method="POST">
                @csrf
                <input type="hidden" name="poa" value="{{ $poa->id }}">
                <div class="card">
                    <div class="card-header">
                        Comunidades
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control milista" id="comunidades" name="comunidades[]" multiple>
                                @foreach ($comunidadesNo as $comunidadNo)
                                    <option value="{{ $comunidadNo->id }}">{{ $comunidadNo->nombre }}</option>
                                @endforeach
                                @foreach ($comunidadesSi as $comunidadSi)
                                    <option value="{{ $comunidadSi->id }}" selected>{{ $comunidadSi->nombre }}</option>
                                @endforeach
                            </select>
                        </div>                        
                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-primary" type="submit">Guardar <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="tipoParticipantes" role="tabpanel" aria-labelledby="tipoParticipantes-tab">
            <form action="{{ route('actualizarPoaParticipanteTipoParticipante') }}" method="POST">
                @csrf
                <input type="hidden" name="poa" value="{{ $poa->id }}">
                <div class="card">
                    <div class="card-header">
                        Tipo de participantes
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control milista" id="tipoParticipantes" name="tipoParticipantes[]" multiple>
                                @foreach ($tipoParticipantesNo as $tipoParticipanteNo)
                                    <option value="{{ $tipoParticipanteNo->id }}">{{ $tipoParticipanteNo->nombre }}</option>
                                @endforeach
                                @foreach ($tipoParticipantesSi as $tipoParticipanteSi)
                                    <option value="{{ $tipoParticipanteSi->id }}" selected>{{ $tipoParticipanteSi->nombre }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Guardar <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="coordinadores" role="tabpanel" aria-labelledby="coordinadores-tab">
            @if (count($comunidadesSi)>0)
            <form action="{{ route('actualizarPoaParticipanteCoordinador') }}" method="POST">
            @csrf
                <div class="card">
                    <div class="card-header">
                        Coordinador asignado
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Provincia</th>
                                        <th scope="col">Cantón</th>
                                        <th scope="col">Comunidad</th>
                                        <th scope="col">Gestores</th>
                                        <th scope="col">Coordinadores</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                
                                    @foreach ($comunidadesSi as $comunidadUser)
                                    
                                        
                                        <tr>
                                            <td>
                                                {{ $comunidadUser->canton->provincia->nombre }}
                                            </td>
                                            <td>
                                                {{ $comunidadUser->canton->nombre }}
                                            </td>
                                            <td>
                                                {{ $comunidadUser->nombre }}
                                            </td>
                                            <td>
                                                @if($comunidadUser->comunidadPoaParticipante->gestor_id)
                                                    
                                                    {{ 
                                                        $comunidadUser->usuarioGestorCoordinador($comunidadUser->comunidadPoaParticipante->gestor_id)
                                                        ->name
                                                    }}
                                                
                                                @else
                                                    <span>
                                                        {{ $comunidadUser->usuario->name }} <i class="text-primary" data-toggle="tooltip" title="Gestor sin asignar">?</i>
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (count($comunidadUser->canton->provincia->coordinadores)>0)
                                                
                                                    <input type="hidden" name="comunidadPoaParticipante[]" value="{{ $comunidadUser->comunidadPoaParticipante->id }}" required>
                                                
                                                    <select class="form-control" name="coordinador[]">
                                                        @foreach ($comunidadUser->canton->provincia->coordinadores as $coor)
                                                        <option value="{{ $coor->id }}" {{ $comunidadUser->comunidadPoaParticipante->coordinador_id==$coor->id?'selected':'' }}>{{ $coor->name }}</option>
                                                        @endforeach       
                                                    </select>
                                                
                                                
                                                    @if(!$comunidadUser->comunidadPoaParticipante->coordinador_id)
                                                        <i class="text-primary float-right" data-toggle="tooltip" title="Coordinador sin asignar">?</i>
                                                    @endif
                                                @else
                                                    <div class="alert alert-primary" role="alert">
                                                        No existe <strong>coordinadores</strong>
                                                    </div>
                                                @endif                                           
                                            </td>
                                                                                  
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>                    
                    </div>
                    <div class="card-footer text-muted">
                        <button type="submit" class="btn btn-primary">
                            Actualizar
                        </button>
                    </div>
                </div>    
            </form>       
            @else
                <div class="alert alert-primary" role="alert">
                    Sin asignar comunidades
                </div>
            @endif
        </div>
        <div class="tab-pane" id="meses" role="tabpanel" aria-labelledby="meses-tab">
            <div class="card">
                <div class="card-header">
                    Sesiones por actividad
                </div>
                <div class="card-body">
                    @if ($poa->poaActividad)
                        @if (count($poa->poaActividad->meses)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            @foreach ($poa->poaActividad->meses as $mh_a)
                                                <th scope="col">{{ $mh_a->mes }}</th>
                                            @endforeach
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>                
                                            @foreach ($poa->poaActividad->meses as $mb_a)
                                            <th scope="row">                                                   
                                                {{ $mb_a->poaActividadMes->valor }}
                                            </th>
                                            @endforeach
                                            <td>
                                                {{ 
                                                    $poa->poaActividad->meses->sum('poaActividadMes.valor')
                                                 }}
                                            </td>                                            
                                        </tr>                                        
                                    </tbody>
                                </table>                               
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
            </div>
            <form action="{{ route('actualizarValorMesPoaParticipante') }}" method="POST">
                @csrf
                <input type="hidden" name="poa" value="{{ $poa->id }}" required>
                <div class="card">
                    <div class="card-header">
                        Número de participantes por mes
                    </div>
                    <div class="card-body">
                        @if ($poa->poaParticipante)
                            @if (count($poa->poaParticipante->meses)>0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                @foreach ($poa->poaParticipante->meses as $mh)
                                                    <th scope="col">{{ $mh->mes }}</th>
                                                @endforeach
                                                <th>Total</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>                    
                                                @foreach ($poa->poaParticipante->meses as $mb)
                                                <th scope="row">
                                                    <input type="hidden" name="poaPartMes[{{ $mb->poaParticipanteMes->id }}]" value="{{ $mb->poaParticipanteMes->id }}">
                                                   @if ($poa->poaActividad->mesesXmes($mb->mes))
                                                   <input style="width: 70px;" type="number" name="valores[{{ $mb->poaParticipanteMes->id }}]" value="{{ $mb->poaParticipanteMes->valor }}" class="form-control form-control-sm border border-success" required>
                                                   @else
                                                   <input style="width: 70px;" type="number" name="valores[{{ $mb->poaParticipanteMes->id }}]" value="{{ $mb->poaParticipanteMes->valor }}" class="form-control form-control-sm border border-warning" required>
                                                   @endif
                                                    
                                                </th>
                                                @endforeach
                                                <td>
                                                    {{ 
                                                        $poa->poaParticipante->meses->sum('poaParticipanteMes.valor')
                                                     }}
                                                </td>
                                            </tr>                                            
                                        </tbody>
                                    </table> 
                                    <small>
                                    <strong>Nota:</strong>
                                    Solo el campo de color verde tiene planificación, donde puede agregar # de participantes por mes.
                                    </small>
                                </div>   
                            @else
                                <p>no tiene meses</p>
                            @endif
                        @else
                        <div class="alert alert-primary">
                            <span class="font-weight-semibold">Sin participantes</span>
                        </div>
                        @endif
                    </div>                    
                    <div class="card-body">
                        <button class="btn btn-primary">Guardar</button>
                    </div>                    
                </div>
            </form>
        </div>
    </div>      
</div>     
@push('linksCabeza')

{{--  dual select  --}}
<link rel="stylesheet" href="{{ asset('admin/plus/dual-listbox/bootstrap-duallistbox.min.css') }}">
<script src="{{ asset('admin/plus/dual-listbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

{{--  toogle  --}}
<link href="{{ asset('admin/plus/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
<script src="{{ asset('admin/plus/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>
@endpush

@prepend('linksPie')
<script>
    $('#menuPlanificacion').addClass('active');
    
    @if (session('tabs'))
        $('#{{ session('tabs') }}').tab('show')
    @endif

    $('.milista').bootstrapDualListbox({
        nonSelectedListLabel: '<strong>Sin asignar</strong>',
        selectedListLabel: '<strong>Asignados</strong>',
        moveOnSelect: false,
        filterTextClear:'Mostrar todo',
        filterPlaceHolder:'Filtrar..',
        moveSelectedLabel:'Mover selecionado',
        moveAllLabel:'Mover todos',
        removeSelectedLabel:'Eliminar selección',
        removeAllLabel:'Eliminar todo',
        infoText:'Mostrando todo {0}',
        infoTextFiltered:'<span class="label label-warning">Filtrado</span> {0} desde {1}',
        infoTextEmpty:'Lista vacía'
      });
</script>
@endprepend

@endsection
