@extends('layouts.app',['title'=>'Actas POA'])
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')

              
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Términos y Condiciones</h5>
        <div class="header-elements">
            <div class="list-icons">
               {{--  <a class="list-icons-item" data-action="collapse"></a>
                 <a class="list-icons-item" data-action="reload"></a>                          --}}
                <a class="list-icons-item" data-action="fullscreen"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="embed-responsive embed-responsive-21by9">
            <iframe class="embed-responsive-item" src="{{ asset('/Archivos/politicas.pdf') }}"></iframe>
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

@endsection('content')