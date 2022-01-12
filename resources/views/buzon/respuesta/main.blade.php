
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
  <meta name="viewport"
  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <meta name="theme-color" content="#2e4e7d;"> --}}
  <meta name="theme-color" content="#2e4e7d" />
  <!-- CSRF Token -->
 
 <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }} | {{ ucfirst($title ?? '') }}</title>
	{{-- favicon --}}
	<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('buzon/fonts/contestacion/roboto.css')}}">
  <link href="{{ asset('admin/font/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/font/fontawesome-free-5.9.0-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/css/components.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/css/colors.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('buzon/bienvenida.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
	
  <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('admin/js/blockui.min.js') }}"></script>
  <script src="{{ asset('admin/js/app.js') }}"></script>
  <script src="{{ asset('admin/js/fab.min.js')}}"></script>  

  <script src="{{ asset('admin/js/adapter.min.js') }}"></script>
  <script src="{{ asset('admin/js/instascan.min.js') }}"></script>
  <script src="{{asset('admin/plus/buttons/spin.min.js')}}"></script>
  <script src="{{asset('admin/plus/buttons/ladda.min.js')}}"></script>
  <script src="{{asset('admin/plus/buttons/components_buttons.js')}}"> </script>
  
 
  <script type="text/javascript" src="{{asset('buzon/pdfjs/build/pdf.min.js')}}"></script>
    {{--  Lobibox.min  --}}
	<link rel="stylesheet" href="{{ asset('admin/plus/Lobibox/css/lobibox.min.css') }}">
  <script src="{{ asset('admin/plus/Lobibox/js/lobibox.js') }}"></script>
 
  <script src="{{ asset('admin/plus/jquery-validation/jquery.validate.js') }}"></script>
  {{--  <script src="{{ asset('js/app.js') }}" defer></script>  --}}
  
  <link href="{{ asset('webcodecamjs/css/style.css') }}" rel="stylesheet">
  <script type="text/javascript" src="{{ asset('webcodecamjs/js/qrcodelib.js') }}"></script>
  <script type="text/javascript" src="{{ asset('webcodecamjs/js/webcodecamjquery.js') }}"></script>
  
  <script>
	
	Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
			sound: false,
			continueDelayOnInactiveTab: false,
			position:"bottom right",
			size:"mini"
		});
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		function notificar(tipo,mensaje){
            Lobibox.notify(tipo, {
                title:"{{ config('app.name','CACTU') }}",
                msg: mensaje
            });
		}
		
	</script>
</head>
    
<body  class="navbar-top" >
  <div class="wrapper">
    @foreach (['success', 'warning', 'info', 'error','default'] as $msg)
    @if(Session::has($msg))
    <script>
      Lobibox.notify("{{ $msg }}", {
        title:"{{ config('app.name','CACTU') }}",
        msg: "{{ Session::get($msg) }}"
      });
    </script>
    @endif
  @endforeach
      <!-- Bottom left menu -->
    @if ($buzones->count()>0)        
      <ul class="fab-menu fab-menu-fixed fab-menu-bottom-left" data-fab-toggle="click">
        <li>
          <a class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon text-white">
            <i class="fab-icon-open icon-paragraph-justify3"></i>
            <i class="fab-icon-close icon-cross2"></i>
          </a>

          <ul class="fab-menu-inner text-info">
            @foreach ($buzones as $carta)
 
              <li class="text-info">
                <div class="fab-label-visible" data-fab-label="{{$carta->nombre}}">
                  <a href="{{route('misCartasRespuestas',[Crypt::encryptString($carta->cartasBuzon->id),Crypt::encryptString($ninio->token)])}}" class="btn btn-light rounded-round btn-icon btn-float ">
                    <i class="icon-envelop4"></i>
                  </a>
                </div>
              </li>                
            @endforeach

          </ul>
        </li>
      </ul>
    @endif
    <div class="shape shape-style-1 shape-primary">

        <span class="span-150"></span>
        <span class="span-50"></span>
        <span class="span-50"></span>
        <span class="span-75"></span>
        <span class="span-100"></span>
        <span class="span-75"></span>
        <span class="span-50"></span>
        <span class="span-100"></span>
        <span class="span-50"></span>
        <span class="span-100"></span>
      </div>
      <!-- /bottom left menu -->
    <div id="menu-nav" >
      <div class="card colorp" >
        <div class="page-header page-header-light mt-1">
          <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex  ml-3 text-withe">
              <h4> <a  href="{{route('misCartasBuzon',$ninio->token)}}"> <i class="icon-arrow-left52 mr-2 icon-2x text-withe"></i></a> <span class="font-weight-semibold">Carta de {{$buzonCarta->tipoCarta->nombre}}</span></h4>
               
            </div>
  
  
              </div>
  
              </div>
        </div>
        <div id="navigation-bar">
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified cssnav">
                <li class="nav-item "><a href="#justified-icon-only-tab1" class="nav-link active" data-toggle="tab"><i class="icon-pencil7"></i><span>Escribir</span></a></li>
                @if ($buzonCarta->tipoCarta->nombre=="Contestación")
                 <li class="nav-item"><a href="#justified-icon-only-tab2" class="nav-link" data-toggle="tab"><i class="icon-envelop4"></i><span>Leer</span></a></li>
                @endif
                <li class="nav-item"><a href="#justified-icon-only-tab3" class="nav-link" data-toggle="tab"><i class="icon-notification2"></i><span>Ayuda</span></a></li>
            
            </ul>
        </div>
        
    </div>
    <div class="container">
     
          <!-- Page header -->
					
				<!-- /page header -->
        <div class="tab-content mt-5">
          <div class="tab-pane   show active" id="justified-icon-only-tab1">    
          
            @if ($buzonCarta->tipoCarta->nombre=="Contestación")
            @include('buzon.respuesta.formularioContestacion')
            @endif
            @if ($buzonCarta->tipoCarta->nombre=="Agradecimiento")
            @include('buzon.respuesta.formularioAgradecimiento')
            @endif
            @if ($buzonCarta->tipoCarta->nombre=="Presentación")
            @include('buzon.respuesta.presentacion',$buzonCarta)
            @endif 
            @if ($buzonCarta->tipoCarta->nombre=="Unión")
            @include('buzon.respuesta.formularioUnion',$buzonCarta)
            @endif 
            @if ($buzonCarta->tipoCarta->nombre=="Iniciadas")
            @include('buzon.respuesta.formularioIniciadas',$buzonCarta)
            @endif 
          </div>

          @if ($buzonCarta->tipoCarta->nombre=="Contestación")
            <div class="tab-pane mt-5" id="justified-icon-only-tab2">
              @include('buzon.vistapdf',$buzonCarta)
            </div>
        
          @endif
          
          <div class="tab-pane " id="justified-icon-only-tab3">
            @if ($buzonCarta->tipoCarta->nombre=="Contestación")
        
              @include('buzon.respuesta.ayudaContestacion')
            @endif
            @if ($buzonCarta->tipoCarta->nombre=="Agradecimiento")
        
              @include('buzon.respuesta.ayudaAgradecimiento')
            @endif
            @if ($buzonCarta->tipoCarta->nombre=="Unión")
        
              @include('buzon.respuesta.ayudaUnion',$buzonCarta)
            @endif
       
            @if ($buzonCarta->tipoCarta->nombre=="Iniciadas")
        
              @include('buzon.respuesta.ayudaIniciadas',$buzonCarta)
            @endif
            
            @if ($buzonCarta->tipoCarta->nombre=="Presentación")
              @if ($buzonCarta->buzon->ninio->fechaNacimiento)            
                  @php
                      $edad=\Carbon\Carbon::parse($ninio->fechaNacimiento)->age
                  @endphp
              {{-- 6244 --}}
                  @if ($edad>5)            
                      @include('buzon.respuesta.ayudaPresentacionMayores')
                  @else
                      @include('buzon.respuesta.ayudaPresentacionMenores')
                  @endif    
              @else
                  @include('buzon.respuesta.ayudaPresentacionMayores')
              @endif
            @endif 
          </div>
          
         
        </div>
        
      </div>


    
    <style>
      .colorp{
        background-color: #2e4e7d;
        color: #ffffff
      }
      a{
        color: #ffffff 
      }
      .card,input{
        font-family: 'Handlee';
        font-weight: 600;
        font-size: 18px;
      }
      span{
        font-weight: bold;
      }
      #menu-nav {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    font-family: 'Handlee', bold;
    font-weight: bold;
    font-size: 18px;
    z-index: 1030;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    box-shadow: 0 9px 16px 0 rgba(0, 0, 0, 0.1), 0 0 0 1px #170c22, 0 2px 1px 0 rgba(121, 65, 135, 0.5), inset 0 0 4px 3px rgba(15, 8, 22, 0.2);
    background-image: linear-gradient(#051c31, #082e52);
    /* text-shadow: 0 0 21px rgba(223, 206, 228, 0.5), 0 0 10px rgba(223, 206, 228, 0.4), 0 0 2px #2a153c; */
  
}
#navigation-bar a {
    box-shadow: inset 0 1px 1px rgba(65, 55, 125, 0.8), inset 0 -1px 0px rgba(63, 59, 113, 0.2), 0 9px 16px 0 rgba(0, 0, 0, 0.3), 0 4px 3px 0 rgba(0, 0, 0, 0.3), 0 0 0 1px #150a1e;
    background-image: linear-gradient(#155592, #072541);
    /* text-shadow: 0 0 21px rgba(223, 206, 228, 0.5), 0 -1px 0 #311d47; */
   
    transition: all 0.3s ease;
    color: #789931;
}
  div>ul>li>.active{
    transform: scale(0.7);
  }
  </style>  
  <script type="text/javascript" src="{{ asset('webcodecamjs/js/mainjquery.js') }}"></script>
  {{-- <script type="text/javascript" src="{{ asset('webcodecamjs/js/mainjquery2.js') }}"></script> --}}
</body>

</html>