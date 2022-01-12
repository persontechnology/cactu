@extends('layouts.app',['title'=>'Actualizar M.P'])
@section('breadcrumbs', Breadcrumbs::render('editarModeloProgramatico',$modelo))

@section('content')

<form action="{{route('actualizar-modelo')}}" method="post">
    @csrf
    <input type="hidden" value="{{$modelo->id}}" name="modelo" id="modelo">
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">        

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nombre <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input type="text"  id="nombre" name="nombre" value="{{ old('nombre',$modelo->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" >
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Código <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input style="text-transform:uppercase;"  value="{{ old('codigo',$modelo->codigo) }}" id="codigo" name="codigo"  type="text" class="@error('codigo') is-invalid @enderror form-control" >
                @error('codigo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            </div>

        </div>
        <div class="card-footer">
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