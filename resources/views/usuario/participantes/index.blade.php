@extends('layouts.app',['title'=>'Personal SL.'])

@section('breadcrumbs', Breadcrumbs::render('participantes'))



@section('content')

<div class="card card-body">
    <div class="table-responsive">
        {!! $dataTable->table()  !!}
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
        $('#menuParticipantes').addClass('active');
    </script>
    {!! $dataTable->scripts() !!}
    
@endprepend

@endsection
