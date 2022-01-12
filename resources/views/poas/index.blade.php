@extends('layouts.app',['title'=>'Actividades POA'])

@section('breadcrumbs', Breadcrumbs::render('armarPoa',$planificacionModelo))

@section('barraLateral')
    <div class="breadcrumb justify-content-center">

        <a href="{{ route('nuevoPoaItem',$planificacionModelo->id) }}" class="breadcrumb-elements-item">
            <i class="fas fa-plus"></i>
            Nueva actividad
        </a>

    </div>
@endsection

@section('content')


@if(count($poas)>0)
              
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Lista de actividades</h5>
        <div class="header-elements">
            <div class="list-icons">
               {{--  <a class="list-icons-item" data-action="collapse"></a>
                 <a class="list-icons-item" data-action="reload"></a>                          --}}
                <a class="list-icons-item" data-action="fullscreen"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="input-group mb-3">
            <div class="form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control form-control-lg" placeholder="Buscar Actividad">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-search4 text-muted"></i>
                </div>
            </div>                              
        </div>

        <ul class="media-list actividades ">
            @foreach ($poas as $poa)

            <li class="media" id="respuesta" >
                <div class="mr-3">
                    <a href="#">
                        <img src="{{ asset('img/cactu.png') }}" class="rounded-circle" width="40" height="40" alt="">
                    </a>
                </div>

                <div class="media-body">
                    <a href="#" data-id="{{$poa->id}}" class="text-dark" onclick="abrirli(this);" data-toggle="collapse" data-target="#actividad_{{$poa->id}}">
                        <div class="media-title font-weight-semibold">{{ $poa->id }} {{ $poa->actividad->nombre}} {{$poa->actividad->modeloProgramatico->codigo.''.$poa->actividad->codigo}}</div>
                  
                        <div class="text-muted font-size-sm">
                            <i class="icon-folder-check font-size-sm mr-1"></i> {{$poa->numeroSesiones}} Sesiones
                        </div> 
                        <div class="text-muted font-size-sm">
                            <i class="icon-file-text2 font-size-sm mr-1"></i> <b> Modulo: </b> {{$poa->modulo->codigo.'-'.$poa->modulo->nombre}} 
                        </div> 
                    </a>    
                </div>

                    <div class="align-self-center ml-3">
                        <div class="list-icons">
                            <div class="list-icons-item dropdown">
                                <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu9"></i></a>

                                  <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('poaActividad',$poa->id) }}" class="dropdown-item">
                                <i class="icon-comment-discussion "></i> Número actividad
                            </a>
                            <a href="{{ route('poaParticipantes',$poa->id) }}" class="dropdown-item">
                                <i class="icon-users "></i> Número participante
                            </a>
                            <a href="{{route('poaCuentaContable',$poa->id)}}" class="dropdown-item">
                                <i class="icon-portfolio "></i> Cuenta contable
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('editarPoa',$poa->id) }}" class="dropdown-item">
                                <i class="icon-pencil5 text-info"></i> Editar
                            </a>
                            <a href="#"  onclick="eliminar(this);" data-id="{{ $poa->id }}" class="dropdown-item">
                                <i class="icon-trash text-danger"></i> Eliminar
                            </a>
                        </div>
                            </div>
                        </div>
                    </div>
                </li>
     
            <div id="concepto" class="conceptoconcepto_{{$poa->id}}">
            <li >
                <div class="collapse" id="actividad_{{$poa->id}}">
                    <div class="card-body bg-light border-top border-bottom">
                        <div class="container justify-content-center">
                            <div class="choice unset  overflow-auto">
                                <div class="card-body ">
                                    <h4 class="card-title text-center"><a> <span class="badge bg-success-800">Número Actividad</span></a></h4>
                                    
                                    <div class="table-responsive">                                      
                                        <table class="table table-bordered text-center" >
                                            <thead>                                                        
                                                @if ($poa->poaActividad)
                                                 <tr>
                                                    <th class="bg-success-800">Nombre</th>
                                                @if (count($poa->poaActividad->meses)>0)
                                               

                                                @foreach ($poa->poaActividad->meses as $mh)
                                                    <th class="bg-success-800" >{{ $mh->mes}} Pla.</th>
                                                    <th class="bg-success-600" >{{ $mh->mes }} Eje.</th>
                                            
                                                @endforeach
                                                <th class="bg-dark">Total Pla.</th>
                                                <th class="bg-info">Total Eje.</th>
                                                </tr>
                                                <tr>
                                                <th>{{$poa->poaActividad->tipoActividad->nombre}}
                                                </th>
                                                @php($cont=0)
                                                @foreach ($poa->poaActividad->meses as $mvalor)
                                                    <th >{{ $mvalor->poaActividadMes->valor }} </th>
                                                    <th class="bg-{{ date('m')==$mvalor->id ?'dark':''}} text-center">
                                                        @if($mvalor->poaActividadMes->valor>0)
                                                        <a href="#" class="btn btn-outline bg-{{ date('m')==$mvalor->id ?'white':'dark'}} btn-icon text-{{ date('m')==$mvalor->id ?'white':'dark'}}  border-{{ date('m')==$mvalor->id ?'white':'dark'}} border-2 rounded-round legitRipple">
                                                            <i class="icon-plus-circle2"></i>
                                                        </a>
                                                        @else
                                                        <i class="icon-cancel-circle2 bg-dark"></i>
                                                        @endif
                                                    </th>
                                                    @php($cont=$mvalor->poaActividadMes->valor+$cont)                                                     
                                                @endforeach
                                                <th class="bg-dark">{{$cont}}</th>
                                                <th class="bg-info">0</th>
                                                </tr>
                                                
                                                @endif
                                                @endif                                   
                                                
                                            </thead>
                                        </table>                 
                                    </div>
                                
                                </div>

                            </div>
                            <div class="choice unset  overflow-auto">
                                <div class="card-body">
                                <!-- Title -->
                                    <h4 class="card-title text-center"><a><span class="badge bg-orange-800">Número participante</span></a></h4>
                                <!-- Text -->
                                 @if($poa->poaParticipante)
                                <div class="table-responsive">      
                                 <table class="table table-bordered ">
                                        <thead>                                                        
                                            @if ($poa->poaParticipante)
                                           
                                            <tr id="">                                                                                   
                                                <th class="bg-orange-800" >Tipos de participante</th>
                                                <th class="bg-orange-800">Comunidades_Participantes</th>
                                                <th class="bg-orange-800" >Descripcón</th>
                                                @if (count($poa->poaParticipante->meses)>0)
                                                @foreach ($poa->poaParticipante->meses as $mh)
                                                <th class="bg-orange-800">{{ $mh->mes }} Pla.</th>
                                                <th class="bg-orange-600">{{ $mh->mes }} Eje.</th>
                                                @endforeach
                                                @endif
                                                <th class="bg-dark">Total Pla.</th>
                                                <th class="bg-info">Total Eje.</th>
                                            </tr>
                                            <tr>
                                                <th >
                                                @foreach($poa->poaParticipante->tipoParticipantes as $tipos)
                                                    <ul>
                                                     <li>{{$tipos->nombre}} 111</li>    
                                                    </ul>                                   
                                                @endforeach    
                                            </th>
                                            <th >
                                                @foreach($poa->poaParticipante->comunidadPoaParticipantes as $comunidades)
                                                <div class="list-icons">
                                                    <a href="#coordinadore_{{$comunidades->id}}" data-toggle="collapse" >{{$comunidades->comunidad->nombre}} 
                                                        <span class="badge badge-{{$comunidades->asistencias->count()>0?'primary':'warning'}} badge-pill">{{$comunidades->asistencias->count()}}
                                                        </span>
                                                    </a>
                                                    @if($comunidades->asistencias->count()>0)
                                                        <a href="{{route('reportesVista-poa',$comunidades->id)}}" class=" legitRipple text-dark" data-popup="tooltip" title="" data-container="body" data-original-title="Ver Más">
                                                            <i class="icon-eye-plus "></i>
                                                        </a>
                                                    @endif
                                                </div>
                                                
                                                    <div class="collapse" id="coordinadore_{{$comunidades->id}}">
                                                        
                                                      @if($comunidades->coordinador_id)
                                                        Coor. {{$comunidades->comunidad->usuarioGestorCoordinador($comunidades->coordinador_id)->name}}
                                                        @else
                                                        S/C
                                                        @endif
                                                        <br>
                                                        @if($comunidades->gestor_id)
                                                        Gestor. {{$comunidades->comunidad->usuarioGestorCoordinador($comunidades->gestor_id)->name}}
                                                        @else
                                                        S/G
                                                        @endif

                                               
                                                    </div>
                                                    <br>
                                                                                        
                                                @endforeach  
                                            </th>
                                            <th>
                                            {{$poa->poaParticipante->descripcion}}        
                                            </th>
                                            @if (count($poa->poaParticipante->poaParticipanteMeses)>0)
                                            @php($resutPar=0)
                                                @foreach ($poa->poaParticipante->poaParticipanteMeses as $mh)

                                                    <th class="text-center"> {{$mh->valor}}</th>
                                                    <th class="text-center">{{ $mh->poaParticipante->resultadoParticipantes($mh->poaParticipante_id,$mh->mes->mes)}} </th>
                                                     @php($resutPar=$resutPar + $mh->poaParticipante->resultadoParticipantes($mh->poaParticipante_id,$mh->mes->mes))
                                            @endforeach
                                             <th>
                                                {{ $poa->poaParticipante->meses->sum('poaParticipanteMes.valor')}}

                                            </th>
                                            <th>
                                                {{$resutPar}}
                                            </th>
                                             @endif
                                            </tr>                                         
                                           
                                            @endif                                   
                                            
                                        </thead>
                                    </table>                 
                                    </div>
                                    
                                @endif
                                </div>    
                                
                            </div>
                            <div class="choice unset  overflow-auto ">
                                <div class="card-body">                             
                                                                                    
                                    @if ($poa->poaCuentaContable)
                                    @if (count($poa->poaCuentaContable->CuentaContablePoaCuentas)>0)
                                     <ul class="nav nav-sidebar" data-nav-type="collapsible"> 
                                        <li class=" text-center nav-item-header bg-primary">
                                            <div class="text-uppercase font-size-sm line-height-sm">Cuentas Contables</div>
                                        </li>
                                    @php($sumaTotal=0)
                                 
                                     @php($sumaTotalEjecutadoTotal=0)
                                   
                                    @foreach($poa->poaCuentaContable->CuentaContablePoaCuentas as $cuenta)
                                    <li class="nav-item nav-item-submenu">
                                        <a href="#" class="nav-link text-dark"><i class="icon-calculator3"></i>{{$cuenta->cuentaContable->nombre}}</a>

                                        <ul class="nav nav-group-sub">
                                            <div class="table-responsive2">
                                              <table class="table table-bordered text-center">
                                                    <thead>
                                                        <tr>
                                                            
                                                            @foreach ($cuenta->mesesCuenta as $mh)
                                                            <th class="bg-primary-600">{{ $mh->mes->mes }} Pla.</th>
                                                            <th class="bg-primary-400" >{{ $mh->mes->mes }} Eje.</th>
                                                            @endforeach
                                                            <th>Total Pla.</th>
                                                            <th>Total Eje.</th>                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr> 
                                                            @php($sumaTotalEjecutado1=0)  
                                                            {{-- valorniniosplanificado  --}}
                                                            @php($valorPlanificado=0)
                                                            {{-- valortotalejecutado --}}
                                                            @php($valorEjecutado=0)  
                                                              
                                                            @foreach ($cuenta->mesesCuenta as $mb)
                                                            @php($valorPlanificado=$mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->valorParticiPoaMes($mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->id,$mb->mes->mes))
                                                            @php($valorEjecutado=$mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->resultadoParticipantesCuenta($mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->id,$mb->mes->mes,$cuenta->id))  
                                                            @php($sumaTotalEjecutado1=$mb->sumatoriaFinalTotal($mb->valor,$valorPlanificado,$valorEjecutado )+$sumaTotalEjecutado1)
                                                            <th >
                                                                {{ $mb->valor }}
                                                                 
                                                            </th>
                                                            <th >
                                                               
                                                                <span class="badge badge-flat border-dark text-dark-600"> T.N  {{
                                                                    $mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->resultadoParticipantesCuenta($mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->id,$mb->mes->mes,$cuenta->id) 
                                                                }}</span> 
                                                                <span class="badge badge-flat border-primary text-primary-600"> 
                                                                    V.U  $ <b>{{number_format($mb->sumatoriaFinalUnitaria($mb->valor,$mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->valorParticiPoaMes($mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->id,$mb->mes->mes)),2) }}</b> 
                                                                </span>
                                                               @if($mb->valor < $mb->sumatoriaFinalTotal($mb->valor,$valorPlanificado,$valorEjecutado ))
                                                               
                                                                    <span class="badge badge-flat border-warning text-warning-600">V.T $ 
                                                                        {{
                                                                            number_format($mb->sumatoriaFinalTotal($mb->valor,$valorPlanificado,$valorEjecutado ),2)
                                                                        }}
                                                                    </span>
                                                                    <span class="badge badge-flat border-danger text-danger-600">V.C $ 
                                                                        {{
                                                                            number_format($mb->valor-$mb->sumatoriaFinalTotal($mb->valor,$mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->valorParticiPoaMes($mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->id,$mb->mes->mes),$mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->resultadoParticipantesCuenta($mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->id,$mb->mes->mes,$cuenta->id) ),2)
                                                                        }}
                                                                    </span>
                                                                @else                                                                
                                                                    <span class="badge badge-flat border-success text-success-600">V.T
                                                                        {{
                                                                            number_format($mb->sumatoriaFinalTotal($mb->valor,$mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->valorParticiPoaMes($mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->id,$mb->mes->mes),$mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->resultadoParticipantesCuenta($mb->cuentaContablePoaCuenta->poaContable->poa->poaParticipante->id,$mb->mes->mes,$cuenta->id) ),2)
                                                                        }}
                                                                    </span>
                                                                @endif                                                                    
                                                                
                                                            </th>
                                                            @endforeach
                                                            <th>
                                                                {{ 
                                                                    number_format($cuenta->mesesCuenta->sum('valor'),2)
                                                                }}
                                                                @php($sumaTotal=$cuenta->mesesCuenta->sum('valor')+$sumaTotal)
                                                            </th>
                                                            <th>
                                                                {{number_format($sumaTotalEjecutado1,2)}}
                                                                @php($sumaTotalEjecutadoTotal=$sumaTotalEjecutado1+$sumaTotalEjecutadoTotal)
                                                            </th>
                                                      </tr>                                  
                                                    </tbody>
                                              </table> 
                                          </div>
                                        </ul>
                                    </li>
                                    @endforeach
                                    <p ><b>T. Panificado $ {{number_format($sumaTotal,2)}} </b></p>
                                    <p ><b>T. Ejecutado $ {{number_format($sumaTotalEjecutadoTotal,2)}}</b></p>
                                    </ul>
                                                                    
                                @endif
                            @endif 
                                
                            </div>
                        </div>                                   
                        </div>
                    </div>
                </div>
            </li>
            </div>
            @endforeach
        </ul>
    </div>
    
</div>
@else
    <div class="alert alert-primary alert-styled-left alert-dismissible">
        <span class="font-weight-semibold">No existe actividades</span>
    </div>
@endif

@push('linksCabeza')

@endpush

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
    <style type="text/css">
        .container{
            display: flex;
            width: 100%;
            padding: 0;
        }
        .choice{
            
            height: 220px;
            box-sizing: border-box;
            padding: 0;
            overflow: hidden;
            float: left;
            align-items: center;
            transition: width 0.7s;
            border-radius:3px;
            
        }
        .expand{
            width :100%;   
            
        }
        .unset{
            width :16%;  
            
        }
        .small{
            width :6%;

            background-color: #324148!important;
        }
        .small>div{
            opacity: 0;
        }

        .unset > div > p{
            opacity: 0;
            
        }

        .expand > div {
            transition-delay:  200ms;
            opacity: 1;
            
        }


#miTablaPersonalizada th{
  width: 130px;
  overflow: auto;
  border: 1px solid;
}
    </style>
    <script type="text/javascript">
        $(".choice").on("click", function(){
           
            $(".choice").removeClass("expand unset ");
            $(".choice").addClass("small");
            $(this).removeClass("small");
            $(this).addClass("expand");
        });

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
            $.post( "{{ route('eliminar-poa') }}", { idPoa: id })
               .done(function( data ) {
                if(data.success){                    
                    notificar("info",data.success);
                    window.location.replace("{{route('armarPoa',$planificacionModelo->id)}}");
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
@endprepend

@endsection
