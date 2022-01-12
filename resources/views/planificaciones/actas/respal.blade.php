@extends('layouts.app',['title'=>'Administracion de actas'])

@section('content')
<div class="" style="font-size: 10px">
<table class="table-bordered border-1 border-primary text-center " id="dataTable1" class="table table-striped table-bordered" style="width:100%" >
        <thead class="bg-primary">
        <tr>
                       
            <th>Nombre</th>
            <th>Costo</th>
            <th>Cantidad</th>           
            <th>Agregar</th>
        </tr>
        </thead>
        
        <tbody id="showdata">
        </tbody>
    </table>
</div>
@push('linksCabeza')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
@endpush

@prepend('linksPie')

    <script>
        $(document).ready(function(){
            $('#dataTable1').DataTable({
                paging: true,
               
                ordering:  false,
                "lengthMenu": [ 2 ],
                "pageLength": 2,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
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
        function materal() {            
                              
            $.blockUI({message:'<h1>Espere por favor.!</h1>'});
            $.post( "{{route('buscarMateriales-material')}}")
            .done(function( data ) {
            
                var html = '';
                    var i;
                    var t = $('#dataTable1').DataTable();
                    t.clear();
                    for(i=0; i<data.length; i++){   
                    var counter = 1;
                    var cars = [
                                
                                
                                data[i].nombre,
                                data[i].precio,
                                '<input type="number" min="0" name="" class="form-control form-control-sm" id="cantidadMaterial-'+data[i].id+'" value="">',
                                
                                '<a href="javascript:;" class="btn btn-info btn-sm" id="checklist-'+data[i].id+'" onclick="Registra_persona(this)"  data-persona="'+data[i].id+'"><i class="fa fa-plus"></i></a>',
                                ];
                    t.row.add(cars).draw( false );
                    }
                

            
            }).always(function(){
                $.unblockUI();
            }).fail(function(){
                $.unblockUI();
                console.log('existe un error ')
            }); 
        }
        materal();
      function Registra_persona(params) {
         var id=$(params).data('persona');
         var cantidad=$('#cantidadMaterial-'+id).val();
         console.log(id+' '+ cantidad);
      }
    </script>
    <style>
        th { font-size: 11px; }
td { font-size: 10px; }
        </style>
@endprepend
@endsection