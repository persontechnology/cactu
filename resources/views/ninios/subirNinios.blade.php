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
                <p>Verifiqué que en las columnas que son <b> Numéricas y Fechas </b>  no poseen caractes especiales tales como "- , _" deben estar vacíos.</p>
            </li>
            <li>
                <p> <strong class="text-warning">Máximo de registros en el excel de 2200 filas ,El archivo debe pesar max:470 kilobytes.</strong></p>
            </li>
        </ul>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                <tr class="bg-dark">
                    <th scope="col">Community #</th>
                    <th scope="col">Village</th>
                    
                    <th scope="col">Participant Case Number</th>
                    <th scope="col">Child Number</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Sponsorship Status</th>
                    <th scope="col">Enrolled On Date</th>
                    <th scope="col">Age</th>
                    <th scope="col">Local Partner</th>
                    <th scope="col">PAPÁ</th>
                    <th scope="col">MAMÁ</th>
                    <th scope="col">HERMANX 1</th>
                    <th scope="col">HERMANX 2</th>
                    <th scope="col">HERMANX 3</th>
                    <th scope="col">HERMANX 4</th>
                    <th scope="col">HERMANX 5</th>
                    <th scope="col">HERMANX 6</th>
                    <th scope="col">HERMANX 7</th>
                    <th scope="col">HERMANX 8</th>
                    <th scope="col">Abuelo</th>
                    <th scope="col">Abuela</th>
                    <th scope="col">Tí@</th>
                    <th scope="col">Cuñad@</th>
                    <th scope="col">Sobrin@/Prim@</th>
                    <th scope="col">Otros 1</th>
                    <th scope="col">Otros 2</th>
                    <th scope="col">Otros 3</th>
                    <th scope="col">Maestr@</th>
                </tr >
                </thead >
                <tbody >
                <tr>
                    <td>2679</td>
                    <td>Angamarca</td>
                    <td>334</td>
                    <td>153056506</td>
                    <td>Alex Alejandro Chicaiza Guaranda</td>
                    <td>Male</td>
                    <td>01/10/2004</td>
                    <td>Sponsored</td>
                    <td>02/06/2017</td>
                    <td>14</td>
                    <td>Ecuador Cotopaxi Area</td>
                    <td>Alex Alejandro Chicaiza</td>
                    <td>Alexa Guaranda</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card-body">
                  
    <form action="{{route('importar-archivo')}}" method="post" enctype="multipart/form-data">
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