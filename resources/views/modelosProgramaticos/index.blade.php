@extends('layouts.app',['title'=>'Modelos Programaticos'])
@section('breadcrumbs', Breadcrumbs::render('modelosProgramaticos'))
@section('barraLateral')
    @parent
    <div class="breadcrumb justify-content-center">

        <a href="{{route('nuevo-modelo')}}" class="breadcrumb-elements-item">
            <i class="fas fa-plus"></i> Nuevo Modelo P.
        </a>
        <div class="breadcrumb-elements-item dropdown p-0">
            <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-file-excel"></i>
                Importar Datos
            </a>
            <div class="dropdown-menu dropdown-menu-right">              
                <a href="{{ route('modelosImportar') }}" class="dropdown-item"><i class="fas fa-list"></i>Importar modelos Programáticos</a>              
                <a href="{{ route('actividadImportar') }}" class="dropdown-item"><i class="fas fa-list"></i>Importar Actividades</a> 
                <a href="{{ route('moduloImportar') }}" class="dropdown-item"><i class="fas fa-list"></i>Importar Módulos</a>  
                            
            </div>
        
        </div>
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
                $.post( "{{ route('eliminar-modelo') }}", { modelo: id })
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
        $('#menuModeloProgramatico').addClass('active');
    </script>
@endprepend

@endsection