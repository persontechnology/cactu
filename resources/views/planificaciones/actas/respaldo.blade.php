@extends('layouts.app',['title'=>'Administracion de actas'])

@section('breadcrumbs', Breadcrumbs::render('misActas',$acta))

@section('content')
@if ($acta->listadoMateriales  )
	<!-- Invoice template -->
    <div class="card">
       <div class="card-body">
            <div class="row">
                <div class="mb-4 text-center">
                    <img src="{{ asset('/img/cactu-logo.jpeg') }}" class="mb-3 mt-2" alt="" width="30%">
                    <p><strong>ACTA ENTREGA RECEPCIÓN</strong></p>
                </div>
            </div>
            <p class="text-right "><strong><span class="border-1">Prov: {{ $acta->comunidadActa->comunidad->canton->provincia->nombre }} </span></strong></p>
           <p class="text-justify"> En la cuidad de Ambato con la fecha {{ $acta->created_at }} el \  la Srx <strong>{{ $presidente? $presidente->name:'XXXXXXXXXX' }} </strong> 
                PRESIDENTX DE LA CORPORACIÓN DE ASOCIACIONES DE COTOPAXI Y TUNGURAHUA, y el \ la Srx. <strong>{{ $acta->estado=="Aceptada"?$acta->gestor->name:Auth::user()->name }}, </strong>  {{ $acta->comunidadActa->comunidad->nombre }} realiza la presente 
                acta entrega de materiales para uso de la actividad <strong>{{ $acta->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->nombre}}{{$acta->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->modeloProgramatico->codigo.''.$acta->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->codigo}}</strong>
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
                        @foreach ($acta->listadoMateriales as $listado)
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
                    <h6 class="mb-3">Aceptada por</h6>
                    <div class=" text-center">
                        @if ( $acta->estado=="Aceptada")
                            @if ($acta->gestor->firma)
                                    
                            <img src="{{ url($acta->gestor->firma) }}" alt=""  width="154px"  height="124px">
                                
                            @else
                                No pose una firma digital
                             @endif 
                        @else              
                            
                        <p class="text-danger">   Debe aceptar para autorizar su firma </p>                              
                            	
                        @endif
                    </div>

                    <ul class="list-unstyled text-center">
                        <li><strong> Recibí Conforme: </strong></li>
                        <li>Srx. {{ $acta->estado=="Aceptada"? $acta->gestor->name:Auth::user()->name }}</li>
                        <li>C.C: {{ $acta->estado=="Aceptada"? $acta->gestor->identificacion:Auth::user()->identificacion }}</li>
                        <li><strong> GESTOR DE {{ $acta->comunidadActa->comunidad->nombre }} </strong></li>
                        <li></li>
                    </ul>
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
                    @if ($acta->estado=="Entregada")
                   
                            <div class="text-right mt-3">
                                <button onclick="aceptarActa();" class="btn btn-primary btn-labeled btn-labeled-left"><b><i class="icon-paperplane"></i></b> Aceptar y Finalizar Acta</button>
                            </div>
                        
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!-- /invoice template -->
    @else
    <div class="alert alert-danger" role="alert">
        No existe acta
    </div>
 @endif
@push('linksCabeza')
@endpush

@prepend('linksPie')

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
        function aceptarActa(e) {
            

            swal({
                title: "Aceptar términos y condiciones ?",
                text: "<p class='text-justify'><strong><span class='text-dark'>En mi calidad de personal contratado de la Corporación de Asociaciones"+
                    "Comunitarias de Cotopaxi y Tungurahua (CACTU), libre y voluntariamente, acepto y reconozco que he sido informado sobre"+
                    " los derechos y obligaciones del CAPITULO TERCERO del REGLAMENTO INTERNO DE TRABAJO y la POLÍTICA DE MANEJO DE MEDIOS ELECTRÓNICOS."+
                    "</span></strong> <a href='{{ route('mi-termino') }}' target='_blank' class='text-black'>Leer más</a></p>",
                html:true,
                               
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Si, Acepto!",
               
                closeOnConfirm: false,
                closeOnCancel: true,
                imageUrl: "{{ asset('/img/cactu-logo.jpeg') }}",
                
              },
              function(isConfirm) {
                if (isConfirm) {
                  swal("Confirmación!", "He leído y acepto los términos y condiciones de uso.", "success");
                  var acta="{{ $acta->id }}";
                  $.blockUI({message:'<h1>Espere por favor.!</h1>'});
                  $.post( "{{ route('cambiar-estado-acta-aceptada') }}", { acta:acta })
                  .done(function( data ) {
                    
                      location.replace("{{ route('mi-actas',$acta->id) }}");
                  }).always(function(){
                      $.unblockUI();
                  }).fail(function(){
                      notificar("error","Ocurrio un error");
                  });
                } else {
                  swal("Cancelar", "He leído y no acepto los términos y condiciones de uso :)", "error");
                }
              });
            
          };
      
    </script>
@endprepend
@endsection