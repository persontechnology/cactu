
<div class="table-responsive">
    <table class="table table-bordered">            
        <tr>
            <th scope="row">Child Number</th>
            <td colspan="3">
                {{$ninio->numeroChild}}
            </td>                
        </tr>
        <tr>
            <th scope="row">Nombres</th>
            <td id="namessChil">{{ ($ninio->nombres??$ninio->usuario->name)??'' }}</td>
            <th scope="row">Numero de caso del participante</th>
            <td>{{ $ninio->casoParticipante }}</td>
        </tr>
        <tr>
            <th scope="row">Celular</th>
            <td >{{ $ninio->celular?$ninio->celular:'No Aplica' }}</td>
            <th scope="row">Email</th>
            <td>{{ $ninio->email?$ninio->email:'No Aplica' }}</td>
        </tr>
            <tr>
            <th scope="row">Comunidad</th>
            <td>
                {{ $ninio->comunidad->canton->provincia->nombre .'- '. $ninio->comunidad->canton->nombre .' -'. $ninio->comunidad->nombre }}
            </td>
            <th scope="row">Tipo de participante</th>
            <td>
                {{ $ninio->tipoParticipante->nombre }}
            </td>
        </tr>
        <tr>
            <th scope="row">Género</th>
            <td>                    
                {{$ninio->genero=='Male'?'Masculino':'Femenino'}}
            </td>
            <th scope="row">Fecha Nacimiento</th>
            <td>
                {{ $ninio->fechaNacimiento }}
                
            </td>
        </tr>
        <tr>
            <th scope="row">Edad</th>
            <td>                    
                {{Carbon\Carbon::parse($ninio->fechaNacimiento)->age}} Años
            </td>
            <th scope="row">Estado de Patrocinio</th>
            <td>
                {{ $ninio->estadoPatrocinio }}
                
            </td>
        </tr>
        @if($user_id="")
        <tr>
            <th scope="row">Creado el</th>
            <td>
                {{ $ninio->created_at }} 
                <small>{{ $ninio->created_at->diffForHumans() }}</small>
            </td>
            <th scope="row">Actualizado el</th>
            <td>
                {{ $ninio->updated_at }} 
                <small>{{ $ninio->updated_at->diffForHumans() }}</small>
            </td>
            </tr>
            @endif
        <tr>
            <th scope="row">Creado por</th>
            <td>
                @if($ninio->creadoPor)
                    {{ $ninio->creadoPor($ninio->creadoPor)->email }}
                @else
                --
                @endif

            </td>
            <th scope="row">Actualizado por</th>
            <td>
                @if($ninio->actualizadoPor)
                    {{ $ninio->actualizadoPor($ninio->actualizadoPor)->email }}
                @else
                    --
                @endif
            </td>
        </tr>         
    </table>

    <table class="table table-bordered">            
        <tr>                    
            <td colspan="4" class="text-center" >
                <b>Familiares</b>
            </td>                
        </tr>
        <tr>
            <th scope="row">Papá</th>
            <td>{{ isset($ninio->familia->papa) ? $ninio->familia->papa : 'S/R' }}</td>
            <th scope="row">Mamá</th>
            <td>{{ isset($ninio->familia->mama) ? $ninio->familia->mama : 'S/R' }}</td>
        </tr>
            {{-- <tr>
            <th scope="row">Abuelo</th>
            <td>
                {{ isset($ninio->familia->abuelo) ? $ninio->familia->abuelo : 'S/R' }}
            </td>
            <th scope="row">Abuela</th>
            <td>
                {{ isset($ninio->familia->abuela) ? $ninio->familia->abuela : 'S/R' }}
            </td>
        </tr> --}}
        {{-- <tr>
            <th scope="row">Hermano 1</th>
            <td>
                {{ isset($ninio->familia->hermano1) ? $ninio->familia->hermano1 : 'S/R' }}
            </td>
            <th scope="row">Hermano 2</th>
            <td>
                {{ isset($ninio->familia->hermano2) ? $ninio->familia->hermano2 : 'S/R' }}
            </td>
        </tr> --}}
        
        {{-- <tr>
            <th scope="row">Hermano 3</th>
            <td>
                {{ isset($ninio->familia->hermano3) ? $ninio->familia->hermano3 : 'S/R' }}
            </td>
            <th scope="row">Hermano 4</th>
            <td>
                {{ isset($ninio->familia->hermano4) ? $ninio->familia->hermano4 : 'S/R' }}
            </td>
        </tr> --}}
        {{-- <tr>
            <th scope="row">Hermano 5</th>
            <td>
                {{ isset($ninio->familia->hermano5) ? $ninio->familia->hermano5 : 'S/R' }}
            </td>
            <th scope="row">Hermano 6</th>
            <td>
                {{ isset($ninio->familia->hermano6) ? $ninio->familia->hermano6 : 'S/R' }}
            </td>
        </tr> --}}
        {{-- <tr>
            <th scope="row">Hermano 6</th>
            <td>
                {{ isset($ninio->familia->hermano6) ? $ninio->familia->hermano6 : 'S/R' }}
            </td>
            <th scope="row">Hermano 7</th>
            <td>
                {{ isset($ninio->familia->hermano7) ? $ninio->familia->hermano7 : 'S/R' }}
            </td>
        </tr> --}}
        {{-- <tr>
            <th scope="row">Hermano 8</th>
            <td>
                {{ isset($ninio->familia->hermano8) ? $ninio->familia->hermano8 : 'S/R' }}
            </td>
            <th scope="row">Maestr@ </th>
            <td>
                {{ isset($ninio->familia->maestro) ? $ninio->familia->maestro : 'S/R' }}
            </td>
        </tr> --}}
        {{-- <tr>
            <th scope="row">Ti@</th>
            <td>                    
                {{ isset($ninio->familia->tio) ? $ninio->familia->tio : 'S/R' }}
            </td>

            <th scope="row">Sobrin@/Prim@</th>
            <td>
                {{ isset($ninio->familia->sobrino) ? $ninio->familia->sobrino : 'S/N' }}
                
            </td>
            
        </tr> --}}
        <tr>
            {{-- <th scope="row">Cuñad@</th> --}}
            {{-- <td>                    
                {{ isset($ninio->familia->cunado) ? $ninio->familia->cunado : 'S/R' }}
            </td> --}}
            <th scope="row">Representante</th>
            <td>
                {{ isset($ninio->familia->otro1) ? $ninio->familia->otro1 : 'S/R' }}
                
            </td>
            
            <th scope="row">Número Celular</th>
            <td>
                {{ isset($ninio->familia->otro2) ? $ninio->familia->otro2 : 'S/R' }}
                
            </td>
        </tr>
        <tr>
            <th scope="row">Email Representante</th>
            <td>
                {{ isset($ninio->familia->otro3) ? $ninio->familia->otro3 : 'S/R' }}
                
            </td>
            
        </tr>
                
    </table>
</div>   
