@extends('layouts.app',['title'=>'Nueva provincia'])

@section('breadcrumbs', Breadcrumbs::render('nuevaProvincia'))

@section('content')
<form method="POST" action="{{ route('guardarProvincia') }}">
    @csrf
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">
            
                
                <div class="form-group row">
                    <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<i class="text-danger">*</i></label>

                    <div class="col-md-6">
                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

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
                        <input id="email" type="codigo" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo">

                        @error('codigo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


        </div>
        <div class="card-footer text-muted">
            <button class="btn btn-primary" type="submit">Guardar <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
    
</form>


@push('linksCabeza')

@endpush

@prepend('linksPie')
    <script>
        $('#menuLocalidad').addClass('nav-item-expanded nav-item-open');
        $('#menuProvincia').addClass('active');
    </script>
    
@endprepend

@endsection
