@extends('layouts.app',['title'=>'Información de participante'])
@section('breadcrumbs', Breadcrumbs::render('niniosInformacion',$ninio))

@section('barraLateral')

    <div class="breadcrumb justify-content-center">
        <div class="breadcrumb-elements-item dropdown p-0">
            <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-users"></i>
                Más opciones
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('ninioInformacionPdf',$ninio->id) }}" target="_blanck" class="dropdown-item"><i class="fas fa-file-pdf"></i> Descargar PDF</a>
                <a href="{{route('ninioInformacionImprimir',$ninio->id)}}" class="dropdown-item"><i class="fas fa-print"></i> Imprimir</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="card">
  <div class="card-header">
      <h4 class="card-title">
      Informacion	del participante
      </h4>
  </div>
  <div class="card-body">
    <div class="card-group-control card-group-control-right" id="accordion-control-right">
      <div class="card" id="cardBuscar">
        <div class="card-header bg-dark ">
          <h6 class="card-title ">
            <a data-toggle="collapse" class="text-white" href="#accordion-control-right-group1">Asistencias recientes</a>
            @if ($contador>3) <button class="btn btn-info" id="seachNinio" data-url="{{route('consultar-asistencias-ninio') }}" onclick="buscarNino(this)" >  Ver Más <i class="fa fa-plus " aria-hidden="true"></i></button>  @endif
          </h6>
      </div>

        {{--  <div class="card-header header-elements-inline bg-dark">
          <p class="card-text">
          Asistencias recientes  
        </p>
          <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                
              </div>
            </div>
        </div>  --}}
        <div id="accordion-control-right-group1" class="collapse show" data-parent="#accordion-control-right">
          <div class="card-body">       
            @if ($asistencias->count()>0)
            <input type="hidden" value="{{Crypt::encryptString($ninio->id)}}" id="getIp">               
              <div id="cargaInicial">          
                <div class="table-responsive">            
                  <table id="table-as" class="table-bordered " width="100%">
                    <thead>
                      <tr>
                        <th>Planificación</th>
                        <th>Fecha</th>
                        <th>Actividad</th>
                        <th>Comunidad</th>
                      </tr>
                    </thead>
                    <tbody id="listadoAsistencias">
                      @foreach ($asistencias as $asistencia)
                      <tr>
                        <td>
                          {{ $asistencia->asistencia ->comunidadPoaParticipante->poaParticipante->poa->planificacionModelo->planificacion->nombre}}
                        </td>
                        <td class="bg-dark" >
                            {{ $asistencia->asistencia->fecha }}
                        </td>
                        <td>
                          {{ $asistencia->asistencia->comunidadPoaParticipante->poaParticipante->poa->actividad->modeloProgramatico->codigo??'' }}
                          {{ $asistencia->asistencia->comunidadPoaParticipante->poaParticipante->poa->actividad->codigo??'' }}
                        </td>                  
                        <td>
                            {{ $asistencia->asistencia->comunidadPoaParticipante->comunidad->nombre??'' }}
                        </td>
                      </tr>                  
                      @endforeach
                    </tbody>
                  </table> 

                </div>
              </div>
            @else
                <div class="alert alert-info" role="alert">
                  No existe asistencias registradas
                </div>
            @endif
          </div>
        </div>
      </div>
    </div>  
@include('ninios.datos',['ninio'=>$ninio])
</div>
<div class="card-footer">        
    <h3 class="text-center text-dark">Dirección Latitud: {{$ninio->latitud!= ""? $ninio->latitud:'S/R'}} Logitud: {{$ninio->longitud!= ""? $ninio->longitud:'S/R'}}</h3> 
    <hr>
    @if($ninio->latitud!="" && $ninio->longitud!="" )   
      <div id="map"></div>
    @else
      <div class="alert alert-info alert-styled-left alert-dismissible">           
        <span class="font-weight-semibold">El participante no tiene registrado su ubicación!</span>  
      </div>
    @endif
</div>
</div>
@push('linksCabeza')
  <link rel="stylesheet" href="{{asset('admin/css/loader.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/plus/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css')}}">
  <script src="{{asset('admin/js/searchNinio.js')}}"></script>
    
  <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/datatables.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/extensions/dataTables.buttons.min.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/extensions/buttons.flash.min.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/extensions/jszip.min.js')}}"></script>
  <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/extensions/vfs_fonts.js')}}"></script>    
  <script type="text/javascript" charset="utf8" src="{{asset('admin/plus/DataTables/extensions/buttons.html5.min.js')}}"></script>
 

@endpush

@prepend('linksPie')


  <script>
    /*Inicializa el mapa en haciendo referencia al departamento*/
    var map;
    var marker;
    var ninio="{{$ninio->nombres}}";
    var comunidad="{{$ninio->comunidad->nombre}}"
    var provincia="{{$ninio->comunidad->canton->provincia->nombre .'-'. $ninio->comunidad->canton->nombre }}";
    function initMap() {
      @if ($ninio->latitud && $ninio->longitud)
        var myLatLng={lat: {{$ninio->latitud}}, lng: {{$ninio->longitud}}}
          map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 15
        }); 
            var marker = new google.maps.Marker({
            map: map,
            position: myLatLng,
            title:"Ubicación registrada",
          });
          marker.setMap(map);   
          var geocoder = new google.maps.Geocoder;
          var infowindow = new google.maps.InfoWindow;
          infowindow.setContent(ninio+"<br>"+ provincia +"<br>"+ comunidad);
          infowindow.open(map, marker); 
          @endif
      }

    </script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0Ko6qUa0EFuDWr77BpNJOdxD-QLstjBk&callback=initMap">
  </script>

  <script>
      $('#menuNinios').addClass('active');
  </script>
  @endprepend
  <style type="text/css">
    #map {
      height: 400px;
      width: 100%;
    }
  </style>

@endsection
