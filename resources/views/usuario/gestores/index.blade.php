@extends('layouts.app',['title'=>'Gestores'])

@section('breadcrumbs', Breadcrumbs::render('gestores'))

@section('barraLateral')

    <div class="breadcrumb justify-content-center">
        <a href="{{ route('gestoresNuevo') }}" class="breadcrumb-elements-item">
            <i class="fas fa-plus"></i>
            Nuevo gestor
        </a>
    </div>
@endsection

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
        $('#menuGestores').addClass('active');
        function eliminar(arg){
            var url="{{ route('eliminarGestor') }}";
            var id=$(arg).data('id');
            swal({
                title: "¿Estás seguro?",
                text: "Tu no podrás recuperar esta información.!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                cancelButtonClass: "btn-danger",
                confirmButtonText: "¡Sí, bórralo!",
                cancelButtonText:"Cancelar",
                closeOnConfirm: false
            },
            function(){
                swal.close();
                $.blockUI({message:'<h1>Espere por favor.!</h1>'});
                $.post( url, { user: id })
                .done(function( data ) {
                    if(data.success){
                        $('#dataTableBuilder').DataTable().draw(false);
                        notificar("info",data.success);
                    }
                    if(data.default){
                        notificar("default",data.default);   
                    }
                    console.log(data)
                }).always(function(){
                    $.unblockUI();
                }).fail(function(){
                    notificar("error","Ocurrio un error");
                });
    
            });
        }
    </script>
    {!! $dataTable->scripts() !!}
    
@endprepend

@endsection
