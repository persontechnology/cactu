
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- <title>{{ config('app.name', 'Laravel') }} | {{ ucfirst($title ?? '') }}</title> --}}
  <title>Mi Buzon</title>
	{{-- favicon --}}
	<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
  <link href="{{ asset('admin/font/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/font/fontawesome-free-5.9.0-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	
  <link href="{{ asset('buzon/aragon/assets/css/argon-design-system.css')}}" rel="stylesheet" />
  <link href="{{ asset('buzon/css/contenedor.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('buzon/bienvenida.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('buzon/css/normalize.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('buzon/css/demo.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('buzon/css/component1.css') }}" rel="stylesheet" type="text/css">
   
  <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
	
  <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
  
  <script src="{{ asset('buzon/js/modernizr-2.6.2.min.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('admin/plus/bootstrap-sweetalert/sweetalert.css') }}">
  <script src="{{ asset('admin/plus/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
  
</head>
    
<body class="index-page">
  <div class="wrapper">
    <div class="section section-hero section-shaped">
      <div class="shape shape-style-1 shape-primary">
        <div id="header" class="" style="background-image:url('{{ asset('buzon/img/nube.png') }}')" >
          <div class="container">
            <div class="menubar m-0 mt-md-0 mt-lg-3">
              <div class="row bg-media">
               
                <div class="col-lg-12 col-md-12 col-12 mp-2">
                  <h4 class="media-title font-weight-semibold textob" >
                    <i class='fas fa-mail-bulk mr-2 ' style='font-size:36px' ></i>
                    Cactu, te da la bienvenida
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
          <div class="container shape-container d-flex align-items-center  ">
            <div class="col px-0">

              <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 text-center mt-5">

                  <div class="component1 ">
                      <button class="cn-button btn-white " id="cn-button">+</button>
                      <div class="cn-wrapper" id="cn-wrapper">
                          <ul class="nav nav-tabs menu" id="mytabs">
                              <li class="nav-item">
                                  <a id="popoverOption"  href="#home" data-placement="bottom" class="nav-link active" data-content="Inicio" rel="popover" data-placement="bottom" data-toggle="tab"><i class="fas fa-door-open mr-3 fa-1x "></i></a>
                              </li>
                              <li class="nav-item ">
                                  <a id="popoverOption1" data-content="Tutorial" data-placement="bottom" rel="popover" data-placement="bottom"  href="#profile" class="nav-link" data-toggle="tab"><i class="fas fa-chalkboard-teacher mr-3 fa-1x  "></i></a>
                              </li>
                              <li class="nav-item ">
                                  <a id="popoverOption2" data-content="Chat" data-placement="bottom" rel="popover" data-placement="bottom"   href="#messages" class="nav-link" data-toggle="tab"><i class="fas fa-comment-dots mr-3 fa-1x  "></i></a>
                              </li>
                            
                            
                          </ul>
                      </div>
                      <div id="cn-overlay" class="cn-overlay"></div>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="home">
                      <img src="{{ asset('buzon/img/buzonca.gif') }}"  style="width: 100px;" class="img-fluid">
                      <h5 class="mt-3 text-white"><strong>{{ $ninio->nombres }}</strong></h5>  
                      <p class="lead text-white">Cactu, te da la bienvenida a nuestro sistema de gestión de correspondencia gracias al financiamiento de ChildFund, si deseas ingresar presiona ENTRAR o si tienes dudas presiona el boton <i class="fas fa-plus-circle"></i></p>
                      <div class="btn-wrapper mt-2">
                        <div class="card1">
                          <div class="card-img-actions mx-1 mt-1">
                            <img class="card-img img-fluid" src="{{ asset('buzon/img/logo_chil.png') }}"  style="width: 120px;"alt="">
                           
                          </div>

                          <div class="card-body text-center">
                       
                         
                        @if ($buzones->count()>0)
                          <a onclick="condiciones(this);" data-url="{{route('misCartasBuzon',$ninio->token)}}" class="btn btn-lg btn-github btn-icon mb-3 mb-sm-0 text-white" >
                            <span class="btn-inner--icon"><i class="fas fa-envelope-open-text mr-3 fa-1x"></i></span>
                            <span class="btn-inner--text"><span class="text-warning">Entrar</span> a mi buzón</span>
                          </a>                            
                        @else
                            <div class="alert btn-github" role="alert">
                              <span class="btn-inner--text"><span class="text-warning">No tienes cartas que mostrar</span></span>
                            </div>
                        @endif 
                         </div>
                        </div>                   
                      </div>
                     
                    </div>
                    <div class="tab-pane fade" id="profile">
                      <div class="card">
                        <div class="card-header">
                          <h5 class="card-title font-weight-semibold"><a href="#" class="text-default">Tutorial </a></h5>
                        </div>
          
                        <div class="card-body">
                          <div class="card-img embed-responsive dosdu embed-responsive-16by9 mb-1">
                            <iframe class="embed-responsive-item" allowfullscreen="" frameborder="0" mozallowfullscreen="" src="{{asset('buzon/tutorial/tutorial.m4v')}}"></iframe>
                          </div>
          
                          Hola en este video se mostrará los pasos que debes seguir para utilizar tu buzón de gestión de correspondencia.
                        </div>                  
                      </div>
                  </div>
                  <div class="tab-pane fade" id="messages">
                    <div class="container">
                      <div class="row justify-content-center">
                        <div class="col-lg-10">
                          <div class="card dosdu bg-secondary shadow border-0">
                            <div class="card-header bg-white ">
                              
                              <div class="text-center">
                                <img src="{{ asset('buzon/img/pre.gif') }}" style="width: 150px;" class="img-fluid rounded-circle shadow-lg">
                              </div>
                            </div>
                            <div class="card-body ">
                              <div class="text-center text-muted mb-4">
                                <small>Tienes inquietudes ?? Dejanos un mensaje tu gestor te ayudará muy gustos</small>
                              </div>
                              <form  id="envioDeMensajes" method="POST" action="{{route('guardarMensajeNinio')}}">
                              @csrf
                                <input type="hidden" name="getIp" id="getIp" value="{{$ninio->token}}">
                                <div class="form-group">
                                  <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control dosdu" placeholder="nombre" type="text" value="De: {{ $ninio->nombres }}" disabled>
                                  </div>
                                </div>
                                <div class="form-group focused">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <textarea class="form-control dosdu" placeholder="mensaje" name="mensaje" id="mensaje" required rows="3"></textarea>
                                  </div>
                                </div>                                
                                <div class="text-center">
                                  <button type="submit" class="btn btn-primary mt-2 dosdu"><i class="fas fa-paper-plane mr-2"></i> Enviar</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                    
                  </div>
            
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
   
      </div>
    </div>
  
  </div><!-- Typography -->
</div>


      <script src="{{ asset('buzon/js/demo1.js')}}"></script>
    <script>
      function condiciones(arg) {
        var url=$(arg).data('url');
        swal({
            title: "<h6>¡Alerta de Confidencialidad de la información!</h6>",
            text: "<h6>Las comunicaciones entre el patrocinador y los infantes, niños, niñas, adolescentes y jóvenes siempre son revisadas, para asegurar la confidencialidad de la información  y que el contenido es apropiado. En ningún momento está permitido el intento de intercambiar direcciones, números de teléfono, correo electrónico o redes sociales.</h6>",
            html:true,
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            cancelButtonClass: "btn-danger",
            confirmButtonText: "¡Sí, acepto!",
            cancelButtonText:"No acepto",
            closeOnConfirm: false
        },
        function(){
          window.location.href =url;
        });
      }
    
    $("#envioDeMensajes").submit(function(e) {
      e.preventDefault(); // avoid to execute the actual submit of the form.         
      var form = $(this);
      var url = form.attr('action');
        
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {    
          
          if(data.success){
            
            swal("succes",data.success );
            $('#mensaje').val('');
          }
          if(data.yaexiste){
            swal("error",data.yaexiste );
          }     
          if(data=="false"){
            swal("error", "Advertencia! la información ingresada no es la correcta");
          }
        }
      });
    });


  $('#popoverOption').popover({ trigger: "hover" });
  $('#popoverOption1').popover({ trigger: "hover" });
  $('#popoverOption2').popover({ trigger: "hover" });

  </script>
  <style type="text/css">
     .textob{
      color:#02314e;
     }
  </style>
</body>

</html>