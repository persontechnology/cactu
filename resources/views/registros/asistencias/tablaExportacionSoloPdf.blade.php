
    <table class="table table-bordered table-hover">
                <thead >
                    <tr>
                        <th colspan="5">NOMBRE DEL PROYECTO:</th>
                        <td colspan="11">
                            
                            {{ $asis->comunidadPoaParticipante->poaParticipante->poa->planificacionMOdelo->modeloProgramatico->nombre??'' }} -
                            {{ $asis->comunidadPoaParticipante->poaParticipante->poa->planificacionMOdelo->modeloProgramatico->codigo??'' }} 
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
                            FECHA:
                        </th>
                        <td colspan="1">
                            {{ $asis->fecha }}
                        </td>
                        <th colspan="4">
                            LUGAR/COMUNIDAD:
                        </th>
                        <td colspan="4">
                            {{ $asis->comunidadPoaParticipante->comunidad->nombre??'' }}
                        </td>
                        <th colspan="2">
                            VILLAGE #:
                        </th>
                        <td colspan="3">
                            {{ $asis->comunidadPoaParticipante->comunidad->nombre??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3">NOMBRE DE LA ACTIVIDAD:</th>
                        <td colspan="9">{{ $asis->comunidadPoaParticipante->poaParticipante->poa->actividad->nombre??'' }}</td>
                        <th colspan="2">CÓDIGO POA:</th>
                        <td colspan="2">
                            {{ $asis->comunidadPoaParticipante->poaParticipante->poa->actividad->modeloProgramatico->codigo??'' }}
                            {{ $asis->comunidadPoaParticipante->poaParticipante->poa->actividad->codigo??'' }}
                        </td>
                    </tr>
                    <tr class="filas">
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
                        
                    </tr>
                </thead>
                <tbody>
                    @php($cantidadHombre=0)
                    @php($cantidadMujer=0)
                    
                    @if(count($asis->listado)>0)
                    @php($i=0)
                    @foreach ($asis->listado as $lista)
                        @php($i++)
                        <div class="page">
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
                           
                                
                            </tr>
    
                    @endforeach
                    <tr>
                        <th colspan="4">Total</th>
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
                            <td>
                               {{ $ccc_f->total($asis->listado->pluck('id'),$ccc_f->cuentaContablePoaCuenta->id) }}
                            </td>
                        @endforeach
                        @endif
                        <td colspan="3">
                            
                        </td>
                    </tr>
                </div>
                    @endif
    
                </tbody>
                
            </table>
  