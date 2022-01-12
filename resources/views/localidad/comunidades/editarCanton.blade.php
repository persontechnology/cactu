@extends('layouts.app',['title'=>'Actualizar comunidad'])

@section('breadcrumbs', Breadcrumbs::render('editarComunidadEnCantonSolo',$comunidad))


@section('content')
<form method="POST" action="{{ route('actualizarcomunidadEnCantonSolo') }}">
    @csrf
    <input type="hidden" name="comunidad" value="{{ $comunidad->id }}" required>
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">
               
        
            <div class="form-group row">
                <label for="canton" class="col-md-4 col-form-label text-md-right">{{ __('Cantón') }}<i class="text-danger">*</i></label>

                <div class="col-md-6">
                    <select class="form-control selectpicker  @error('canton') is-invalid @enderror" data-live-search="true" name="canton" required>
                        <option>Selecione Cantón</option>
                        @foreach ($cantones as $can)
                            <option data-subtext="{{ $can->codigo }}" value="{{ $can->id }}" {{ (old("canton",$comunidad->canton->id) == $can->id ? "selected":"") }}>{{ $can->nombre }}</option>
                        @endforeach
                    </select>

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-group row">
                <label for="gestor" class="col-md-4 col-form-label text-md-right">{{ __('Gestor') }}<i class="text-danger">*</i></label>

                <div class="col-md-6">
                    <select class="form-control selectpicker  @error('gestor') is-invalid @enderror" data-live-search="true"  name="gestor" required>
                        <option>Selecione Gestor</option>
                        @foreach ($gestores as $gestor)
                            <option data-subtext="{{ $gestor->email }}" value="{{ $gestor->id }}" {{ (old("gestor",$comunidad->usuario->id) == $gestor->id ? "selected":"") }}>{{ $gestor->name }}</option>
                        @endforeach
                    </select>

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<i class="text-danger">*</i></label>

                <div class="col-md-6">
                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre',$comunidad->nombre) }}" required autocomplete="nombre" autofocus>

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Código') }}<i class="text-danger">*</i></label>

                <div class="col-md-6">
                    <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo',$comunidad->codigo) }}" required autocomplete="codigo">

                    @error('codigo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            
        </div>
        <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">
                    {{ __('Actualizar') }} <i class="icon-paperplane ml-2"></i>
                </button>
        </div>
    </div>
</form>


@push('linksCabeza')
<link rel="stylesheet" href="{{ asset('admin/plus/select/css/bootstrap-select.min.css') }}">
<script src="{{ asset('admin/plus/select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('admin/plus/select/js/lg/defaults-es_ES.min.js') }}"></script>
@endpush

@prepend('linksPie')
    <script>
        $('#menuLocalidad').addClass('nav-item-expanded nav-item-open');
        $('#menuCanton').addClass('active');
    </script>
    
@endprepend

@endsection
