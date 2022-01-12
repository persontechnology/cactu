@extends('layouts.app',['title'=>'Actualizar modulo'])

@section('breadcrumbs', Breadcrumbs::render('editarModulo',$modulo))

@section('content')
<form action="{{route('actualizar-modulo')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            Complete información        
        </div>
        <div class="card-body">        
    
            <input type="hidden" value="{{$modulo->id}}" name="modulo" id="modulo">
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Código <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input style="text-transform:uppercase;"  value="{{ old('codigo',$modulo->codigo) }}" id="codigo" name="codigo"  type="text" class="@error('codigo') is-invalid @enderror form-control" required>
                @error('codigo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nombre <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input type="text"  id="nombre" name="nombre" value="{{ old('nombre',$modulo->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" required>
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Actualizar <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
</form>

@push('linksCabeza')
    
@endpush

@prepend('linksPie')
  
    <script>
        $('#menuModeloProgramatico').addClass('active');
    </script>
@endprepend

@endsection