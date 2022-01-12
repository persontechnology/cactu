@extends('layouts.app',['title'=>'Información de participante'])
@section('breadcrumbs', Breadcrumbs::render('informacionMiParticipante',$ninio))

@section('barraLateral')

    <div class="breadcrumb justify-content-center">
        <div class="breadcrumb-elements-item dropdown p-0">
            <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-users"></i>
                Más opciones
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('informacionPdfMiParticipante',$ninio->id) }}" target="_blanck" class="dropdown-item"><i class="fas fa-file-pdf"></i> Descargar PDF</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="card">
@include('ninios.datos',['ninio'=>$ninio])
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
  }

</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0Ko6qUa0EFuDWr77BpNJOdxD-QLstjBk&callback=initMap">
</script>

<script>
    $('#misParticipantes').addClass('active');
</script>
@endprepend
<style type="text/css">
  #map {
    height: 400px;
    width: 100%;
  }
</style>

@endsection