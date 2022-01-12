@extends('layouts.app',['title'=>'Administracíon Módulos'])
@section('breadcrumbs', Breadcrumbs::render('modulos',$modelo))
@section('barraLateral')
    @parent
    <div class="breadcrumb justify-content-center">

        <a href="{{route('nueva-modulo',$modelo->id)}}" class="breadcrumb-elements-item">
           <i class="fas fa-plus"></i> Nuevo módulo
        </a>
    </div>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
    	
        Módulos del modelo <span class="badge badge-light border-success">{{$modelo->nombre . '-' . $modelo->codigo}}</span> 		
    	
    </div>
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
   {!! $dataTable->scripts() !!}
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
                $.post( "{{ route('eliminar-modulo') }}", { modulo: id })
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

    <script>
        $('#menuModeloProgramatico').addClass('active');
    </script>
@endprepend

@endsection