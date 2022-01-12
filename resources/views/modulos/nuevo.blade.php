@extends('layouts.app',['title'=>'Nuevo modulo'])
@section('breadcrumbs', Breadcrumbs::render('nuevModulo',$modelo))

@section('content')
<form action="{{route('guardar-modulo')}}" method="post">
    @csrf

    <div class="card">
        <div class="card-header">
            Nuevo módulo del modelo <span class="badge badge-flat bg-light">{{$modelo->nombre}}</span> 
        </div>
        <div class="card-body">            
                <input type="hidden" name="modelo" id="modelo" value="{{$modelo->id}}">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Código <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <input style="text-transform:uppercase;"  value="{{ old('codigo') }}" id="codigo" name="codigo"  type="text" class="@error('codigo') is-invalid @enderror form-control" required >
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
        $('#menuModeloProgramatico').addClass('active');
    </script>
@endprepend

@endsection