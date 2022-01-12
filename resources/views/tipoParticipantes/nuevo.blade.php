@extends('layouts.app',['title'=>'Nuevo tipo de participantes'])
@section('breadcrumbs', Breadcrumbs::render('nuevoTipoParticipante'))



@section('content')
<form action="{{ route('guardar-participante') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nombre <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input value="{{ old('nombre') }}" id="nombre" name="nombre"  type="text" class="@error('nombre') is-invalid @enderror form-control" required >
                    @error('nombre')
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
        $('#menuTipoParticipante').addClass('active');
    </script>
@endprepend

@endsection