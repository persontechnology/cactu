@extends('layouts.app',['title'=>'Actualizar cuenta contable'])
@section('breadcrumbs', Breadcrumbs::render('EditarcuentaContable',$modelo))

@section('content')

<form action="{{route('actualizar-cuenta')}}" method="post">
    @csrf
    <input type="hidden" value="{{$modelo->id}}" name="modelo" id="modelo">
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">        
            <div class="form-group row">
                <label class="col-form-label col-lg-2">Nombre <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input type="text"  id="nombre" name="nombre" value="{{ old('nombre',$modelo->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" required >
                    @error('nombre')
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
        $('#menuCuentaContable').addClass('active');
    </script>
@endprepend

@endsection