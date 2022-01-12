@extends('layouts.app',['title'=>'Cuentas Contables'])
@section('breadcrumbs', Breadcrumbs::render('cuentaContables'))
@section('barraLateral')
    @parent
    <div class="breadcrumb justify-content-center">
        <a href="{{route('nuevoCuentaContable')}}" class="breadcrumb-elements-item">
           <i class="fas fa-plus mr-2"></i>Nuevo Cuenta C.
        </a>
    </div>
@endsection

@section('content')
<div class="card">
       
    <div class="card-body"> 
        <div class="table-responsive">
       	 {!! $dataTable->table()  !!}  
       	 </div>  
    </div>
</div>

@push('linksCabeza')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plus/DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('admin/plus/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
@endpush

@prepend('linksPie')
<script type="text/javascript">
        function eliminar(arg){
        
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
            $.post( "{{ route('eliminar-cuenta') }}", { idCuentaContable: id })
            .done(function( data ) {
                if(data.success){
                    $('#dataTableBuilder').DataTable().draw(false);
                    notificar("info",data.success);
                }
                if(data.default){
                    notificar("default",data.default);   
                }
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                notificar("error","Ocurrio un error");
            });

        });
    }

    
</script>
   {!! $dataTable->scripts() !!}
    <script>
        $('#menuCuentaContable').addClass('active');
    </script>
@endprepend

@endsection