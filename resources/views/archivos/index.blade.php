@extends('layouts.app',['title'=>'Mis archivos'])

@section('breadcrumbs', Breadcrumbs::render('misArchivos'))

@section('barraLateral')
@can('gestionDeArchivos',cactu\Models\Archivo::class)
<div class="breadcrumb justify-content-center">
    <a href="{{ route('nuevoArchivo') }}" class="breadcrumb-elements-item">
        <i class="fas fa-plus"></i>
        Nuevo archivo
    </a>

    <a href="{{ route('listadoArchivo') }}" class="breadcrumb-elements-item">
        <i class="fas fa-list"></i>
        Listado
    </a>
</div>
@endcan
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        Mis archivos compartidos
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {!! $dataTable->table()  !!}
        </div>
    </div>
    
</div>

@push('linksCabeza')
{{--  datatable  --}}
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plus/DataTables/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('admin/plus/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
@endpush

@prepend('linksPie')


  <script>
      $('#menuArchivos').addClass('active');
      
  </script>
   {!! $dataTable->scripts() !!}
@endprepend

@endsection
