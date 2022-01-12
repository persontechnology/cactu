@extends('layouts.app',['title'=>'Nuevo cuenta c.'])
@section('breadcrumbs', Breadcrumbs::render('nuevoCuentaContable'))
@section('content')

<form action="{{ route('guardar-cuenta') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header"> 
            Complete información
        </div>
        
        <div class="card-body"> 
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nombre <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input type="text"  id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" required>
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
</form> 


@push('linksCabeza')
@endpush

@prepend('linksPie')

    <script>
        $('#menuCuentaContable').addClass('active');
    </script>
@endprepend

@endsection