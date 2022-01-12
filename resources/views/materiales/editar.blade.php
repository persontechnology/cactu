@extends('layouts.app',['title'=>'Editar Material.'])
@section('breadcrumbs', Breadcrumbs::render('Editarmaterial',$material))
@section('content')

<form action="{{ route('actualizar-material') }}" method="POST">
    @csrf
    <input type="hidden" value="{{ $material->id }}" id="material" name="material">
    <div class="card">
        <div class="card-header"> 
            Complete información
        </div>
        
        <div class="card-body"> 
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nombre del material <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <input type="text"  id="nombre" name="nombre" value="{{ old('nombre', $material->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" >
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Precio del material <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number"  placeholder="0.00" min="0" pattern="^\d+(?:\.\d{1,2})?$" step="0.01" id="precio" name="precio" value="{{ old('precio', $material->precio) }}" class="form-control @error('precio') is-invalid @enderror" >
                        @error('precio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                   
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Iva del material <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <div class="input-group mb-3">                       
                        
                        <input type="number" placeholder="0.12" min="0" pattern="^\d+(?:\.\d{1,2})?$" step="0.01" id="iva" name="iva" value="{{ old('iva', $material->iva) }}" class="form-control @error('iva') is-invalid @enderror" >
                        
                    <div class="input-group-prepend">
                        <span class="input-group-text">%</span>
                    </div>
                    @error('iva')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                   
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
        $('#menuCuentaContable').addClass('active');
    </script>
@endprepend

@endsection