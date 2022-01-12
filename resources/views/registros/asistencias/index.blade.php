@extends('layouts.app',['title'=>'Listado de actividades'])

@section('breadcrumbs', Breadcrumbs::render('asistencia'))


@section('content')

@if ($plan)
<div class="card">
    <div class="card-header">
        Listado de actividades del  <strong>{{ date('M') }}</strong> fecha: <strong>{{ date('d-m-Y') }}</strong>
        <br>
        {{ Carbon\Carbon::now()->toDateString() }}
    </div>
    <div class="card-body">
        @if ($poas)
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm" id="dataTable">
                <thead>
                    <tr>
                    <th scope="col">Actividad</th>
                    <th scope="col">Módulo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col"># sesiones</th>
                    <th scope="col">Comunidades</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($poas as $poa)
                        <tr>
                            <th scope="row">
                                {{ $poa->actividad->nombre }} <br>
                                <span class="text-success">{{ $poa->actividad->modeloProgramatico->codigo.''.$poa->actividad->codigo}}</span>
                            </th>
                            <td>{{ $poa->modulo->nombre }}-{{ $poa->modulo->codigo }}</td>
                            <td>{{ $poa->descripcion }}</td>
                            <td>{{ $poa->numeroSesiones }}</td>
                            <td>
                                @if (count($poa->comunidadesParticipantes)>0)
                                
                                    <table>
                                        @foreach ($poa->comunidadesParticipantes as $com)
                                        @can('accederAsistencias', $com)
                                            <tr>
                                                    
                                                <th scope="row">{{ $com->comunidad->nombre }}</th>
                                                <td>
                                                    
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                    
                                                        <a href="{{ route('asistencias',$com->id) }}" class="btn btn-primary btn-sm">
                                                            Ingresar
                                                        </a>
                                                        
                                                        @if ($poa->verificarSiExisteActa($poa->id,$com->id))
                                                        @php
                                                            $id=$poa->verificarSiExisteActa($poa->id,$com->id)->id;
                                                        @endphp
                                                        <a href="{{ route('mi-actas',$id) }}" class="btn btn-{{ $poa->verificarSiExisteActa($poa->id,$com->id)->estado=="Entregada"?'warning':'success' }} ">
                                                         <i class="icon-{{ $poa->verificarSiExisteActa($poa->id,$com->id)->estado=="Entregada"?'spam':'file-check' }}"></i>   Acta  
                                                        </a>
                                                        @endif
                                                    
                                                    </div>
                                                    
                                                </td>
                                            </tr>   
                                        @endcan 
                                        @endforeach
                                    </table>
                                    
                                @else
                                <div class="alert alert-primary" role="alert">
                                    <strong>No existe comunidades asignadas</strong>
                                </div>
                                @endif
                            </td>
                        </tr>    
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        @else
            <div class="alert alert-primary" role="alert">
                <strong>No existe actvidades</strong>
            </div>
        @endif
    </div>
    
</div>

@else
<div class="alert alert-info" role="alert">
    <strong>No existe una planificación en proceso!</strong>
</div>

@endif


@push('linksCabeza')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

@endpush

@prepend('linksPie')
    <script>
        $('#menuRegistroAsistencia').addClass('active');
        $('#dataTable').DataTable({
            paging: false,               
            ordering:  false,
            
            language: {
                "decimal": "",
                "emptyTable": "No existen materiales disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
    </script>
    
@endprepend

@endsection
