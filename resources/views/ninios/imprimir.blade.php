<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información de usuario {{ $ninio->nombres }}</title>
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        table, th, td {
            border: 1px solid black;
            text-align: justify;
        }
        
            #map {
              height: 400px;
              width: 100%;
            }
          
    </style>
</head>
<body onload="window.print()">
    
    @include('ninios.datos',['ninio'=>$ninio])

    <script>
        (function () {

            if (window.matchMedia) {
                var mediaQueryList = window.matchMedia('print');
    
                mediaQueryList.addListener(function (mql) {
                    $(location).attr('href', "{{ route('ninio-informacion',$ninio->id) }}")
                });
            }
            
        }());
    </script>


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
    
</body>
</html>