<h1>{{$asistencias->count()}}</h1>
<h1>{{$fechaHoy}}</h1>

<table id="employee_grid"  class="dataTable table table-bordered table-condensed table-hover table-striped bootgrid-table">
{{ $asistencias->links() }}
<div class="row">
  <div class="col-md-2 well">
  <span class="rows_selected" id="select_count">0 Selected</span>
  <a type="button" id="delete_records" class="btn btn-primary pull-right">Delete</a>
  </div>
</div>  
<thead class="thead-light">
      <tr>
        <td class="text-center">Todos<input type="checkbox"  id="select_all"></td>
          <th>Comunidad</th>
          <th>Responsable</th>
          <th>Modelo Programatico</th>
          <th>Actividad</th>
          <th>Codigo</th>
          <th>Fecha</th>

      </tr>
  </thead>
  <tbody>
      @php
          $i=0;
      @endphp
      @foreach ($asistencias as $asistencia)
        @php
            $i++;
        @endphp
          <tr id="{{$asistencia->id}}">
              <td class="text-center bg-info"><input type="checkbox" class="emp_checkbox" data-emp-id="{{$asistencia->id}}" ></td>
              <td>{{$asistencia->comunidadPoaParticipante->comunidad->nombre}}</td>
              <td>{{ $asistencia->responsable->name}}</td>
              <td>{{$asistencia->comunidadPoaParticipante->poaParticipante->poa->actividad->modeloProgramatico->nombre}}</td>
              <td>{{$asistencia->comunidadPoaParticipante->poaParticipante->poa->actividad->nombre}}</td>
              <td>
                {{$asistencia->comunidadPoaParticipante->poaParticipante->poa->actividad->modeloProgramatico->codigo}}-                          
                {{$asistencia->comunidadPoaParticipante->poaParticipante->poa->actividad->codigo}}
            </td>
                <td>
                {{ $asistencia->fecha }}
                </td>
          </tr>
      @endforeach
      
  </tbody>
  
</table> 
