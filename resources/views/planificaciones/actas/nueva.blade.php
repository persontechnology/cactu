@extends('layouts.app',['title'=>'Administracion de actas'])
@section('breadcrumbs', Breadcrumbs::render('Actas',$poaCuentaCOntable))
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"i class="icon-clippy"></i> Administración de Actas de la actividad <strong>{{ $poaCuentaCOntable->cuentaContablePoaCuenta->poaContable->poa->actividad->nombre }}</strong>
            con el codigo <strong>{{ $poaCuentaCOntable->cuentaContablePoaCuenta->poaContable->poa->actividad->modeloProgramatico->codigo.''.$poaCuentaCOntable->cuentaContablePoaCuenta->poaContable->poa->actividad->codigo }}</strong>
            para el mes <strong>{{ $poaCuentaCOntable->mes->mes }} </strong></h5>
        <div class="header-elements">
            <div class="list-icons">
               {{--  <a class="list-icons-item" data-action="collapse"></a>
                 <a class="list-icons-item" data-action="reload"></a>                          --}}
                <a class="list-icons-item" data-action="fullscreen"></a>
            </div>
        </div>
    </div>
   
    <div class="card-body">
        <div class="d-flex align-items-start flex-column flex-md-row">
            <!-- Left content -->
            <div class="w-100 overflow-auto order-2 order-md-1">
                @foreach ($participantes as $participante)
                     <!-- Questions list -->
                     <div class="card-group-control card-group-control-right">
                            <div class="card mb-2">
                                <div class="card-header bg-dark ">
                                    <h6 class="card-title text-white">
                                        <a class="text-default collapsed text-white" data-toggle="collapse" href="#question_{{$participante->id}}">
                                            <i class="icon-coin-dollar mr-2 text-white"></i>  {{$participante->comunidad->nombre}}
                                        </a>
                                    </h6>
                                </div>
    
                                <div id="question_{{$participante->id}}" class="collapse container ">
                                    <div class="row border border-info mt-2 rounded p-3">
                                        @can('crearNuevosMateriales', $poaCuentaCOntable->cuentaContablePoaCuenta->poaContable->poa)
               
                                        <div class="col-sm-5 border border-info" id="tablaMateriales_{{$participante->id}}">
                                            <h5 class="text-center">Agregar Materiales</h5>
                                            <div class="table-responsive" style="font-size: 10px">
                                                <table class="table-bordered border-1 border-primary text-center " id="dataTable-{{ $participante->id }}" class="table table-striped table-bordered " style="width:100%" >
                                                        <thead class="bg-primary">
                                                        <tr>                                                                        
                                                            <th>Nombre</th>
                                                            <th>Costo</th>
                                                            <th>Cantidad</th>           
                                                            <th>Agregar</th>
                                                        </tr>
                                                        </thead>
                                                        
                                                        <tbody id="showdata-{{ $participante->id }}">
                                                        </tbody>
                                                    </table>
                                                </div>
                                        </div>
                                        @endcan
                                        <div class="col-sm-7" id="detalleActa_{{ $participante->id }}">
                                                <input type="hidden" name="" id="gestor-{{$participante->id}}" value="{{ $participante->comunidad->usuario->id }}">                          
                                                <h2 class="text-center"><strong>ACTA ENTREGA RECEPCIÓN</strong></h2>
                                                <p class=" text-justify"><strong>Gestor Actual:</strong> Srx. {{ $participante->comunidad->usuario->name }}</p>
                                              <div id="actaMateriales{{ $participante->id }}">
                                            
                                            </div>
                                                                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                     </div>
                     <input type="hidden" id="rutaccesprimary-{{ $participante->id }}" value="{{ route('listados-material',[$poaCuentaCOntable->id,$participante->id]) }}">
                    <script>
                        var idMaterial='{{ $participante->id }}';
                        $("#question_{{$participante->id}}").on('shown.bs.collapse', function(){
                            materiales({{ $participante->id }});
                            carListado({{ $participante->id }});
                        });                                     
                      
                     </script>
                @endforeach
                </div>
        </div>

    </div>
</div>
@push('linksCabeza')
<link rel="stylesheet" type="text/css" href="{{asset('admin/plus/DataTables/buttons.bootstrap4.min.css')}}">
    
    <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/datatables.js')}}"></script>
<script>
     function materiales(id) {
        $('#dataTable-'+id).DataTable().destroy();
            var id=id;
            var codigoMes='{{ $poaCuentaCOntable->id }}';   
           
            $.blockUI({message:'<h1>Espere por favor.!</h1>'});
            $.post( "{{route('buscarMateriales-material')}}",{idMes:codigoMes,idComunidad:id})
            .done(function( data ) {
                             
                var i;
                var t = $('#dataTable-'+id).DataTable();
                t.clear();
                for(i=0; i<data.length; i++){   
                var counter = 1;
                var cars = [                              
                    data[i].nombre,
                    data[i].precio,
                    '<input type="number" min="0" name="" class="form-control form-control-sm" id="cantidadMaterial-'+data[i].id+'-'+id+'" value="">',
                    
                    '<a href="javascript:;" class="btn btn-primary btn-sm" id="checklist-'+data[i].id+'" onclick="registrarMaterial(this)" data-comunidad="'+id+'" data-id="'+data[i].id+'" data-idmes="'+codigoMes+'"><i class="fa fa-plus"></i></a>',
                    ];
                t.row.add(cars).draw( false );
                }  
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                $.unblockUI();
                console.log('existe un error ')
            }); 

            $('#dataTable-'+id).DataTable({
                paging: true,               
                ordering:  false,
                "lengthMenu": [ 3 ],
                "pageLength": 3,
                language: {
                    "decimal": "",
                    "emptyTable": "No existen materiales disponibles",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
        }
        function carListado(idComunidad) {
            var url=$('#rutaccesprimary-'+idComunidad).val();
            $("#actaMateriales"+idComunidad).load(url, function(responseTxt, statusTxt, xhr){
            
            if(statusTxt == "success"){
                $.unblockUI();
            }              
            if(statusTxt == "error"){
                $.unblockUI();
                notificar('error','NO se pudo cargar actas');
            }            
          });
        } 
                      
    </script>
@endpush

@prepend('linksPie')
<script>
    $('#menuPlanificacion').addClass('active');
</script>
    <script>
        $(document).ready(function(){
          
            $('#nuevoMaterial').hide();
            $('#esconderFormulario').hide();
        })
        function mostrarNuevoMaterial() {
            $('#nuevoMaterial').show();
            $('#mostrarFormulario').hide();
            $('#esconderFormulario').show();
            
        }
        function removerNuevoMaterial() {
            $('#nuevoMaterial').hide();
            $('#mostrarFormulario').show();
            $('#esconderFormulario').hide();
            
        }
        function registrarMaterial(params) {
            var idMaaterial=$(params).data('id');
            var comunidad=$(params).data('comunidad');
            var cantidad=$('#cantidadMaterial-'+idMaaterial+'-'+comunidad).val();
            var idMes=$(params).data('idmes');
            var gestor=$('#gestor-'+comunidad).val();
           
            if($.isNumeric(idMaaterial)&&$.isNumeric(comunidad)&&$.isNumeric(cantidad)&&$.isNumeric(idMes)){
                if(cantidad>0){                    
                    $.blockUI({message:'<h1>Espere por favor.!</h1>'});
                        $.post( "{{route('guardar-acta')}}",{poaMes:idMes,comunidadPoa:comunidad,gestor:gestor,matrial:idMaaterial,cantidad:cantidad})
                        .done(function( data ) {                                    
                            if(data=="ok"){                               
                                notificar("success","Material asignado exitosamente");
                                materiales(comunidad);  
                                carListado(comunidad);
                            }
                            if(data=="error"){
                                notificar("error","No se puede guardar el acta por que esta con datos erroneos");   

                            }
                            if(data=="repetido"){
                                notificar("info","El material seleccionado ya existe en el acta"); 
                            }
                        }).always(function(){
                            $.unblockUI();
                        }).fail(function(){
                            $.unblockUI();
                            console.log('existe un error ')
                        }); 

                }else{
                notificar("default","Verifique  que la cantidad ingresada debe ser mayor de 0");   

                }

            }else{
                notificar("default","Los datos seleccionados son incorrectos verifique la cantidad ingresada debe ser mayor de 0");   
            }
            
        }
                    
    </script>
    
@endprepend
@endsection