@extends('layouts.app',['title'=>'buzon participante'])
@section('breadcrumbs', Breadcrumbs::render('buzonNinio',$ninio))
@section('content')
<div class="content">
    <div class="timeline timeline-center ">
        <div class="timeline-container ">
            @if($buzones->count()>0)
             {{-- inicio del scrooll infinito --}}
            <div class="infinite-scroll">
                @foreach($buzones as $buzonc)
                <!-- Date stamp -->
                <div class="timeline-date text-muted">
                    <h6>
                        <span class="badge bg-purple font-weight-semibold timeline-content">
                            <i class="icon-history mr-2">
                            </i>
                            {{ \Carbon\Carbon::parse($buzonc->fecha)->format('M d Y')}}
                        </span>
                    </h6>
                </div>
                <!-- /date stamp -->
                <!-- Blog post -->
                <div class="timeline-row timeline-row-full">
                    {{--
                    <div class="timeline-icon text-center">
                        <a class="btn bg-info border-teal text-teal rounded-round border-2 btn-icon mr-3" href="#">
                            <i class="icon-plus3 ">
                            </i>
                        </a>
                    </div>
                    --}}
                    <div class="row">
                        @php
                $m=0;
              @endphp
              @foreach($buzonc->buzonCartas as $buzonCarta)        
                @php
                  $m++;
                  $j= $m%2;
                @endphp
                        <div class="col-lg-6 ">
                            <!-- My messages -->
                            <div class="card {{$j>0?'js--fadeInLeft ':'js--fadeInRight' }} timeline-content">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title">
                                        Carta: {{ $buzonCarta->nombre }}
                                    </h6>
                                    <div class="header-elements">
                                        <span>
                                            <i class="icon-history text-warning mr-2">
                                            </i>
                                            {{ $buzonCarta->cartasBuzon->created_at->diffForHumans() }}
                                        </span>
                                        <span align-self-start="" class="badge bg-{{$buzonCarta->cartasBuzon->estado=='Respondida'?'success':'warning'}}" ml-3="">
                                            {{ $buzonCarta->cartasBuzon->estado=="Respondida"?$buzonCarta->cartasBuzon->estado:$buzonCarta->buzonTipoCarta($buzonCarta->cartasBuzon->buzon_id)->estado}}
                                        </span>
                                        @if ( $buzonCarta->nombre=="Presentación")
                          @if ($ninio->fechaNacimiento)
                            @php
                                $edad=\Carbon\Carbon::parse($ninio->fechaNacimiento)->age
                            @endphp
                                        <span class="badge bg-{{$edad>5?'success':'warning'}} align-self-start ml-3">
                                            {{ $edad>5?'Mayor de 5 Años':'Menor de 5 Años'}}
                                        </span>
                                        @else
                                        <span class="badge bg-warning align-self-start ml-3">
                                            Sin F. Nacimiento
                                        </span>
                                        @endif

                        @endif
                                    </div>
                                </div>
                                <!-- Area chart -->
                                <div id="messages-stats">
                                </div>
                                <!-- /area chart -->
                                <!-- Tabs -->
                                <ul class="nav nav-tabs nav-tabs-solid nav-justified bg-blue-800 border-x-0 border-bottom-0 border-top-blue-300 mb-0">
                                    <li class="nav-item">
                                        <a class="nav-link font-size-sm text-uppercase active" data-toggle="tab" href="#messages-tue_{{$buzonCarta->cartasBuzon->id.''.$buzonCarta->id  }}">
                                            C. Contestada
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-size-sm text-uppercase" data-toggle="tab" href="#messages-mon_{{$buzonCarta->cartasBuzon->id.''.$buzonCarta->id  }}">
                                            Boletas
                                        </a>
                                    </li>
                                    @if($buzonCarta->nombre=="Contestación")
                                    <li class="nav-item">
                                        <a class="nav-link font-size-sm text-uppercase" data-toggle="tab" href="#messages-fri_{{$buzonCarta->cartasBuzon->id.''.$buzonCarta->id  }}">
                                            Pdf
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                                <!-- /tabs -->
                                <!-- Tabs content -->
                                <div class="tab-content card-body">
                                    <div class="tab-pane active fade show" id="messages-tue_{{$buzonCarta->cartasBuzon->id.''.$buzonCarta->id  }}">
                                        <ul class="media-list">
                                            <li class="media">
                                                <div class="mr-3">
                                                    {{--
                                                    <img alt="" class="rounded-circle" height="36" src="../../../../global_assets/images/demo/users/face25.jpg" width="36">
                                                        --}}
                                                    </img>
                                                </div>
                                                <div class="media-body text-center">
                                                    <div>
                                                        <button class="btn bg-blue-800 timeline-content btn-ladda btn-ladda-progress ladda-button" data-nombrecrata="{{$buzonCarta->nombre}}" data-url="{{ route('vistaCartaPdfNinio',Crypt::encryptString($buzonCarta->cartasBuzon->id)) }}" onclick="abrirModalCarta(this);">
                                                            <i class="icon-statistics mr-2">
                                                            </i>
                                                            Ver carta
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="messages-mon_{{$buzonCarta->cartasBuzon->id.''.$buzonCarta->id  }}">
                                        <div class="card">
                                            <div class="card-body row">
                                                @foreach ($buzonCarta->buzonCartaBoletasget($buzonCarta->cartasBuzon->id) as $boleta)
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="card borde border-blue-800">
                                                        <div class="card-img-actions m-1 text-center">
                                                            <img alt="" class="" height="82" src="{{Storage::url('boletas/'.$boleta->boleta)}}" width="82">
                                                                <div class="card-img-actions-overlay card-img">
                                                                    <a class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2" data-fancybox="" data-height="265" data-width="348" href="{{Storage::url('boletas/'.$boleta->boleta)}}">
                                                                        <i class="icon-plus3">
                                                                        </i>
                                                                    </a>
                                                                </div>
                                                            </img>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @if($buzonCarta->nombre=="Contestación")
                                    <div class="tab-pane fade" id="messages-fri_{{$buzonCarta->cartasBuzon->id.''.$buzonCarta->id  }}">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe allowfullscreen="" class="embed-responsive-item" src="{{ Storage::url('cartas/'.$buzonCarta->cartasBuzon->archivo)}}">
                                            </iframe>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <!-- /tabs content -->
                            </div>
                            <!-- /my messages -->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /blog post -->
                @endforeach
      {{ $buzones->links() }}
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">
                    No exiten datos
                </h4>
            </div>
            @endif
        </div>
    </div>
    <!-- /timeline -->
</div>
<!-- Modal respuesta -->
<div aria-hidden="true" aria-labelledby="documento" class="modal fade" id="documentoRegistro" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documento">
                    Repuesta de la carta
                    <span id="nombreCarta">
                    </span>
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" data-dismiss="modal" type="button">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
{{--  Full width modal   --}}

{{--  /full width modal   --}}
  @push('linksCabeza')
<script charset="utf8" src="{{asset('admin/plus/jscroll/jscroll.min.js')}}" type="text/javascript">
</script>
<script src="{{ asset('admin/plus/timelines/js/index.js') }}">
</script>
<script src="{{asset('admin/plus/buttons/spin.min.js')}}">
</script>
<script src="{{asset('admin/plus/buttons/ladda.min.js')}}">
</script>
<script src="{{asset('admin/plus/buttons/components_buttons.js')}}">
</script>
<script charset="utf8" src="{{asset('admin/plus/scrollreveal/scrollreveal.js')}}" type="text/javascript">
</script>
@endpush

@prepend('linksPie')
<script>
    $('#misParticipantes').addClass('active');
</script>
<script type="text/javascript">
    $('ul.pagination').hide();
  $(function() {
      $('.infinite-scroll').jscroll({
          autoTrigger: true,
          loadingHtml: '<img class="center-block" src="{{asset("img/loader.gif")}}" alt="Loading..." />',
  
          nextSelector: '.pagination li.active + li a',
          contentSelector: 'div.infinite-scroll',
          callback: function() {
              $('ul.pagination').remove();
          }
      });
  });
</script>
<script>
    function abrirModalCarta(arg){
      $('#documentoRegistro').modal('show');
      $('#documentoRegistroPdf').attr('src',$(arg).data('url'));
      $("#modalBody").load($(arg).data('url'), function(responseTxt, statusTxt, xhr){
          $('#nombreCarta').html($(arg).data('nombrecrata'));
      });
    }

    $('#documentoRegistro').on('hidden.bs.modal', function (e) {
        $('#documentoRegistroPdf').attr('src','')
    });
      //configracion pra la carga del div
    var configblock = {
        message: '<i style="-webkit-animation: rotation 1s linear infinite;width: 30%; top: 75%; left: auto; text-align: center; color: rgb(0, 0, 0); border: 0px;" class="icon-spinner3 spinner fa-5x "></i>',

        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    };
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
