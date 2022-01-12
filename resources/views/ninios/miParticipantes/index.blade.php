@extends('layouts.app',['title'=>'Mis participantes'])
@section('breadcrumbs', Breadcrumbs::render('misParticipantes'))
@section('barraLateral')
    @parent
    <div class="breadcrumb justify-content-center">
        <div class="breadcrumb-elements-item dropdown p-0">
            <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-plus"></i> Nuevo participante
            </a>           

            <div class="dropdown-menu dropdown-menu-right">
                @if($tipoParticipante->count()>0)
                    @foreach($tipoParticipante as $tipo)
                   
                        <a href="{{route('nuevoMiParticipante',$tipo->id)}}" class="dropdown-item">
                            <i class="icon-user-plus"></i> {{$tipo->nombre}}
                        </a>
               
                    @endforeach
                @endif
            </div>
        </div> 
      
        
    </div>
    {{--  Full width modal   --}}

    <div id="administracionArcivos" data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-lg" tabindex="-1" >
        <div class="modal-dialog modal-full">
            <div class="modal-content contenedor  border-top-info  ">            
                <div class="modal-header ">
                     <div class="d-flex align-items-center justify-content-center">
                        <i class="icon-folder-open ml-2 text-orange fa-3x"></i>
                        <div class="ml-4">
                            <div class="font-weight-semibold">
                                <h6 id="modalnombres" class="modal-title">
                                </h6>
                            </div>
                            <span class="text-muted">
                                 <div class="progress  rounded-round" id="porcentaje">
                                 </div> 
                            </span>
                        </div>
                    </div>                 
                   
                </div>
    
                <div class="modal-body border  mt-1" id="scrollbusque"> 
                    
                    <div class="card" id="mostrarMayor">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="">
                                        <p>Ordernar la ubicación <span id="toNoIngre"></span></p>
                                        
                                        <ul class="selectable-demo-list selectable-demo-connected" id="sortable-list-basic">
                                        </ul>
                                    </div>                      
                                </div>
                                <div class="col-sm-9" >
                                    
                                  <div id="filecarga">
    
                                  </div>
                                                                  
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row" id="archivosPdfNo">
                    
                    </div>
                    <h5 class="card-title">Documentos Existentes <i class="icon-download7 ml-2"></i></h5>
                                          
                    <div class="row" id="archivosPdf">
                                    
                    </div>
                </div>
                <div class="text-right mt-1 mr-4">            
                    <button type="button" type="button" class="btn btn-default text-danger border borde-danger rounded-round" data-dismiss="modal"><i class="fa fa-window-close text-danger" aria-hidden="true"></i> Cerrar</button>
                </div>
            </div>
        </div>
    </div>
     {{--  /full width modal   --}}
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
  
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plus/bootstrap-fileinput/css/fileinput.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plus/bootstrap-fileinput//themes/explorer-fas/theme.css') }}"/>

    <script src="{{ asset('admin/plus/bootstrap-fileinput/js/plugins/piexif.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/plus/bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/plus/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('admin/plus/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
    <script src="{{ asset('admin/plus/bootstrap-fileinput/themes/explorer-fas/theme.js') }}"></script>
    <script src="{{ asset('admin/plus/bootstrap-fileinput/js/locales/es.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/plus/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/plus/progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/plus/jqueryui/interactions.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/plus/jqueryui/touch.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/plus/jqueryui/jqueryui_interactions.js') }}"></script>
    <link href="{{ asset('admin/plus/jquery-confirm/jquery-confirm.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin/plus/jquery-confirm/jquery-confirm.min.js')}}"></script>
    <script src="{{ asset('admin/js/carpeta.js')}}"></script>

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
            $.post( "{{ route('eliminarMiParticipante') }}", { ninio: id })
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

    $('#misParticipantes').addClass('active');        
    </script>
    <style>
        .modal-dialog {
          width: 98%;
          height: 92%;
          padding: 0;
          }
  
          .modal-content {
          height: 99%;
          }
           
          .modal-body {
              max-height: calc(100vh - 190px);
              overflow-y: auto;
          }
          .border-dotted{
              border-style: dotted;
              color: aliceblue;
             }
      </style>
@endprepend

@endsection