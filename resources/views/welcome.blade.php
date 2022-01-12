@extends('layouts.app',['title'=>'Bienvenido'])

@section('breadcrumbs', Breadcrumbs::render('inicio'))

@section('barraLateral')

@endsection

@section('content')


@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<div class="content d-flex justify-content-center align-items-center">

    <div class="card mb-0 login-form">
        <img class="card-img-top" src="{{ asset('img/cactu-nuevo-logo.jpg') }}" alt="Card image cap">
        <div class="card-body text-center" >
          <h5 class="card-title my-0" ><strong>CACTU</strong></h5>
          <p class="card-text">
            CORPORACIÓN DE ASOCIACIONES DE COTOPAXI Y TUNGURAHUA
          </p>
          <hr>
          {{ date('Y') }}
          
        </div>
      </div>

</div>




@push('linksCabeza')
  
<script type="text/javascript" src="{{ asset('admin/plus/floating-whatsapp/floating-wpp.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('admin/plus/floating-whatsapp/floating-wpp.min.css') }}">
@endpush

@prepend('linksPie')

{{-- messenger --}}
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v6.0'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="707887712735256"
  theme_color="#0084ff"
  logged_in_greeting=" ¡Hola! como podemos ayudarte?"
  logged_out_greeting=" ¡Hola! como podemos ayudarte?">
</div>

{{-- wastapp --}}
<div id="myDivWastapp"></div>

    <script>
        $('#menuEscritorio').addClass('active');
        $('#myDivWastapp').floatingWhatsApp({
          phone: '593989047204',
          headerTitle: 'Bienvenido!',
          popupMessage: '¡Hola! como podemos ayudarte?',
          showPopup: true,
          size:'45pt',
            });
    </script>
@endprepend

@endsection
