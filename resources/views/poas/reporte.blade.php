@extends('layouts.app',['title'=>'Reporte'])
@section('breadcrumbs', Breadcrumbs::render('reportePoa',$comunidad))


@section('content')
              
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Gestor <span class="badge badge-flat ">{{$comunidad->comunidad->usuario->name}}</span>
            <span class="badge badge-flat ">{{$comunidad->comunidad->nombre}} </span>
            <span class="badge badge-flat ">{{$comunidad->poaParticipante->poa->actividad->nombre}}</span>
        </h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="fullscreen"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="input-group mb-3">
            <div class="form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control form-control-lg" placeholder="Buscar Registro">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-search4 text-muted"></i>
                </div>
            </div>                              
        </div>
        <ul class="media-list actividades">
            @foreach ($comunidad->asistencias as $asistencia)

            <li class="media" id="respuesta" >
                <div class="mr-3">
                    <a href="#">
                        <img src="{{ asset('img/cactu.png') }}" class="rounded-circle" width="40" height="40" alt="">
                    </a>
                </div>

                <div class="media-body">
                    <a href="#" data-id="{{$asistencia->id}}" class="text-dark" onclick="abrirli(this);" data-toggle="collapse" data-target="#actividad_{{$asistencia->id}}">
                        <div class="media-title font-weight-semibold">{{ $asistencia->fecha}} </div>
                  
                        <div class="text-muted font-size-sm">
                            <i class="icon-calendar font-size-sm mr-1"></i> Creado {{\Carbon\Carbon::parse($asistencia->created_at)->diffForHumans()  }}
                        </div>
                        <div class="text-muted font-size-sm">
                            <i class="icon-users4 font-size-sm mr-1"></i> <b> Total niños: </b> {{$asistencia->listado->count()}} 
                        </div>                       
                    </a>    
                </div>
            </li>           
     
            <div id="concepto" class="conceptoconcepto_{{$asistencia->id}}">
            <li >
                <div class="collapse" id="actividad_{{$asistencia->id}}">
                        
                        <div style="overflow-x:auto;">
                                <div class="btn-group float-right">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Exportar
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('exportarPdfAsistencia',$asistencia->id) }}" target="_blanck"><i class="far fa-file-pdf"></i> PDF</a>
                                            <a class="dropdown-item" href="{{ route('exportarExcel',$asistencia->id) }}"><i class="far fa-file-excel"></i> EXCEL</a>
                                        </div>
                                </div>
                            @include('registros.asistencias.reporteListado',['asis'=>$asistencia])
                        </div>
                    
                </div>
            </li>
            </div>
            @endforeach
        </ul>

    </div>
</div>


@prepend('linksPie')
    <script>
        $('#menuPlanificacion').addClass('active');
    </script>
    <script>

    //buscar en la lista 
    $('input[type="text"]').keyup(function(ev){   
    var texto = $(this).val();
    filtro(texto);
    });

    function filtro(texto) {
        var lista1 = $(".actividades > #concepto").hide()
        var lista = $(".actividades > #respuesta").hide()
             .filter(function(){
                 var item = $(this).text();
                 var padrao = new RegExp(texto, "i");
              
                 return padrao.test(item);
             }).closest(".actividades > #respuesta ",".actividades > #concepto").show();
    }
    function abrirli(argument) {
         var id=$(argument).data('id');
         $('.conceptoconcepto_'+id).show();

    }
    </script>
 
    <script type="text/javascript">
        $(".choice").on("click", function(){
           
            $(".choice").removeClass("expand unset ");
            $(".choice").addClass("small");
            $(this).removeClass("small");
            $(this).addClass("expand");
        });


@endprepend

@endsection