@if ($consultaActa)
@if ($consultaActa->estado!="Aceptada")
<p><strong>Estado:</strong> {{$consultaActa->estado}}</p>
<div class="table-responsive" style="font-size: 11px">
                                            
    <table class="table-bordered " style=" width:100%" >
        <thead>
            <tr class="bg-primary text center border-1 text-center">
                <th>#</th>
                @if ($consultaActa->estado!="Aceptada")
                <th scope="col">Quitar</th> 
                    
                @endif
                <th scope="col">Material</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio U.</th> 
                <th>Iva</th>               
                <th scope="col">Precio T.</th> 

            </tr>
        </thead>
        <tbody>
            @php
                $i=0;
                $coniva=0;
                $sinva=0;
            @endphp
            @foreach ($consultaActa->listadoMateriales as $listado)
                @php
                 $i++;
                @endphp
                <tr>
                    <td>{{$i}}</td>
                    @if ($consultaActa->estado!="Aceptada")
                    <td class="text-center"><button class="btn btn-danger btn-sm" onclick="eliminar(this);" data-id="{{ $listado->id }}" data-idcomunidad="{{ $consultaActa->comunidadActa->id}}"><i class="icon-bin"></i></button></td>        
                    @endif
                    <td>{{$listado->material->nombre}} </td>
                    <td class="text-center">{{$listado->cantidad}}</td>
                    <td class="text-center">{{$listado->precio}} </td>
                    <td>{{$listado->iva}}%</td>
                    <td class="text-center">{{number_format($listado->cantidad*$listado->precio,2)}}</td>
                </tr>
                @if ($listado->iva==0)
                @php $sinva=$sinva+$listado->cantidad*$listado->precio; @endphp
                @else
                @php
                    $coniva=$coniva+$listado->cantidad*$listado->precio
                @endphp
                @endif
            @endforeach
            

        </tbody>         
        </table>
        <div class="d-md-flex flex-md-wrap">
                <div class="wmin-md-400 ml-auto">
                    
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right">${{ number_format($coniva,2) }}</td>
                                </tr>
                                <tr>
                                    <th><span class="font-weight-normal">(0%)</span> IVA</th>
                                <td class="text-right">${{ number_format($sinva,2)}}</td>
                                </tr>
                                <tr>
                                    <th><span class="font-weight-normal">(12%)</span> IVA </th>
                                    <td class="text-right">${{ number_format($coniva*0.12,2) }}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td class="text-right text-primary"><h5 class="font-weight-semibold">${{ number_format($coniva+$sinva+($coniva*0.12),2) }}</h5></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @can('cambioEstadoActa', $consultaActa)
                        <div class="text-right mt-3">
                            <button type="button" onclick="cambioEstadoActa(this);" data-id="{{ $consultaActa->id }}" data-idcomunidad="{{ $consultaActa->comunidadActa->id}}" class="btn btn-primary btn-labeled btn-labeled-left"><b><i class="icon-paperplane"></i></b> Entregar</button>
                        </div>
                        
                    @endcan
                </div>
            </div>
   
    </div>
    @else
    @if ($consultaActa->listadoMateriales  )
    
    <script>
    $('#tablaMateriales_{{ $consultaActa->comunidadActa->id }}').hide();
    $('#detalleActa_{{ $consultaActa->comunidadActa->id }}').addClass('col-sm-12').removeClass('col-sm-7');
     </script>
	<!-- Invoice template -->
    <div class="card-body">
        <a href="{{ route('exportar-pdf',$consultaActa->id ) }}"   class="btn btn-default border-1"><i class="icon-file-download2"></i> Descargar</a>
        <div class="row">
            <div class="mb-4 text-center">
                <img src="{{ asset('/img/cactu-logo.jpeg') }}" class="mb-3 mt-2" alt="" width="30%">
                <p><strong>ACTA ENTREGA RECEPCIÓN</strong></p>
            </div>
        </div>
        <p class="text-right "><strong><span class="border-1">Prov: {{ $consultaActa->comunidadActa->comunidad->canton->provincia->nombre }} </span></strong></p>
        <p style="text-align: justify"> En la cuidad de Ambato con la fecha {{ $consultaActa->created_at }} el / la Srx <strong>{{ $presidente? $presidente->name:'XXXXXXXXXX' }} </strong> 
            PRESIDENTX DE LA CORPORACIÓN DE ASOCIACIONES DE COTOPAXI Y TUNGURAHUA, y el / la Srx. <strong>{{ $consultaActa->estado=="Aceptada"?$consultaActa->gestor->name:Auth::user()->name }}, </strong>  {{ $consultaActa->comunidadActa->comunidad->nombre }} realiza la presente 
            acta entrega de materiales para uso de la actividad <strong>{{ $consultaActa->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->nombre}}{{$consultaActa->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->modeloProgramatico->codigo.''.$consultaActa->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->codigo}}</strong>
    </p>
        <p>Para mayor información se detalla a continuación</p>
      </div>
      <div class="container">   
        <div class="table-responsive ">
            <table class="table-bordered " style="width: 100%">
                <thead>
                    <tr class="bg-primary">
                        <th class="text-center">Item</th>                            
                        <th scope="col">Material</th>
                        <th class="text-center" scope="col">Cantidad</th>
                        <th class="text-center" scope="col">Precio U.</th>                
                        <th class="text-center" scope="col">Precio T.</th> 
                    </tr>
                </thead>
                @php
                    $i=0;
                    $coniva=0;
                    $sinva=0;
                @endphp
                <tbody>
                    @foreach ($consultaActa->listadoMateriales as $listado)
                        @php
                        $i++;
                        @endphp
                   
                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td>
                            <h6 class="mb-0">{{$listado->material->nombre}}</h6>
                            
                        </td>
                        <td class="text-center">{{$listado->cantidad}}</td>
                        <td class="text-center">{{$listado->precio}}</td>
                        <td ><span class="font-weight-semibold">{{number_format($listado->cantidad*$listado->precio,2)}}</span></td>
                    </tr>
                    @if ($listado->iva==0)
                         @php $sinva=$sinva+$listado->cantidad*$listado->precio; @endphp
                    @else
                        @php
                            $coniva=$coniva+$listado->cantidad*$listado->precio
                        @endphp
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>   
      
      
      <div class="card-body">
        <div class="d-md-flex flex-md-wrap">
            <div class="pt-2 mb-3">
                
            </div>
      
            <div class="mb-3 wmin-md-400 ml-auto">
                
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td class="text-right">${{ number_format($coniva,2) }}</td>
                            </tr>
                            <tr>
                                <th><span class="font-weight-normal">(0%)</span> IVA</th>
                            <td class="text-right">${{ number_format($sinva,2)}}</td>
                            </tr>
                            <tr>
                                <th><span class="font-weight-normal">(12%)</span> IVA </th>
                                <td class="text-right">${{ number_format($coniva*0.12,2) }}</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td class="text-right text-primary"><h5 class="font-weight-semibold">${{ number_format($coniva+$sinva+($coniva*0.12),2) }}</h5></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($consultaActa->estado=="Entregada")
                <form action="{{ route('cambiar-estado-acta-aceptada') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{$consultaActa->id}}" name="acta">
                        
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left"><b><i class="icon-paperplane"></i></b> Aceptar y Finalizar Acta</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
      
        @if ( $consultaActa->estado=="Aceptada")
            <div class="row">
                <div class="col-sm-4">
                    
                        <div class=" text-center">
                            
                            @if ($aseguramiento)
                                    
                            <img src="{{ url($aseguramiento->firma) }}" alt=""  width="154px"  height="124px">
                                
                            @else
                                XXXXXXXXXX
                            @endif 
                           
                        </div>
      
                        <ul class="list-unstyled text-center">
                            <li><strong> Recepción de Logística: </strong></li>
                            <li>Srx. {{ $aseguramiento? $aseguramiento->name:'XXXXXXXXXX' }}</li>
                            <li>C.C: {{$aseguramiento? $aseguramiento->identificacion:'XXXXXXXXXX'}}</li>
                            <li><strong> ASEGURAMIENTO DE CACTU </strong></li>
                            <li></li>
                        </ul>
                </div>
                <div class="col-sm-4">
      
                    <div class=" text-center">
                            
                        @if ($presidente->firma)
                                
                        <img src="{{ url($presidente->firma) }}" alt=""  width="154px"  height="124px">
                            
                        @else
                            No pose una firma digital
                        @endif 
                   
                </div>
      
                <ul class="list-unstyled text-center">
                    <li><strong> Entregué conforme : </strong></li>
                    <li>Srx. {{ $presidente? $presidente->name:'XXXXXXXXXX' }}</li>
                    <li>C.C:{{ $presidente? $presidente->identificacion:'XXXXXXXXXX' }}</li>
                    <li><strong> PRESIDENTX-CACTU </strong> </li>
                    <li></li>
                </ul>
                </div>
                <div class="col-sm-4">
                  
                    <div class=" text-center">
                        @if ( $consultaActa->estado=="Aceptada")
                            @if ($consultaActa->gestor->firma)
                                    
                            <img src="{{ url($consultaActa->gestor->firma) }}" alt=""  width="154px"  height="124px">
                                
                            @else
                                No pose una firma digital
                             @endif 
                        @else              
                            
                        <p class="text-danger">   Debe aceptar para autorizar su firma </p>                              
                                
                        @endif
                    </div>
      
                    <ul class="list-unstyled text-center">
                        <li><strong> Recibí Conforme: </strong></li>
                        <li>Srx. {{ $consultaActa->estado=="Aceptada"? $consultaActa->gestor->name:Auth::user()->name }}</li>
                        <li>C.C: {{ $consultaActa->estado=="Aceptada"? $consultaActa->gestor->identificacion:Auth::user()->identificacion }}</li>
                        <li><strong> GESTOR DE {{ $consultaActa->comunidadActa->comunidad->nombre }} </strong></li>
                        <li></li>
                    </ul>
                </div>
      
            </div>
        @endif
       
      </div>

    <!-- /invoice template -->
    @else
    <div class="alert alert-danger" role="alert">
        No existe acta
    </div>
    @endif
    @endif
@endif
<script>
 function eliminar(arg){
            
            var id=$(arg).data('id');
            var idCOmunidad=$(arg).data('idcomunidad');
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
                $.post( "{{ route('eliminar-material-acta') }}", { actaMes: id })
                .done(function( data ) {
                    if(data.success){
                       
                        materiales(idCOmunidad);  
                                carListado(idCOmunidad);
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

        function cambioEstadoActa(arg){
            
            var id=$(arg).data('id');
            var idCOmunidad=$(arg).data('idcomunidad');
            swal({
                title: "¿Estás seguro?",
                text: "Que desea entregar los materiales a Gestor.!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                cancelButtonClass: "btn-danger",
                confirmButtonText: "¡Sí, Entregar!",
                cancelButtonText:"Cancelar",
                closeOnConfirm: false
            },
            function(){
                swal.close();
                $.blockUI({message:'<h1>Espere por favor se esta enviando una notificación al gestor.!</h1>'});
                $.post( "{{ route('cambiar-estado-acta') }}", { acta: id })
                .done(function( data ) {
                    if(data.success){  
                        carListado(idCOmunidad);
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