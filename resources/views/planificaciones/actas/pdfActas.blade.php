<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
  
       
       
    <div class="mb-4 text-center" style="text-align: center">
        <img src="{!! public_path('/img/cactu-logo.jpeg') !!}" class="mb-3 mt-2" alt="" width="30%">
        <p ><strong>ACTA ENTREGA RECEPCIÓN</strong></p>
    </div>
   
    <p style="text-align:right "><strong><span style="border:1ch">Prov: {{ $consultaActa->comunidadActa->comunidad->canton->provincia->nombre }} </span></strong></p>
    <p style="text-align: justify"> En la cuidad de Ambato con la fecha {{ $consultaActa->created_at }} el / la Srx <strong>{{ $presidente? $presidente->name:'XXXXXXXXXX' }} </strong> 
            PRESIDENTX DE LA CORPORACIÓN DE ASOCIACIONES DE COTOPAXI Y TUNGURAHUA, y el / la Srx. <strong>{{ $consultaActa->estado=="Aceptada"?$consultaActa->gestor->name:Auth::user()->name }}, </strong>  {{ $consultaActa->comunidadActa->comunidad->nombre }} realiza la presente 
            acta entrega de materiales para uso de la actividad <strong>{{ $consultaActa->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->nombre}}{{$consultaActa->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->modeloProgramatico->codigo.''.$consultaActa->poaCuentaContableMes->cuentaContablePoaCuenta->poaContable->poa->actividad->codigo}}</strong>
    </p>
    <p>Para mayor información se detalla a continuación</p>
          
           
        <table class="table-bordered " style="width: 100%">
            <thead>
                <tr style="background-color: #2196f3;color: white">
                    <th style="text-align: center">Item</th>                            
                    <th scope="col">Descripción</th>
                    <th style="text-align: center" scope="col">Cantidad</th>
                    <th style="text-align: center" scope="col">Precio U.</th>                
                    <th style="text-align: center" scope="col">Precio T.</th> 
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
                    <td style="text-align: center">{{$i}}</td>
                    <td>
                        {{$listado->material->nombre}}
                        
                    </td>
                    <td style="text-align: center">{{$listado->cantidad}}</td>
                    <td style="text-align: center">{{$listado->precio}}</td>
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
      <br>
        <table style="width: 26%; " align="right">
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
                    <td >${{ number_format($coniva+$sinva+($coniva*0.12),2) }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>Para constancia y en señal de aceptación, las partes firman un original y dos copias del mismo valor y contenido. </p>
        @if ( $consultaActa->estado=="Aceptada")
        <table id="firmas" style="border: none">
            <tr>
                <th style="border: none">
                    @if ($aseguramiento)
                                
                    <img src="{{ public_path($aseguramiento->firma) }}" alt=""  width="154px"  height="124px">
                        
                    @else
                        XXXXXXXXXX
                    @endif                
                

                
                    <p><strong> Recepción de Logística: </strong><br>
                    Srx. {{ $aseguramiento? $aseguramiento->name:'XXXXXXXXXX' }}<br>
                    C.C: {{$aseguramiento? $aseguramiento->identificacion:'XXXXXXXXXX'}}<br>
                    <strong> ASEGURAMIENTO DE CACTU </strong></p>
                    
                
                </th>
                <th style="border: none">
                    @if ($presidente->firma)
                            
                    <img src="{{ public_path($presidente->firma) }}" alt=""  width="154px"  height="124px">
                        
                    @else
                        No pose una firma digital
                    @endif 
               
            </div>
  
            
                <p><strong> Entregué conforme : </strong><br>
                Srx. {{ $presidente? $presidente->name:'XXXXXXXXXX' }}<br>
                C.C:{{ $presidente? $presidente->identificacion:'XXXXXXXXXX' }}<br>
                <strong> PRESIDENTX-CACTU </strong> </p>
               
            
                </th>
                <th style="border: none">
                    @if ( $consultaActa->estado=="Aceptada")
                        @if ($consultaActa->gestor->firma)
                                
                        <img src="{{ public_path($consultaActa->gestor->firma) }}" alt=""  width="154px"  height="124px">
                            
                        @else
                            No pose una firma digital
                         @endif 
                    @else              
                        
                    <p class="text-danger">   Debe aceptar para autorizar su firma </p>                              
                            
                    @endif
                
  
                
                    <p><strong> Recibí Conforme: </strong><br>
                    Srx. {{ $consultaActa->estado=="Aceptada"? $consultaActa->gestor->name:Auth::user()->name }}<br>
                    C.C: {{ $consultaActa->estado=="Aceptada"? $consultaActa->gestor->identificacion:Auth::user()->identificacion }}<br>
                    <strong> GESTOR DE {{ $consultaActa->comunidadActa->comunidad->nombre }} </strong></p>
                   
              

                </th>    
            </tr>
        </table>
        
    @endif
         
    
  <style>
    #firmas {
        table-layout: fixed;
        width: 100%;
        border-collapse: collapse;
       
      }
     
  </style>

</body>
</html>