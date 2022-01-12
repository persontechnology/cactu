@extends('layouts.app',['title'=>'Actualizar actividad POA'])

@section('breadcrumbs', Breadcrumbs::render('editarPoa',$poa))


@section('content')

@can('crearPoa', $poa->planificacionModelo)

    <form action="{{ route('actualizarPoaItem') }}" method="POST">
        @csrf
        <input type="hidden" name="poa" value="{{ $poa->id }}">
        <div class="card">
            <div class="card-header">
                Complete información
                
            </div>
            <div class="card-body">
                    
                    {{-- actividades --}}

                    @if (count($actividades)>0)
                        <div class="form-group">
                            <label for="actividad">Actividades</label>
                            <select class="form-control selectpicker  @error('actividad') is-invalid @enderror" id="actividad" name="actividad" data-live-search="true" required>
                            @foreach ($actividades as $act)
                                <option {{ (old("actividad",$poa->actividad->id) == $act->id ? "selected":"") }} data-subtext="{{ $act->modeloProgramatico->codigo.''.$act->codigo }}" value="{{ $act->id }}">{{ $act->nombre }}</option>    
                            @endforeach
                            
                            </select>
                        </div>
                    @else
                    <div class="alert alert-primary alert-styled-left alert-dismissible">
                        <span class="font-weight-semibold">No existe actividades</span>
                    </div>
                    @endif
                    

                    {{-- modulo --}}


                    @if (count($modulos)>0)
                        <div class="form-group">
                            <label for="modulo">Módulos</label>
                            <select class="form-control selectpicker  @error('modulo') is-invalid @enderror" id="modulo" name="modulo" data-live-search="true" required>
                            @foreach ($modulos as $mod)
                                <option {{ (old("modulo",$poa->modulo->id) == $mod->id ? "selected":"") }} value="{{ $mod->id }}">{{ $mod->codigo }} - {{ $mod->nombre }}</option>    
                            @endforeach
                            
                            </select>
                        </div>
                    @else
                    <div class="alert alert-primary alert-styled-left alert-dismissible">
                        <span class="font-weight-semibold">No existe módulos</span>
                    </div>
                    @endif


                    <div class="form-group">
                        <label for="numeroSesion">Número de sesiones</label>
                        <input type="number" value="{{ old('numeroSesion',$poa->numeroSesiones) }}" name="numeroSesion" class="form-control" id="numeroSession" placeholder="Ingrese número de sessiones" required>
                    </div>


                    <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3" placeholder="Ingrese">{{ old('descripcion',$poa->descripcion) }}</textarea>
                    </div>
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-primary" type="submit">Actualizar <i class="icon-paperplane ml-2"></i></button>
            </div>
        </div>
    </form>
@else
<div class="alert alert-primary" role="alert">
    Solo puede crear actvidades en planificación con estado en <strong>proceso</strong>
</div>
@endcan

@push('linksCabeza')
    <link rel="stylesheet" href="{{ asset('admin/plus/select/css/bootstrap-select.min.css') }}">
    <script src="{{ asset('admin/plus/select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('admin/plus/select/js/lg/defaults-es_ES.min.js') }}"></script>
@endpush

@prepend('linksPie')
    <script>
        $('#menuPlanificacion').addClass('active');
    </script>
@endprepend

@endsection
