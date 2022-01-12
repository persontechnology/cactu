
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#2e4e7d" />
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- <title>{{ config('app.name', 'Laravel') }} | {{ ucfirst($title ?? '') }}</title> --}}
  <title>Mis cartas</title>
	{{-- favicon --}}
	<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
  <link href="{{ asset('admin/font/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/font/fontawesome-free-5.9.0-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{asset('buzon/fonts/contestacion/roboto.css')}}">	
  <link href="{{ asset('buzon/aragon/assets/css/argon-design-system.css')}}" rel="stylesheet" />
  <link href="{{ asset('buzon/css/contenedor.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('buzon/bienvenida.css') }}" rel="stylesheet" type="text/css">

  <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
	
  <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
  
  <script src="{{ asset('buzon/js/modernizr-2.6.2.min.js')}}"></script>
  {{--  Lobibox.min  --}}
	<link rel="stylesheet" href="{{ asset('admin/plus/Lobibox/css/lobibox.min.css') }}">
	<script src="{{ asset('admin/plus/Lobibox/js/lobibox.js') }}"></script>
	{{--  swalert  --}}
  <style>

    
  </style>
</head>
    
<body class="index-page">
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
    <div class="section section-hero section-shaped">
      <div class="shape shape-style-1 shape-primary">
        <div id="header" class="" style="background-image:url('{{ asset('buzon/img/nube.png') }}')" >
            <div class="container">
              <div class="menubar m-0 mt-md-0 mt-lg-3">
                <div class="row bg-media">
                 
                  <div class="col-lg-12 col-md-12 col-12 mp-2">
                    <h4 class="media-title font-weight-semibold textob" >
                      <i class='fas fa-mail-bulk mr-2 ' style='font-size:36px' ></i>
                      Revisa tus cartas abiertas por fechas
                    </h4>  
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>         
          </div>
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
        <div class="page-header">
            <div class="container">
                <div class="row mb-3 mt-5">
                    @if ($buzones->count()>0)
                        @foreach ($buzones as $buzon)
                         
                            <div class="col-lg-4 mt-2 " >
                                <div class="card card-body  border-top-1 border-top-pink ">
                                    <div class="text-center">
                                    <h6 class="m-0 font-weight-semibold">Tienes <span class="badge bg-warning rounded-circle text-white">{{$buzon->buzonCartasNinio->count()}}</span> cartas del  <strong>{{ \Carbon\Carbon::parse($buzon->fecha)->format('M d Y')}}</strong>.</h6>
                                        <p class="text-muted mb-3">Sin responder</p>
        
                                        <div class="btn-group dosdu ">
                                            <button type="button" class="btn btn-primary cca3d rounded-round rounded-right-0"><i class="icon-mail5 mr-2"></i> Responder</button>
                                            <button type="button" class="btn btn-primary cca3d rounded-round rounded-left-0 dropdown-toggle" data-toggle="dropdown"></button>
                                            <div class="dropdown-menu dropdown-menu-right cca3ddr text-white">
                                                @foreach ($buzon->buzonCartasNinio as $carta)
                                                {{-- {{$buzon->ninio->token}} --}}
                                                    <a style="color: #789931;" href="{{route('misCartasRespuestas',[Crypt::encryptString($carta->cartasBuzon->id),Crypt::encryptString($buzon->ninio->token)])}}" class="dropdown-item"><i class="icon-mail5"></i>{{$carta->nombre}}</a>                                                    
                                                @endforeach                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach         
                    @else
                      <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Advertencia!</span> No tienes cartas por contestar .
                      </div>
                    @endif
                </div>

            </div>
        </div>

      </div>
    </div>
  
  </div><!-- Typography -->
</div>
   <style type="text/css">
     .textob{
      color:#02314e;
     }
   </style>
     
</body>

</html>