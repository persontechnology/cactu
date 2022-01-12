
<div class="card-header">
                
        <table style="border-collapse: collapse; border: none;">
            <td class="noBorder">
                    <img src="{!! public_path('img/logo-cactu.png') !!}" alt="" width="100px;" style="text-align: left;">
            </td>
            <td class="noBorder">
                    <h3 style="text-align: center;">REGISTRO DE ASISTENCIA A ACTIVIDADES</h3>
            </td>
            <td class="noBorder">
                
                <img src="{!! public_path('img/childfund.jpg') !!}" alt="" width="100px;" style="text-align: right;">
            </td>
        </table>
        
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NOMBRE DEL PROYECTO:</th>
                        <td colspan="5">
                            
                            {{ $asis->comunidadPoaParticipante->poaParticipante->poa->planificacionMOdelo->modeloProgramatico->nombre??'' }} -
                        {{ $asis->comunidadPoaParticipante->poaParticipante->poa->planificacionMOdelo->modeloProgramatico->codigo??'' }} 
                        </td>
                    </tr>
                    <tr>
                        <th>
                            FECHA:
                        </th>
                        <td>
                            {{ $asis->fecha }}
                        </td>
                        <th>
                            LUGAR/COMUNIDAD:
                        </th>
                        <td>
                            {{ $asis->comunidadPoaParticipante->comunidad->nombre??'' }}
                        </td>
                        <th>
                            VILLAGE #:
                        </th>
                        <td>
                            {{ $asis->comunidadPoaParticipante->comunidad->nombre??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>NOMBRE DE LA ACTIVIDAD:</th>
                        <td colspan="3">{{ $asis->comunidadPoaParticipante->poaParticipante->poa->actividad->nombre??'' }}</td>
                        <th>CÓDIGO POA:</th>
                        <td>
                            {{ $asis->comunidadPoaParticipante->poaParticipante->poa->actividad->modeloProgramatico->codigo??'' }}
                            {{ $asis->comunidadPoaParticipante->poaParticipante->poa->actividad->codigo??'' }}
                        </td>
                    </tr>
    
                </thead>
            </table>
        </div>
        
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"># de ninio/a</th>
                            <th scope="col">Nombres y apellidos</th>
                            <th scope="col">Edad</th>
                            <th scope="col">
                                Mujer
                            </th>
                            <th scope="col">
                                Hombre
                            </th>
                            <th class="bg-dark">
                                Afiliado
                            </th>
                            <th scope="col" class="bg-dark">
                                No afiliado
                            </th>
                            <th class="bg-indigo">
                                Madre/Padre afiliado
                            </th>
                            <th scope="col" class="bg-indigo">
                                Otros
                            </th>
        
                            {{--  tipos de participantes  --}}
                            @if(count($asis->comunidadPoaParticipante->poaParticipante->tipoParticipantes)>0)
                            @foreach ($asis->comunidadPoaParticipante->poaParticipante->tipoParticipantes as $tph)
                                <th class="bg-secondary">
                                    {{ $tph->nombre }}
                                </th>
                            @endforeach
                            @endif
        
                            {{--  cuentas contables  --}}
                            @if(count($asis->comunidadPoaParticipante->poaParticipante->poa->poaCuentaContable->cuentasContables)>0)
                            @foreach ($asis->comunidadPoaParticipante->poaParticipante->poa->poaCuentaContable->cuentasContables as $cch)
                                <th class="bg-warning">
                                    {{ $cch->nombre }}
                                </th>
                            @endforeach
                            @endif
        
                            <th>
                                Organización,Institución,Club
                            </th>
        
                            <th>
                                Firma
                            </th>
                            @role('Administrador')
                            <th>
                                Imagen
                            </th>
                            @endrole
        
                        </tr>
                    </thead>
                    <tbody>
                        @php($cantidadHombre=0)
                        @php($cantidadMujer=0)
                        
                        @if(count($asis->listado)>0)
                        @php($i=0)
                        @foreach ($asis->listado as $lista)
                            @php($i++)
                        
                                <tr>
                                    <th scope="row">
                                      
                                        {{ $i }}
                                    </th>
                                    <td>{{ $lista->ninio->numeroChild }}</td>
                                    <td>{{ $lista->ninio->nombres }}</td>
                                    <td>{{ $lista->edad }}</td>
                                    <td>
        
                                        {{-- Mujer --}}
                                        @if ($lista->ninio->genero=='Female')
                                            X
                                            @php($cantidadMujer++)
                                        @endif
                                        
                                        
                                    </td>
                                    <td>
                                        {{-- Hombre --}}
                                        @if ($lista->ninio->genero=='Male')
                                            X
                                            @php($cantidadHombre++)
                                        @endif
        
                                    </td>
                                    <td>
                                        {{-- afiliado --}}
                                        {{ $lista->ninio->numeroChild?'X':''}}
                                    </td>
                                    <td>
                                        {{-- no afiliado --}}
                                        {{ $lista->ninio->numeroChild?'':'X'}}
                                    </td>
        
                                    <td>
                                        {{-- Madre/padre afiliado --}}
                                        <div class="form-check">
                                         
                                            {{ $lista->opcion=="MadrePadreAfiliado"?'X':'' }}
                                            
                                        </div>
                                    </td>
                                    <td>
                                        {{-- otros --}}
                                        <div class="form-check">
                                            {{ $lista->opcion=="Otros"?'X':'' }}
                                        </div>
                                    </td>
                                    
                                    {{--  tipo de participantes  --}}
                                    @if(count($asis->comunidadPoaParticipante->poaParticipante->tipoParticipantes)>0)
                                    @foreach ($asis->comunidadPoaParticipante->poaParticipante->tipoParticipantes as $tpc)
                                        <td>
                                            {{ $lista->ninio->tipoParticipante->nombre==$tpc->nombre?'X':'' }}
                                        </td>
                                    @endforeach
                                    @endif
        
                                    {{--  cuentas contables  --}}
                                    @if(count($asis->comunidadPoaParticipante->poaParticipante->poa->poaCuentaContable->cuentasContables)>0)
                                    @foreach ($asis->comunidadPoaParticipante->poaParticipante->poa->poaCuentaContable->cuentasContables as $ccc)
                                        <td class="fila-{{ $asis->id }}{{ $ccc->id }}">
                                            @php($existe=0)
                                            @foreach ($lista->cuentaContablePoaCuenta as $l_ccc)
                                                @if($l_ccc->listaCuentaContable->cuentaContablePoaCuenta_id==$ccc->cuentaContablePoaCuenta->id)
                                                @php($existe=1)
                                                @endif
                                            @endforeach
    
                                            {{ $existe==1?'X':'' }}
                                        </td>
                                    @endforeach
                                    @endif
                                    <td>
                                        {{ $lista->lugar }}
                                    </td>
                                    <td>
                                        {{ $lista->ninio->id }}
                                    </td>
                                    <td>
                                        
                                        <div class="d-flex align-items-center">
                                         @role('Administrador')
                                            @if($lista->fotoQr)
                                                <div class="mr-2">
                                                    <div class="card-img-actions">
                                                        <a href="{{ $lista->fotoQr }}" data-fancybox="gallery" data-caption="{{($lista->ninio->nombres??$lista->ninio->usuario->name)??'' }} {{$lista->created_at.' '. \Carbon\Carbon::parse($lista->created_at)->diffForHumans()}}">
                                                            <img class="rounded-circle" width="52" height="52" src="{{ $lista->fotoQr }}" alt="">
                                                            <span class="card-img-actions-overlay card-img">
                                                                <i class="icon-plus3"></i>
                                                            </span>
                                                        </a>
                                                    </div>										
                                                </div>
                                            @endif
                                        @endrole
                                        </div>
                                        
                                    </td>
                                    
                                </tr>
        
                        @endforeach
                        <tr>
                            <td colspan="4">Total</td>
                            <td>
                                {{-- cantidad mujer --}}
                                {{ $cantidadMujer }}
                            </td>
                            <td>
                                {{-- total hombre --}}
                                {{ $cantidadHombre }}
                            </td>
                            <td colspan="4"></td>
                            
                            
                            {{--  tipo de participantes  --}}
                            @if(count($asis->comunidadPoaParticipante->poaParticipante->tipoParticipantes)>0)
                            <td colspan="{{ count($asis->comunidadPoaParticipante->poaParticipante->tipoParticipantes) }}"></td>
                            @endif
        
                            {{--  cuentas contables  --}}
                            @if(count($asis->comunidadPoaParticipante->poaParticipante->poa->poaCuentaContable->cuentasContables)>0)
                            @foreach ($asis->comunidadPoaParticipante->poaParticipante->poa->poaCuentaContable->cuentasContables as $ccc_f)
                                <th>
                                   {{ $ccc_f->total($asis->listado->pluck('id'),$ccc_f->cuentaContablePoaCuenta->id) }}
                                </th>
                            @endforeach
                            @endif
                            <td colspan="3">
                                
                            </td>
                        </tr>
                        @endif
        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                <i>Guia de desglose:</i><br>
        
                                <small>
                                    <strong>VOLUNTARIO COMUNITARIO:</strong>Madres guía, madres talleristas, jóvenes líderes, miembros de junta o comité <br>
                                    <strong>PERSONAL DE SOCIO LOCAL:</strong>Técnicas de etapa de vida, movilizadores comunitarios, movilizador de federación, facilitadores de sesión <br>
                                    <strong>SOCIEDAD CIVIL:</strong>Representes de organizaciones sociales, líderes comunitarios, miembros de la comunidad general
                                </small>
                            </td>
                            
                            <td colspan="10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <strong>Responsable:</strong>
                                                {{ $asis->responsable->name }}
                                            </td>
                                            <td>
                                                <strong>Firma:</strong>
                                                {{ $asis->responsable->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                Cantidad y detalle de material entregado:
                                            </th>
                                        </tr>
                                        <tr class="mt-0">
                                            <td colspan="2">
                                                {{ $asis->detalle }} 
                                            </td>
                                        </tr>
                                    </table>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        