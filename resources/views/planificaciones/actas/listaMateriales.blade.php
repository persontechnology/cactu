<div class="card-body">
  <a href="{{ route('exportar-pdf',$consultaActa->id ) }}" target="_blanck"  class="btn btn-default">Imprimir</a>
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