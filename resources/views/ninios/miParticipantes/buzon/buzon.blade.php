@extends('layouts.app',['title'=>'buzon participante'])
@section('breadcrumbs', Breadcrumbs::render('buzonMisPartticipante', $ninio))
@section('content')
    <div class="content">
        <div class="timeline timeline-center ">
            <div class="timeline-container ">
                {{-- {{$ninio->token}} --}}
                <div class="text-center ">
                    {{-- <button class="btn bg-success timeline-content btn-ladda btn-ladda-progress ladda-button" type="button">
                    <i class="icon-search4">
                    </i>
                    <span>
                        Buscar
                    </span>
                    <div class="ladda-progress" style="width: 140px;">
                    </div>
                </button> --}}
                    <a class="btn btn-primary timeline-content btn-ladda btn-ladda-progress ladda-button"
                        href="{{ route('crearBuzonParticipante', $ninio->id) }}" type="button">
                        <i class="icon-plus3 ">
                        </i>
                        <span>
                            Nuevo
                        </span>
                        <div class="ladda-progress" style="width: 140px;">
                        </div>
                    </a>
                    <button class="btn bg-info timeline-content btn-ladda btn-ladda-progress ladda-button"
                        data-idni="{{ $ninio->id }}" onclick="verMensajes(this)" type="button">
                        <i class="icon-envelope">
                        </i>
                        <span>
                            Mensajes
                        </span>
                        <div class="ladda-progress" style="width: 140px;">
                        </div>
                    </button>
                </div>
                @if ($buzones)
                    {{-- inicio del scrooll infinito --}}
                    <div class="infinite-scroll">
                        @foreach ($buzones as $buzonc)
                            <!-- Date stamp -->
                            <div class="timeline-date text-muted">
                                <h6>
                                    <span class="badge bg-purple font-weight-semibold timeline-content">
                                        <i class="icon-history mr-2">
                                        </i>
                                        {{ \Carbon\Carbon::parse($buzonc->fecha)->format('M d Y') }}
                                    </span>
                                </h6>
                            </div>
                            <!-- /date stamp -->
                            <!-- Blog post -->
                            <div class="timeline-row timeline-row-full">
                                {{-- <div class="timeline-icon text-center">
                        <a class="btn bg-info border-teal text-teal rounded-round border-2 btn-icon mr-3" href="#">
                            <i class="icon-plus3 ">
                            </i>
                        </a>
                    </div> --}}
                                <div class="row">
                                    @php
                                        $m = 0;
                                    @endphp
                                    @foreach ($buzonc->buzonCartas as $buzonCarta)
                                        @php
                                            $m++;
                                            $j = $m % 2;
                                        @endphp
                                        <div class="col-lg-6 ">
                                            <!-- My messages -->
                                            <div
                                                class="card {{ $j > 0 ? 'js--fadeInLeft ' : 'js--fadeInRight' }} timeline-content">
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
                                                        <span align-self-start=""
                                                            class="badge bg-{{ $buzonCarta->cartasBuzon->estado == 'Respondida' ? 'success' : 'warning' }}"
                                                            ml-3"="">
                                                            {{ $buzonCarta->cartasBuzon->estado == 'Respondida' ? $buzonCarta->cartasBuzon->estado : $buzonCarta->buzonTipoCarta($buzonCarta->cartasBuzon->buzon_id)->estado }}
                                                        </span>
                                                        @if ($buzonCarta->nombre == 'Presentación')
                                                            @if ($ninio->fechaNacimiento)
                                                                @php
                                                                    $edad = \Carbon\Carbon::parse($ninio->fechaNacimiento)->age;
                                                                @endphp
                                                                <span
                                                                    class="badge bg-{{ $edad > 5 ? 'success' : 'warning' }} align-self-start ml-3">
                                                                    {{ $edad > 5 ? 'Mayor de 5 Años' : 'Menor de 5 Años' }}
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
                                                <ul
                                                    class="nav nav-tabs nav-tabs-solid nav-justified bg-blue-800 border-x-0 border-bottom-0 border-top-blue-300 mb-0">
                                                    <li class="nav-item">
                                                        <a class="nav-link font-size-sm text-uppercase active"
                                                            data-toggle="tab"
                                                            href="#messages-tue_{{ $buzonCarta->cartasBuzon->id . '' . $buzonCarta->id }}">
                                                            C. Contestada
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link font-size-sm text-uppercase" data-toggle="tab"
                                                            href="#messages-mon_{{ $buzonCarta->cartasBuzon->id . '' . $buzonCarta->id }}">
                                                            Boletas
                                                        </a>
                                                    </li>
                                                    @if ($buzonCarta->nombre == 'Contestación')
                                                        <li class="nav-item">
                                                            <a class="nav-link font-size-sm text-uppercase"
                                                                data-toggle="tab"
                                                                href="#messages-fri_{{ $buzonCarta->cartasBuzon->id . '' . $buzonCarta->id }}">
                                                                Pdf
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <!-- /tabs -->
                                                <!-- Tabs content -->
                                                <div class="tab-content card-body">
                                                    <div class="tab-pane active fade show"
                                                        id="messages-tue_{{ $buzonCarta->cartasBuzon->id . '' . $buzonCarta->id }}">
                                                        <ul class="media-list">
                                                            <li class="media">
                                                                <div class="mr-3">
                                                                    {{-- <img alt="" class="rounded-circle" height="36" src="../../../../global_assets/images/demo/users/face25.jpg" width="36"> --}}
                                                                </div>
                                                                <div class="media-body text-center">
                                                                    <div>
                                                                        <button
                                                                            class="btn bg-blue-800 timeline-content btn-ladda btn-ladda-progress ladda-button"
                                                                            data-nombrecrata="{{ $buzonCarta->nombre }}"
                                                                            data-url="{{ route('vistaCartaPdf', Crypt::encryptString($buzonCarta->cartasBuzon->id)) }}"
                                                                            onclick="abrirModalCarta(this);">
                                                                            <i class="icon-statistics mr-2">
                                                                            </i>
                                                                            Ver carta
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="tab-pane fade"
                                                        id="messages-mon_{{ $buzonCarta->cartasBuzon->id . '' . $buzonCarta->id }}">
                                                        <div class="card">
                                                            <div class="card-body row">
                                                                @foreach ($buzonCarta->buzonCartaBoletasget($buzonCarta->cartasBuzon->id) as $boleta)
                                                                    <div class="col-sm-6 col-lg-4">
                                                                        <div class="card borde border-blue-800">
                                                                            <div class="card-img-actions m-1 text-center">
                                                                                <img alt="" class="" height=" 82"
                                                                                    src="{{ Storage::url('boletas/' . $boleta->boleta) }}"
                                                                                    width="82">
                                                                                <div
                                                                                    class="card-img-actions-overlay card-img">
                                                                                    <a class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2"
                                                                                        data-fancybox="" data-height="265"
                                                                                        data-width="348"
                                                                                        href="{{ Storage::url('boletas/' . $boleta->boleta) }}">
                                                                                        <i class="icon-plus3">
                                                                                        </i>
                                                                                    </a>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($buzonCarta->nombre == 'Contestación')
                                                        <div class="tab-pane fade"
                                                            id="messages-fri_{{ $buzonCarta->cartasBuzon->id . '' . $buzonCarta->id }}">
                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                <iframe allowfullscreen="" class="embed-responsive-item"
                                                                    src="{{ Storage::url('cartas/' . $buzonCarta->cartasBuzon->archivo) }}">
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
                    {{-- <div class="page-load-status text-center">
                <div class="infinite-scroll-request">
                    <img alt="Loading" src='{{asset("img/loader.gif")}}' style="width:200px"/>
                </div>
                <p class="infinite-scroll-error infinite-scroll-last text-center mt-4">
                    <span class="badge bg-danger-400 mr-2">
                        Son todos los registros
                    </span>
                </p>
            </div> --}}
                    {{-- fin del scrooll infinito --}}
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
    <div aria-hidden="true" aria-labelledby="documento" class="modal fade" id="documentoRegistro" role="dialog"
        tabindex="-1">
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
    {{-- Full width modal --}}
    <div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" id="vercartas" tabindex="-1">
        <div class="modal-dialog modal-full">
            <div class="modal-content contenedor border-top-info ">
                <div class="modal-header ">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="ml-4">
                            <div class="font-weight-semibold">
                                <h6 class="modal-title">
                                    Mensajes registrados
                                    <span id="nombreNinio">
                                    </span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body border mt-1">
                    <div class="row">
                        <div class="card-body">
                            <ul class="media-list mb-3" id="mensajes">
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-1 mr-4">
                    <button class="btn btn-default text-danger border borde-danger rounded-round" data-dismiss="modal"
                        type="button">
                        <i aria-hidden="true" class="fa fa-window-close text-danger">
                        </i>
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- /full width modal --}}
    @push('linksCabeza')
        <script charset="utf8" src="{{ asset('admin/plus/jscroll/jscroll.min.js') }}" type="text/javascript">
        </script>
        <script src="{{ asset('admin/plus/timelines/js/index.js') }}">
        </script>
        <script src="{{ asset('admin/plus/buttons/spin.min.js') }}">
        </script>
        <script src="{{ asset('admin/plus/buttons/ladda.min.js') }}">
        </script>
        <script src="{{ asset('admin/plus/buttons/components_buttons.js') }}">
        </script>
        <script charset="utf8" src="{{ asset('admin/plus/scrollreveal/scrollreveal.js') }}" type="text/javascript">
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
                    loadingHtml: '<img class="center-block" src="{{ asset('img/loader.gif') }}" alt="Loading..." />',

                    nextSelector: '.pagination li.active + li a',
                    contentSelector: 'div.infinite-scroll',
                    callback: function() {
                        $('ul.pagination').remove();
                    }
                });
            });
        </script>
        <script>
            function abrirModalCarta(arg) {
                $('#documentoRegistro').modal('show');
                $('#documentoRegistroPdf').attr('src', $(arg).data('url'));
                $("#modalBody").load($(arg).data('url'), function(responseTxt, statusTxt, xhr) {
                    $('#nombreCarta').html($(arg).data('nombrecrata'));
                });
            }

            $('#documentoRegistro').on('hidden.bs.modal', function(e) {
                $('#documentoRegistroPdf').attr('src', '')
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

            function verMensajes(arg) {
                $('#vercartas').modal('show');
                $('#mensajes').empty();
                var light = $('.modal-content').closest('.contenedor');
                $(light).block(configblock);
                var url = '/buscar-mensajes';
                var getIp = $(arg).data('idni');
                $.post(url, {
                        getIp: getIp
                    })
                    .done(function(d) {
                        if (d.noex == "noexi") {
                            alert('datos encontrados' + d.msj)
                        } else {
                            $.each(d.mensajes, function(i, item) {
                                var nn =
                                    '<li class="media content-divider justify-content-center text-muted mx-0">' + d
                                    .mensajes[i].fecha + '</li>' + '' +
                                    '<li class="media">' + '' +
                                    '<div class="mr-3">' + '' +
                                    '<a href="#">' + '' +
                                    '<img src="/admin/img/cactu.jpg" class="rounded-circle" width="40" height="40" alt="">' +
                                    '' +
                                    '</a>' + '' +
                                    '</div>' + '' +

                                    '<div class="media-body">' + '' +
                                    '<div class="media-chat-item">' + d.mensajes[i].mensaje + '</div>' + '' +
                                    //'<div class="font-size-sm text-muted mt-2">13 minutes ago <i class="icon-pin-alt ml-2 text-muted"></i></div>'+''+
                                    '</div>' + '' +
                                    '</li> '

                                $('#mensajes').append(nn);
                            })
                        }
                    }).always(function() {
                        $(light).unblock();

                    }).fail(function(error) {
                        notificar("error", "Ocurrio un error no puede mostrar los datos seleccionados datos incorrectos");
                        $('#vercartas').modal('hide');
                    });
            }
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
