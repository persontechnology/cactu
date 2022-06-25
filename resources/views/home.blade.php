@extends('layouts.app',['title'=>'Inicio'])

@section('breadcrumbs', Breadcrumbs::render('home'))

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
        <div class="card-body text-center">
          <h5 class="card-title my-0"><strong>CACTU</strong></h5>
          <p class="card-text">
            CORPORACIÓN DE ASOCIACIONES DE COTOPAXI Y TUNGURAHUA
          </p>
          <hr>
          {{ date('Y') }}
          <hr>
          <small>
            {{ app()->version()}}
          </small>
          
        </div>
      </div>

</div>



@push('linksCabeza')

@endpush

@prepend('linksPie')


  <script>
      $('#menuEscritorio').addClass('active');
      
  </script>
@endprepend

@endsection
