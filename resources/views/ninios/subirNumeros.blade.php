@extends('layouts.app',['title'=>'Administracíon Módulos'])
@section('breadcrumbs', Breadcrumbs::render('subirNinio'))
@section('content')

<div class="card">
    <div class="card-header">
            
        <p><strong class="text-warning">Advertencia:</strong> El archvio excel debe regirse <strong>extrictamente</strong> al formato presentado a continuación.</p>
        <ul>
            <li>
                <p>Por favor, elimine la primera fila del encabezado, cuando vaya subir la información</p>
            </li>
            <li>
                <p>Verifiqué que los números de célular tengan el codigo internacional de tu país en este caso el código de ecuador es 593 + el número de celular sin el 0
             </li>
            <li>
                <p> <strong class="text-warning">Máximo de registros en el excel de 2200 filas ,El archivo debe pesar max:470 kilobytes.</strong></p>
            </li>
        </ul>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                <tr class="bg-dark">
                    <th scope="col">Child Number</th>
                    <th scope="col">Papá</th>                    
                    <th scope="col">Mamá</th>
                    <th scope="col">Representante</th>
                    <th scope="col">Celular Representante</th>
                    <th scope="col">Email Representante</th>
                    <th scope="col">Celular Niño</th>
                    <th scope="col">Email Ninño</th>
                 
                </tr >
                </thead >
                <tbody >
                <tr>
                    <td>153032490</td>
                    <td>Luis Orlando Analuisa Yugcha</td>
                    <td>María Mercedes Tasinchano Sopalo </td>
                    <td>TASINCHANO SOPALO MARIA MERCEDES </td>
                    <td>593984665615</td>
                    <td>mercedes@gmail.com</td>
                    <td>593984665856</td>
                    <td>luis@gmail.com</td>
                    
                </tr>
            </table>
        </div>
    </div>
    <div class="card-body">
                  
    <form action="{{route('subir-numero-ninio')}}" method="post" enctype="multipart/form-data">
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