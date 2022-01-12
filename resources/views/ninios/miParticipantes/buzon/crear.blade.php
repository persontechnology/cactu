@extends('layouts.app',['title'=>'buzon participante'])
@section('breadcrumbs', Breadcrumbs::render('crearBuzonMisPartticipante',$ninio))
@section('content')
 <!-- Content area -->
<div class="content">
    <!-- Scrollspy -->
    <div class="card">
        <div class="card-header header-elements-inline">
            @php
            $date = (\Carbon\Carbon::now());
            @endphp
            <h5 class="card-title" id="scrollspy">Administración de cartas del niñ@ {{ $ninio->nombres }} Con la fecha {{ \Carbon\Carbon::parse($date)->format('d/M/Y')}} <span class="badge bg-indigo-400 badge-pill ml-md-3 mr-md-auto" id="estadoCartas"></span> </h5>
            <div class="header-elements">
                <button class="btn bg-transparent border-info text-info rounded-round border-2 btn-icon" onclick="mostrarModal();"> <i class="icon-help"></i> Ayuda </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Second navbar -->
        
            <!-- /second navbar -->
            <div class="table-responsive">
                <table class="table table-sm table-default"  id="tablaTipo">
                    <thead>
                        <tr>
                        @foreach ($tipoCartas as $tipoCarta)
                            <th id="tipo_{{ $tipoCarta->id }}">
                                <button class="btn btn-primary list-icons-item timeline-content btn-ladda btn-ladda-progress ladda-button" data-getca="{{ $tipoCarta->id }}" data-urlbc="{{ route('crearCartaNuevo') }}"  onclick="gestionarCartas(this)" data-getip="{{ Crypt::encryptString($ninio->id) }}" data-getti="{{ Crypt::encryptString($tipoCarta->id) }}" >
                                    <i class="icon-plus3"></i> Crear {{ $tipoCarta->nombre }}
                                    <div class="ladda-progress" style="width: 140px;"></div>
                                </button> 
                            
                            </th>                          
                        @endforeach
                        </tr>
                    </thead>
            </table>                            
            </div>

            <div class="mb-4 mt-2" >
                
                <div class="row" id="cartasCreadas">
                    @if($cartasHoy)
                    
                    <script>
                    $(document).ready(function(){
                        var getIp='{{ Crypt::encryptString($ninio->id) }}';
                        buscarCaatas(getIp);
                    })
                    
                    </script>
                    @else
                    <div class="alert alert-info alert-styled-left alert-dismissible">
                            <strong>¡Confirmación!</strong> No existen cartas creadas en esta fecha
                        </div>
                    @endif

                </div>
                <div id="butonEnviar">

                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- /content area --> 
<div id="modal_ayuda" class="modal fade " tabindex="-1"  aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-brown">
                <h6 class="modal-title">Ayuda</h6>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">                
                <p class="">Ayuda !!!, para enviar cartas debes cumplir un proceso, 
                    cada carta creada se adjunta a una fecha en este caso <code>{{ \Carbon\Carbon::parse($date)->format('d/M/Y')}}</code>,
                    si deseas puedes enviar todos los tipos de cartas pero se debe tener encuenta, en la parte superio tenemos los tipos de 
                    carta para crear se debe selecionar el tipo de carta  y presionar botón crear, una vez creadas las cartas tendran
                    3 estados  <code>Creada, Envida y Respondida</code>.</p>
                <p>
                    <code>Estado Creada:</code> aquí se debe adjuntar la imagen de las boletas de la carta, en el caso Contestación de debe 
                    aduntar la carta recibida en pdf <code>El niñ@ aun no puede visualizar su carta. En estado puede eliminar y actualizar los archivos</code>. <br>
                    <code>Estado Envida:</code> Una vez completado los parametros y revizada cada carta se podra en enviar al niñ@, se debe dar presionar el boton 
                    enviar. En estado puede actualizar los archivos<br>
                    <code>Estado Respondida:</code> En este estado el nin@ ya respondio l carta y puede desscargar en formato pdf. En solo puede visualizar
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">cerrar</button>
               
            </div>
        </div>
    </div>
</div>

@push('linksCabeza')
  
 

<link rel="stylesheet" type="text/css" href="{{ asset('admin/plus/bootstrap-fileinput/css/fileinput.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plus/bootstrap-fileinput//themes/explorer-fas/theme.css') }}"/>
<script src="{{asset('admin/plus/buttons/spin.min.js')}}"></script>
<script src="{{asset('admin/plus/buttons/ladda.min.js')}}"></script>
<script src="{{asset('admin/plus/buttons/components_buttons.js')}}"> </script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/js/plugins/piexif.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/themes/explorer-fas/theme.js') }}"></script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/js/locales/es.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/plus/progressbar/bootstrap-progressbar.min.js') }}"></script>
<link href="{{ asset('admin/plus/jquery-confirm/jquery-confirm.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{ asset('admin/plus/jquery-confirm/jquery-confirm.min.js')}}"></script>
<script src="{{ asset('admin/plus/bootstrap-fileinput/js/locales/es.js') }}"></script>
<script src="{{ asset('admin/js/buzon.js') }}"></script>
@endpush

@prepend('linksPie')
<script>
    $('#misParticipantes').addClass('active');
  </script>

    <style>
     
      .timeline-content {    
        padding: 10px 30px;
        border-radius: 4px;   
        box-shadow: 0 20px 25px -15px rgba(0, 0, 0, 0.3);
      }

      
    </style>

@endprepend
@endsection