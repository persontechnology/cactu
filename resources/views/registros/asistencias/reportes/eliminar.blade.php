@extends('layouts.app',['title'=>'Listado de asistencias sin participantes'])

@section('breadcrumbs', Breadcrumbs::render('planificacionesEliminarAsis',$planificacion))


@section('content')

<!-- Content area -->
<div class="content">
    <!-- Single line -->
    <div class="card">
        <div class="card-header  bg-transparent header-elements-inline">
            <h6 class="card-title">Listado de Asistencias sin Participantes</h6>
            
            <div class="header-elements">
                <span class="badge bg-blue">{{ $asistencias->total() }} Total sin participantes</span>
            </div>
        </div>      
            <!-- Action toolbar -->
        <section>
            <div id="sticky1" class="navbar navbar-light navbar-expand-lg sticky  shadow-0 py-lg-2">
                <div class="text-center d-lg-none w-100">
                    <button type="button" class="navbar-toggler w-100" data-toggle="collapse" data-target="#inbox-toolbar-toggle-single">
                        <i class="icon-circle-down2"></i>
                    </button>
                </div>
                <div class="navbar-collapse text-center text-lg-left flex-wrap collapse" id="inbox-toolbar-toggle-single">
                    <div class="mt-3 mt-lg-0">
                        <input id="select_all" type="checkbox"  >  
                        <div class="btn-group ml-3 mr-lg-3">                          
                            <button type="button" id="delete_records" class="btn btn-light"><i class="icon-bin"></i> <span class="d-none d-lg-inline-block ml-2" id="select_count">0 seleccionados</span></button>
                            
                        </div>
                    </div>
        
                    <div class="navbar-text ml-lg-auto">
                        <span class="font-weight-semibold">
                            <span id="totalEncabezado" > {{ $asistencias->perPage() }}</span> -{{ $asistencias->total() }}  
                        </span> de 
                        <span class="font-weight-semibold" id="totallista">{{ $asistencias->total() }}
                        </span>
                    </div>                  
                </div>
            </div>
           </section>     
            <!-- /action toolbar -->
       <!-- Table -->
        
        <div class="infinite-scroll">
            <div id="quitarTop" class="table-responsive mt-5">
                <table id="employee_grid"  class=" table table-inbox ">
            
                    <tbody data-link="row" class="rowlink">
                        @php
                            $i=0;
                        @endphp
                        @foreach ($asistencias as $asistencia)
                            @php
                                $i++;
                            @endphp
                            <tr id="{{$asistencia->id}}" style="background-color: #fff" >                                
                                <td >                                    
                                    <input type="checkbox" class="form-check-input-styled emp_checkbox" data-url="{{route('eliminarSinParticipacion')}}" data-emp-id="{{$asistencia->id}}">
                                </td>
                                <td>
                                    {{$asistencia->comunidadPoaParticipante->poaParticipante->poa->actividad->modeloProgramatico->nombre}}
                                    {{$asistencia->comunidadPoaParticipante->poaParticipante->poa->actividad->nombre}}
                                    <span  class="badge bg-indigo-400 mr-2"> {{$asistencia->comunidadPoaParticipante->poaParticipante->poa->actividad->modeloProgramatico->codigo}}-                          
                                    {{$asistencia->comunidadPoaParticipante->poaParticipante->poa->actividad->codigo}}</span>
                                </td>
                                <td>
                                    {{ $asistencia->fecha }}
                                </td>
                                <td>
                                    {{$asistencia->comunidadPoaParticipante->comunidad->nombre}}
                                </td>
                                <td>
                                    {{ $asistencia->responsable->name}}
                                </td>
                               
                            </tr>
                        @endforeach                        
                        </tbody>                        
                    </table>                    
                </div>
                {{ $asistencias->links() }}
            </div>
            <div class="page-load-status text-center">
                <div class="infinite-scroll-request">
                  <img src='{{asset("img/loader.gif")}}' style="width:200px" alt="Loading" />
                 
                </div>
                <p class="infinite-scroll-error infinite-scroll-last text-center mt-4">
                    <span  class="badge bg-danger-400 mr-2"> Son todos los registros </span>
                </p>
              </div>
        </div>
        <!-- /table -->  
    <!-- /single line -->   
</div>
<!-- /content area -->

@push('linksCabeza')
<script type="text/javascript" charset="utf8" src="{{asset('admin/js/logica.js')}}" ></script>
<script type="text/javascript" charset="utf8" src="{{asset('admin/plus/jscroll/jscroll.min.js')}}"></script>
@endpush
@prepend('linksPie')
    <script type="text/javascript">
        $('ul.pagination').hide();
        var $container= $('.infinite-scroll').infiniteScroll({
            path: '.pagination li.active + li a',
            append: 'div.infinite-scroll',
            history: false,
            status: '.page-load-status',
          
         });
         $container.on( 'append.infiniteScroll', function( event, response, path, items ) {
            $('#select_all').prop('checked', false);
            $(".emp_checkbox").prop('checked', false);
            $("#select_count").html("0 Selecionados")
            $('ul.pagination').remove();                   
            $('#sticky1').addClass('sticky');
            $('#totalEncabezado').html($('.table >tbody >tr').length);
            $( items ).tooltip();
          });
       

$('#delete_records').on('click', function(e) {
    var employee = [];
    var urleliminar;
    $(".emp_checkbox:checked").each(function() {
        employee.push($(this).data('emp-id'));
        urleliminar = $(this).data('url');
    });
    if (employee.length > 0) {

        Lobibox.base.OPTIONS.buttons.yes.text = "Borrar";
        Lobibox.base.OPTIONS.buttons.no.text = "Cancelar";
        Lobibox.confirm({
            title: "Confirmación !",
            msg: "Esta seguro que desea eliminar " + employee.length + " asistencia" + (employee.length > 1 ? 's' : '') + "?",
            callback: function($this, type, ev) {
                //Your code goes here
                if (type == "yes") {
                    for (i = 0; i < employee.length; i++) {
                        $.post(urleliminar, { id: employee[i] })
                            .done(function(data) {
                                if (data == "success") {                                    
                                    $('#totalEncabezado').html($('.table >tbody >tr').length);
                                    notificar("info", "Asistencia Eliminada");
                                } else {
                                    notificar("danger", "La Asistencia no puede ser eliminada");
                                }
                            }).always(function(data) {
                            }).fail(function() {
                                notificar("error", "Ocurrio un error");
                            });
                        $('#' + employee[i]).remove();
                        $("#select_count").html("0 Selecionados")
                    }
                } else {
                    console.log('registro no eliminado')
                }
            }
        });

    } else {
        alert('debe selecionar algun dato')
    }
})
    </script>
   
 <style>
    section {
        /* position is static by default */
        margin-left: 50px;
      }
    .sticky {
  
        position: fixed;
        border-color:#03a9f4 ;
        
      }

    input[type=checkbox] {
        position: relative;
          cursor: pointer;
   }
   input[type=checkbox]:before {
        content: "";
        display: block;
        position: absolute;
        width: 16px;
        height: 16px;
        top: 0;
        left: 0;
        border: 2px solid #555555;
        border-radius: 3px;
        background-color: white;
}
   input[type=checkbox]:checked:after {
        content: "";
        display: block;
        width: 5px;
        height: 10px;
        border: solid black;
        border-width: 0 2px 2px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        position: absolute;
        top: 2px;
        left: 6px;
}
 </style>

 

    <script>
        $('#menuPlanificacion').addClass('active');
    </script>

    <style>
        .error { 
            float: none; 
            color: red; 
            padding-left: .5em; 
            vertical-align: middle;
             font-size: 12px;
            }
    </style>

@endprepend
@endsection