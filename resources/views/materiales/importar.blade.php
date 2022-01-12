@extends('layouts.app',['title'=>'Administracíon Módulos'])
@section('breadcrumbs', Breadcrumbs::render('importarMaterial'))
@section('content')

<div class="card">
    <div class="card-header">
            
        <p><strong class="text-warning">Advertencia:</strong> El archvio excel debe regirse <strong>extrictamente</strong> al formato presentado a continuación.</p>
        <ul>
            <li>
                <p>Por favor, elimine la primera fila del encabezado, cuando vaya subir la información</p>
            </li>
            
        </ul>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                <tr class="bg-dark">
                    <th scope="col">Nombre Material</th>
                    <th scope="col">Precio</th>
                    
                    <th scope="col">Iva</th>
                    
                    
                </tr >
                </thead >
                <tbody >
                <tr>
                    <td>PAÑITOS PEQUEÑIN 120 DISPENSADOR ALOE</td>
                    <td>3.04</td>
                    <td>12</td>       
                    
                </tr>
            </table>
        </div>
    </div>
    <div class="card-body">
                  
    <form action="{{route('importar-material-guardar')}}" method="post" enctype="multipart/form-data">
        @csrf
        <legend class="text-uppercase font-size-sm font-weight-bold">Completar información</legend>
                 
            <div class="col-sm-12">  
            <div class="file-loading">
                <input  type="file"  name="archivo" id="archivo" class="@error('foto') is-invalid @enderror" >
            </div>
            @error('foto')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
    </form>
    </div>
    <div class="card-footer text-muted">
        Actividades del modelo   
    </div>
</div>

@push('linksCabeza')
{{-- file input --}}
<link href="{{ asset('admin/plus/bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ asset('admin/plus/bootstrap-fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
<script src="{{asset('admin/plus/bootstrap-fileinput/js/plugins/purify.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/js/locales/es.js') }}"></script>
{{-- fin file input --}}
  
@endpush

@prepend('linksPie')
 <script>
 
$("#archivo").fileinput({
  
   
    maxImageWidth: 1200,
    maxImageHeight: 650,
    resizePreference: 'height',
    autoReplace: true,
    maxFileCount: 1,
    resizeImage: true,
    resizeIfSizeMoreThan: 1000,
    theme:'fas',
    language:'es'
})

    </script>
@endprepend

@endsection