@extends('layouts.app',['title'=>'Modelos Programaticos'])
@section('breadcrumbs', Breadcrumbs::render('nuevaActividades',$modelo))

@section('content')

<form action="{{route('guardar-actividad')}}" method="post">
    @csrf
    <div class="card">
        
        <div class="card-header">
            <p>Complete información</p>
            <legend class="text-uppercase font-size-sm font-weight-bold">Nueva actividad del modelo <span class="badge badge-flat bg-primary border-primary text-primary-600 rounded-5">{{$modelo->nombre}}</span> Códigos registrados: 
                @foreach($modelo->actividades as $ac)
                <span class="badge badge-flat bg-light">{{$modelo->codigo.''.$ac->codigo}} </span>,
                @endforeach
            </legend>
        </div>
        <div class="card-body">        
            <input type="hidden" name="modelo" id="modelo" value="{{$modelo->id}}">
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
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Código <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">{{$modelo->codigo}}</div>
                        </div>      
                        <input style="text-transform:uppercase;"  value="{{ old('codigo') }}" id="codigo" name="codigo"  type="text" class="@error('codigo') is-invalid @enderror form-control" required>
                        @error('codigo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
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