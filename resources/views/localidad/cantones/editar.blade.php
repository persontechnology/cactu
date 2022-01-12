@extends('layouts.app',['title'=>'Actualizar cantón'])

@section('breadcrumbs', Breadcrumbs::render('editarCanton',$canton))


@section('content')
<form method="POST" action="{{ route('actualizarCanton') }}">
    @csrf
    <input type="hidden" name="canton" value="{{ $canton->id }}" required>
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">
               
            <div class="form-group row">
                <label for="provincia" class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}<i class="text-danger">*</i></label>

                <div class="col-md-6">
                    <select class="form-control selectpicker  @error('provincia') is-invalid @enderror" data-live-search="true" name="provincia" required>
                        <option>Selecione provincia</option>
                        @foreach ($provincias as $pro)
                            <option data-subtext="{{ $pro->codigo }}" value="{{ $pro->id }}" {{ (old("provincia",$canton->provincia->id) == $pro->id ? "selected":"") }}>{{ $pro->nombre }}</option>
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
                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre',$canton->nombre) }}" required autocomplete="nombre" autofocus>

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
                    <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo',$canton->codigo) }}" required autocomplete="codigo">

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
