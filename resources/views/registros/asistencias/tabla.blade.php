
    <div class="card-header">
        <center>
            <h3>Registro de asistencia a actividades</h3>
        </center>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NOMBRE DEL PROYECTO:</th>
                        <td colspan="5">
                            {{-- {{ $comuPoaPart->poaParticipante->poa->planificacionMOdelo->planificacion->nombre??'' }} --}}
                            {{ $comuPoaPart->poaParticipante->poa->planificacionMOdelo->modeloProgramatico->nombre }} -
                            {{ $comuPoaPart->poaParticipante->poa->planificacionMOdelo->modeloProgramatico->codigo }} 
                            
                        </td>
                    </tr>
                    <tr>
                        <th>
                            FECHA:
                        </th>
                        <td class="bg-success">
                            {{ Carbon\Carbon::now()->toDateString() }}
                        </td>
                        <th>
                            LUGAR/COMUNIDAD:
                        </th>
                        <td>
                            {{ $comuPoaPart->comunidad->nombre??'' }}
                        </td>
                        <th>
                            VILLAGE #:
                        </th>
                        <td>
                            {{ $comuPoaPart->comunidad->nombre??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>NOMBRE DE LA ACTIVIDAD:</th>
                        <td colspan="3">{{ $comuPoaPart->poaParticipante->poa->actividad->nombre??'' }}</td>
                        <th>CÓDIGO POA:</th>
                        <td>
                            {{ $comuPoaPart->poaParticipante->poa->actividad->modeloProgramatico->codigo??'' }}
                            {{ $comuPoaPart->poaParticipante->poa->actividad->codigo??'' }}
                        </td>
                    </tr>

                </thead>
            </table>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        
                    </thead>
                    <tbody>
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
                            <th>
                                Afiliado
                            </th>
                            <th scope="col">
                                No afiliado
                            </th>
                            
                             {{--  tipos de participantes  --}}
                            @if(count($comuPoaPart->poaParticipante->tipoParticipantes)>0)
                            @foreach ($comuPoaPart->poaParticipante->tipoParticipantes as $tph)
                                <th class="bg-secondary">
                                    {{ $tph->nombre }}
                                </th>
                            @endforeach
                            @endif

                            {{--  cuentas contables  --}}
                            @if(count($comuPoaPart->poaParticipante->poa->poaCuentaContable->cuentasContables)>0)
                            @foreach ($comuPoaPart->poaParticipante->poa->poaCuentaContable->cuentasContables as $cch)
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
                    </tbody>
                </table>
        </div>
    </div>