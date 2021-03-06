@extends('layouts.app',['title'=>'Actualizar participante'])
@section('breadcrumbs', Breadcrumbs::render('editarMiParticipante',$ninio))
@section('content')
<form action="{{route('actualizarMiParticipante')}}" method="post">
	@csrf
<div class="card">
    <div class="card-header">
        Actualizar participante: {{$ninio->nombres}}	
    </div>
    <div class="card-body"> 
	  	
		<div class="row">
			<div class="col-sm-6">
				<input type="hidden" name="ninio" id="ninio" value="{{$ninio->id}}">
				<div class="form-group row">
					<label for="tipoParticipante" class="col-form-label col-lg-3">Tipo participante</label>
					<div class="col-lg-9">	                  
							<select class="selectpicker show-tick form-control @error('tipoParticipante') is-invalid @enderror" id="tipoParticipante" name="tipoParticipante" title="Selecione Tipo participante..." data-live-search="true" data-header="Selecione Tipo participante.." required="">		              			            
							@foreach ($tipoParticipante as $tipo)
								<option {{ old('tipoParticipante',$ninio->tipoParticipante->id)==$tipo->id?'selected':'' }} value="{{$tipo->id}}"   data-tokens="{{$tipo->id ?? ''}}" >{{$tipo->nombre ?? ''}} 
								</option>
							@endforeach		                         
						</select>
						@error('tipoParticipante')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror                
						</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Comunidad <span class="text-danger">*</span></label>
					<div class="col-lg-9">	                  
						<select class="form-control selectpicker  @error('comunidad_id') is-invalid @enderror" id="comunidad_id" data-live-search="true" name="comunidad_id" required>
							<option value="">Selecione una comunidad</option>
							@foreach ($cantones as $can)
							<optgroup label="{{$can->provincia->nombre .'-' . $can->nombre}}">
								@foreach ($can->comunidades as $comu)
								<option data-subtext="{{ $comu->usuario->name }}" value="{{ $comu->id }}" {{ old('comunidad_id',$ninio->comunidad_id)==$comu->id?'selected':'' }}>{{ $comu->nombre }}</option>
								@endforeach
								</optgroup>
							@endforeach
						</select>
						@error('comunidad_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror                
						</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3">Nombres <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<input type="text" name="nombres" id="nombres" class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required="" value="{{ old('nombres',($ninio->nombres??$ninio->usuario->name)??'') }}">
						@error('nombres')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
	
				<div class="form-group row " id="ninioNumero">
					<label class="col-form-label col-lg-3">N??mero de participante </label>
					<div class="col-lg-9">
						<input min="0" value="{{ old('numeroChild',$ninio->numeroChild) }}" id="numeroChild" name="numeroChild"  type="number" class="@error('numeroChild') is-invalid @enderror form-control"  >
						@error('numeroChild')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					
						</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">G??nero <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<select class="form-control selectpicker  @error('genero') is-invalid @enderror" data-live-search="true" name="genero" required>
							<option>Selecione un genero</option>                       
							<option  value="Male" {{ old('genero',$ninio->genero)=="Male"?'selected':'' }}>Masculino</option>
							<option  value="Female" {{ old('genero',$ninio->genero)=="Female"?'selected':'' }}>Femenino</option>                    
						</select>
						@error('genero')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror	                
						</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Fecha de nacimiento <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<input type="date"  id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento',$ninio->fechaNacimiento) }}" class="form-control @error('fechaNacimiento') is-invalid @enderror" required >
						@error('fechaNacimiento')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Fecha de registro <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<input type="date"  id="fechaRegistro" name="fechaRegistro" value="{{ old('fechaRegistro',$ninio->fechaRegistro) }}" class="form-control @error('fechaRegistro') is-invalid @enderror" required>
						@error('fechaRegistro')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Celular <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<input type="tel"  id="celular" name="celular" value="{{ old('celular',$ninio->celular) }}" class="form-control @error('celular') is-invalid @enderror" >
						@error('celular')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-3">Email <span class="text-danger">*</span></label>
					<div class="col-lg-9">
						<input type="email"  id="email" name="email" value="{{ old('email',$ninio->email) }}" class="form-control @error('email') is-invalid @enderror" >
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<p class="text-center">Ubicaci??n</p>
				<div class="input-group">
						<div class="input-group-prepend">
						<span class="input-group-text">lat</span>
						</div>
						<input type="text"  id="latitud" name="latitud" value="{{ old('latitud',$ninio->latitud) }}"  class="form-control @error('latitud') is-invalid @enderror" >
						<div class="input-group-prepend">
						<span class="input-group-text">Long</span>
						</div>
						<input   value="{{ old('longitud',$ninio->longitud) }}" id="longitud" name="longitud"  type="text" class="@error('longitud') is-invalid @enderror form-control"  >
						<a class="btn btn-dark text-white" id="buscarUbicacion"><i class="icon-search4"></i></a>
				</div>
		
				<div id="map"></div>        	
			</div>
		</div>
    	
    </div>
    <div class="card-footer">
		<button type="submit" class="btn btn-primary">Actualizar <i class="icon-paperplane ml-2"></i></button>
    </div>
</div>
</form>


@push('linksCabeza')
<link rel="stylesheet" href="{{ asset('admin/plus/select/css/bootstrap-select.min.css') }}">
<script src="{{ asset('admin/plus/select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('admin/plus/select/js/lg/defaults-es_ES.min.js') }}"></script>
{{-- phone --}}
<link rel="stylesheet" href="{{ asset('admin/plus/build-phone/css/intlTelInput.min.css') }}">
<script src="{{ asset('admin/plus/build-phone/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('admin/plus/build-phone/js/intlTelInput-jquery.min.js') }}"></script>
  
@endpush

@prepend('linksPie')

<script>
	/*Inicializa el mapa en haciendo referencia al departamento*/
	
	var map;
	var marker;
	function initMap() {
		@if($ninio->latitud!=""&&$ninio->longitud!="")
		var myLatLng={lat: {{$ninio->latitud}}, lng: {{$ninio->longitud}}}
		@else
		var myLatLng={lat: -0.9392135, lng: -78.6087184}
		@endif
		map = new google.maps.Map(document.getElementById('map'), {
		  center: myLatLng,
		  zoom: 10,
		  mapTypeId: 'hybrid'
		});	
		var marker = new google.maps.Marker({
		    map: map,
		    draggable: true,
		    animation: google.maps.Animation.DROP,
		    draggable:true,
		    position: myLatLng,
		    title:"Oficina CACTU sede Cotopaxi",
		  });
		  marker.setMap(map);
		  marker.addListener('dragend', function() {
		    var destinationLat = marker.getPosition().lat();
		    var destinationLng = marker.getPosition().lng(); 
		    puntosEspecificos(destinationLat,destinationLng)      
		  });		
		var geocoder = new google.maps.Geocoder;
		var infowindow = new google.maps.InfoWindow;
		 document.getElementById('buscarUbicacion').addEventListener('click', function() {
		  geocodeLatLng(geocoder, map, infowindow,marker);
		   
		});

	}
	
	/*funcion para buscar latitud y longitud en casa de que exista
	-1.2768936132798347
	-78.63767815143547
	*/
	function geocodeLatLng(geocoder, map, infowindow,marker) {
		var lati = $('#latitud').val();
		var longi =$('#longitud').val();
		var latlng = {lat: parseFloat(lati), lng: parseFloat(longi)};
		geocoder.geocode({'location': latlng}, function(results, status) {
		if (status === 'OK') {
			if (results[0]) {
			map.setZoom(11);
			marker.setMap(null);
			var marker1 = new google.maps.Marker({
				map: map,
				draggable: true,
				animation: google.maps.Animation.DROP,
				draggable:true,
				position: latlng,			    
			});
			marker1.setMap(map);
			marker1.addListener('dragend', function() {
				var destinationLat = marker1.getPosition().lat();
				var destinationLng = marker1.getPosition().lng(); 
				puntosEspecificos(destinationLat,destinationLng);
				infowindow.setContent(null)
				infowindow.open(null)
			});
			infowindow.setContent(results[0].formatted_address);
			infowindow.open(map, marker1);        
			} else {
			notificar("warning","Resultados no encontrados");
			}
		} else {
			notificar("info","La latitud y longitud son icorrectas");
		}
		});
	}

	function puntosEspecificos($lat,$long) {
		$('#latitud').val($lat);
		$('#longitud').val($long);
	}
</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0Ko6qUa0EFuDWr77BpNJOdxD-QLstjBk&callback=initMap">
</script>
<script>
    $('#misParticipantes').addClass('active');
	var instance= $('#celular').intlTelInput({
		autoHideDialCode:false,
		nationalMode:false,
		placeholderNumberType:"MOBILE",
		preferredCountries: ["ec" ],
		separateDialCode:false,
	});
</script>
@endprepend
<style type="text/css">
  #map {
    height: 400px;
    width: auto;
  }
</style>
@endsection