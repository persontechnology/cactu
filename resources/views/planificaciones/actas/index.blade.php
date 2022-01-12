@extends('layouts.app',['title'=>'Actas POA'])
@section('breadcrumbs', Breadcrumbs::render('planificacionesActas',$planificacion))
@section('content')

              
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
        <div class="card-body d-md-flex align-items-md-center justify-content-md-between flex-md-wrap">                
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <div id="tickets-status"></div>
                <div class="ml-3">
                    <h5 class="font-weight-semibold mb-0">{{ $poas->count() }} </h5>
                    <span class="badge badge-mark border-success mr-1"></span> 
                    <span class="text-muted">Total actividades</span>
                </div>
            </div>

            <div class="d-flex align-items-center mb-3 mb-md-0">
                <a href="#" class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon">
                    <i class="icon-coins"></i>
                </a>
                <div class="ml-3">
                    <h5 class="font-weight-semibold mb-0">{{ number_format($cuentacontableMes->sum('valor'),2) }}</h5>
                    <span class="text-muted">total valor</span>
                </div>
            </div>
                
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <a href="#" class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon">
                    <i class="icon-calendar3 "></i>
                </a>
                <div class="ml-3">
                    <h5 class="font-weight-semibold mb-0">{{ \Carbon\Carbon::now() }}</h5>
                    <span class="text-muted">Fecha</span>
                </div>
            </div>
        </div>

        @if ($poas->count()>0)         
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
                            <div class="media-title font-weight-semibold">{{ $poa->actividad->nombre}} {{$poa->actividad->modeloProgramatico->codigo.''.$poa->actividad->codigo}}</div>
                        
                            <div class="text-muted font-size-sm">
                                <i class="icon-folder-check font-size-sm mr-1"></i> {{$poa->numeroSesiones}} Sesiones
                            </div> 
                            <div class="text-muted font-size-sm">
                                <i class="icon-file-text2 font-size-sm mr-1"></i> <b> Modulo: </b> {{$poa->modulo->codigo.'-'.$poa->modulo->nombre}} 
                            </div> 
                        </a>    
                    </div>   
                 
                </li>            
                <div id="concepto" class="conceptoconcepto_{{$poa->id}}">
                <li >
                    <div class="collapse" id="actividad_{{$poa->id}}">                                             
                                                                                        
                        @if ($poa->poaCuentaContable)
                            @if (count($poa->poaCuentaContable->CuentaContablePoaCuentas)>0)
                                <ul class="nav nav-sidebar" data-nav-type="collapsible"> 
                              
                                @php($sumaTotal=0)
                            
                                @php($sumaTotalEjecutadoTotal=0)
                            
                                @foreach($poa->poaCuentaContable->CuentaContablePoaCuentas as $cuenta)
                                    @if ($cuenta->cuentaContable->nombre=="Materiales")                 
                               
                                        <li class=" text-center nav-item-header bg-dark">
                                            <div class="text-uppercase font-size-sm line-height-sm">{{  $cuenta->cuentaContable->nombre}}</div>
                                        </li>
                     
                                        <div class="table-responsive">
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
                                                            @if ($mb->valor>0)
                                                                <a href="{{ route('acta-material', $mb->id) }}" class="btn btn-primary text-withe rounded-circle"><i class="icon-calculator3" aria-hidden="true"></i></button>
                                                            @endif
                                                                
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
                                @endif                          
                            @endforeach
                            <p ><b>T. Panificado $ {{ number_format ($sumaTotal,2)}} </b></p>
                            <p ><b>T. Ejecutado $ {{number_format($sumaTotalEjecutadoTotal,2)}}</b></p>
                            </ul>
                                                            
                        @endif
                    @endif 
                        
                    </div>
                      
                </li>
            </div>
            @endforeach
        </ul>
             
        @else
            <div class="alert alert-danger" role="alert">
                No existen actividades con cuanta contable en esta planificación
            </div>
        @endif

    </div>
</div>
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
@endsection
