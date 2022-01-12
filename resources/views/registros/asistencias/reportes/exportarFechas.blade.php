@extends('layouts.app',['title'=>'Listado de asistencias por fechas'])

@section('breadcrumbs', Breadcrumbs::render('planificacionesExportar',$planificacion))


@section('content')


<div class="card" id="contenedorSe"> 
    <div class="card-header">
        <h5>Buscar todas las asistencias por fechas </h5>
        <form id="form-asistencia"  action="javascript:void(0);" method="POST" role="form"> 
        <div class="row">
            <div class="col-sm-5">
                <input type="hidden" value="{{Crypt::encryptString($planificacion->id)}}" id="getIp">
                <div class="input-group input-group-sm   ">
                    <div class="input-group-prepend bg-p">                        
                      <span class="input-group-text bg-primary-700 " id="inputGroup-sizing-sm"> Desde </span>
                    </div>
                    <input type="date" id="desde" value="{{$planificacion->desde}}" min="{{$planificacion->desde}}" max="{{$planificacion->hasta}}" name="desde"  class="form-control " placeholder="Fecha Inicio"  aria-describedby="basic-addon2" required>
                    <div class="input-group-append"> 
                        <span class="input-group-text"><i class="icon-calendar ml-1" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="input-group input-group-sm  ">
                    <div class="input-group-prepend">                        
                      <span class="input-group-text bg-pink-700" id="inputGroup-sizing-sm"> Hasta </span>
                    </div>
                    <input type="date" id="hasta" name="hasta" class="form-control"  min="{{$planificacion->desde}}" max="{{$planificacion->hasta}}" placeholder="Fecha Fina"  aria-describedby="basic-addon2" required>
                    <div class="input-group-append"> 
                        <span class="input-group-text"><i class="icon-calendar52  ml-1" aria-hidden="true"></i></span>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-2">
            <button id="btn-preguntas" type="submit" onclick="verificarInformacionCliente(this);"  data-url="{{route('listadoExportarExcelFechas')}}" class="btn bg-dark btn-block myb">
                <i class="icon-search4 font-size-base mr-2"></i>
                Buscar
            </button>
            </div>                   
        </form>

        </div>
        <div class="card-body">
            <div class="card" id="continerlist">
                <div class="container" >   
                    <div class="table-responsive mt-2" >
                        <table id="dataTable1" class="dataTable p-2 table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>                                    
                                    <th>Número Child</th>
                                    <th>Nombre</th>
                                    <th>Fecha </th>
                                </tr>
                            </thead>
                            <tbody id="listadoParticipantes">
            
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>                
</div>

    

@push('linksCabeza')
  
    <script src="{{asset('admin/js/validate.js')}}"></script>
    <script src="{{asset('admin/plus/pickadate/picker.js')}}"></script>
    <script src="{{asset('admin/js/buscar.js')}}"></script>
    <link rel="stylesheet" href="{{asset('admin/css/loader.css')}}">  
    <link rel="stylesheet" type="text/css" href="{{asset('admin/plus/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css')}}">
    
    <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/datatables.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/extensions/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/extensions/buttons.flash.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/extensions/jszip.min.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/extensions/vfs_fonts.js')}}"></script>    
    <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/extensions/buttons.html5.min.js')}}"></script>
    
   
@endpush

@prepend('linksPie')

    <script>
        $('#menuPlanificacion').addClass('active');
        
    </script>

    <style>
        .error {
            color:red;  z-index:0;  display:block; text-align: left; }
            .myb{
                border-radius: 20px; 
                padding-left: 22px; 
                padding-right: 22px; 
                font-weight: 500;
            }
    </style>
@endprepend
@endsection