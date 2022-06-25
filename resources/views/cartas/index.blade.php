<!DOCTYPE html>
<html lang="es" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CACTU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('cartas/css/reset.css') }}" type="text/css">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('cartas/css/animations.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('cartas/css/perfect-scrollbar.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('cartas/css/owl.carousel.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('cartas/css/magnific-popup.css') }}" type="text/css">


    <link rel="stylesheet" href="{{ asset('cartas/css/modo.css') }}">

    <script>
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.id = 'modo'
        link.href = localStorage.getItem("selectedTheme") ||
            "{{ $ninio->genero == 'Male' ? asset('cartas/css/main.css') : asset('cartas/css/main-mujer.css') }}";
        document.head.appendChild(link);
    </script>

    <script src="{{ asset('cartas/js/modernizr.custom.js') }}"></script>
    {{-- https://lmpixels.com/demo/breezycv-html/ --}}
    <script src="{{ asset('cartas/js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/blockui.min.js') }}"></script>
    {{-- Lobibox.min --}}
    <link rel="stylesheet" href="{{ asset('admin/plus/Lobibox/css/lobibox.min.css') }}">
    <script src="{{ asset('admin/plus/Lobibox/js/lobibox.js') }}"></script>
    <script>
        Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
            sound: false,
            continueDelayOnInactiveTab: false,
            position: "bottom right",
            size: "mini"
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function notificar(tipo, mensaje) {
            Lobibox.notify(tipo, {
                title: "{{ config('app.name', 'CACTU') }}",
                msg: mensaje
            });
        }
    </script>
</head>

<body>

    <!-- Animated Background -->
    <div class="lm-animated-bg" style="background-image: url({{ asset('cartas/img/main_bg.png') }});"></div>
    <!-- /Animated Background -->

    <!-- Loading animation -->
    <div class="preloader">
        <div class="preloader-animation">
            <div class="preloader-spinner">
            </div>
        </div>
    </div>
    <!-- /Loading animation -->

    <div class="page">
        <div class="page-content">

            <header id="site_header" class="header mobile-menu-hide">
                <div class="header-content">

                    <div class="header-photo">
                        <img src="{{ $ninio->genero == 'Male' ? asset('cartas/img/hombre.png') : asset('cartas/img/mujer.png') }}"
                            alt="{{ $ninio->nombres }}">
                    </div>
                    <div class="header-titles">
                        <h2>{{ $ninio->nombres }}</h2>
                        <h4>
                            {{ $ninio->comunidad_model->nombre }}
                        </h4>
                        <div>

                            {{-- <span class="switch">
                        <label></label>
                        <input type="checkbox" class="switch" id="switch-id">
                        <label for="switch-id"></label>
                      </span> --}}

                            <div class="wrapper">
                                <div class="toggle">
                                    <input class="toggle-input" type="checkbox" id="switch-id" />
                                    <div class="toggle-bg"></div>
                                    <div class="toggle-switch">
                                        <div class="toggle-switch-figure"></div>
                                        <div class="toggle-switch-figureAlt"></div>
                                    </div>
                                </div>
                            </div>


                            <script>
                                $(function() {
                                    $("#switch-id").change(function() {

                                        if ($(this).is(":checked")) {
                                            localStorage.setItem("selectedTheme", "{{ asset('cartas/css/main-light.css') }}");
                                        } else {
                                            localStorage.setItem("selectedTheme",
                                                "{{ $ninio->genero == 'Male' ? asset('cartas/css/main.css') : asset('cartas/css/main-mujer.css') }}"
                                                );
                                        }
                                        $("#modo").attr("href", localStorage.getItem("selectedTheme"));

                                    });

                                    if (localStorage.getItem("selectedTheme") == "{{ asset('cartas/css/main-light.css') }}") {
                                        $('#switch-id').attr('checked', true)
                                    } else {
                                        $('#switch-id').attr('checked', false)
                                    }
                                });
                            </script>

                        </div>
                    </div>
                </div>

                <ul class="main-menu">
                    <li class="active">
                        <a href="#inicio" class="nav-anim">
                            <span class="menu-icon lnr lnr-home"></span>
                            <span class="link-text">Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="#mis-cartas" class="nav-anim">
                            <span class="menu-icon lnr lnr-envelope"></span>
                            <span class="link-text">Mis cartas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#chat" class="nav-anim">
                            <span class="menu-icon lnr lnr-bubble"></span>
                            <span class="link-text">Chat</span>
                        </a>
                    </li>
                    {{-- <li>
                  <a href="#portfolio" class="nav-anim">
                    <span class="menu-icon lnr lnr-briefcase"></span>
                    <span class="link-text">Portfolio</span>
                  </a>
                </li>
                <li>
                  <a href="#blog" class="nav-anim">
                    <span class="menu-icon lnr lnr-book"></span>
                    <span class="link-text">Blog</span>
                  </a>
                </li> --}}
                    <li>
                        <a href="#acerca" class="nav-anim">
                            <span class="menu-icon lnr lnr-question-circle"></span>
                            <span class="link-text">Acerca</span>
                        </a>
                    </li>
                </ul>

                <div class="copyrights">
                    <span>Diseñado y desarrollado por <a href="https://www.persontechnology.com/" class="text-light"
                            target="_blanck">Person Technology</a></span>
                    <br>© {{ date('Y') }} Todos los derechos reservados.
                </div>

            </header>

            <!-- Mobile Navigation -->
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <!-- End Mobile Navigation -->

            <!-- Arrows Nav -->
            <div class="lmpixels-arrows-nav">
                <div class="lmpixels-arrow-right"><i class="lnr lnr-chevron-right"></i></div>
                <div class="lmpixels-arrow-left"><i class="lnr lnr-chevron-left"></i></div>
            </div>
            <!-- End Arrows Nav -->

            <div class="content-area">
                <div class="animated-sections">

                    <!-- Home Subpage -->
                    <section data-id="inicio" class="animated-section start-page">
                        <div class="section-content vcentered">

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">

                                    <div class="title-block">
                                        <h2>BIENVENIDO</h2>
                                        <div class="owl-carousel text-rotation">
                                            <div class="item">
                                                <div class="sp-subtitle">{{ $ninio->nombres }}</div>
                                            </div>

                                            <div class="item">
                                                <div class="sp-subtitle">a, CACTU</div>
                                            </div>

                                        </div>
                                        <span class="text-primary">Con tu aporte damos valor al futuro de miles de
                                            niñas y niños.</span>
                                        <br>
                                        <a href="{{ asset('cartas/img/cactu-cartas-manual-web.mp4') }}"
                                            target="_blanck" class="btn btn-primary">Ver manual</a>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                    <!-- End of Home Subpage -->

                    <!-- Mis cartas -->
                    <section data-id="mis-cartas" class="animated-section">
                        <div class="section-content" id="ListadoMisCartas">
                            <div class="page-title">
                                <h2>Mis <span>cartas</span></h2>

                            </div>
                            @if ($buzones->count() > 0)
                                <div class="row">
                                    <div class=" col-xs-12 col-sm-12 ">
                                        <div class="fw-pricing clearfix row">



                                            @foreach ($buzones as $buzon)
                                                <div class="fw-package-wrap col-md-6 highlight-col">
                                                    <div class="fw-package">
                                                        <p>
                                                            <span
                                                                class="lnr lnr-envelope"></span><strong><sup>{{ $buzon->buzonCartasNinio->count() }}</sup></strong>
                                                            <small>del:</small>
                                                            <strong>{{ \Carbon\Carbon::parse($buzon->fecha)->format('M/d/Y') }}</strong>
                                                            <small>sin contestar</small>
                                                        </p>

                                                        <div class="fw-button-row">
                                                            @foreach ($buzon->buzonCartasNinio as $carta)
                                                                <button role="link"
                                                                    onclick="cargarPagina('{{ route('misCartasRespuestas', [Crypt::encryptString($carta->cartasBuzon->id), Crypt::encryptString($buzon->ninio->token)]) }}')"
                                                                    type="button" class="btn btn-secondary">
                                                                    {{ $carta->nombre }}
                                                                </button><br>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-primary" role="alert">
                                    <strong>No tiene cartas por el momento!</strong>
                                </div>

                            @endif
                        </div>
                        <div class="section-content" id="paginaRespuestaCarta"></div>

                    </section>
                    <!-- End of cartas Me Subpage -->

                    <!-- chat Subpage -->
                    <section data-id="chat" class="animated-section">
                        <div class="page-title">
                            <h2>Chat</h2>
                        </div>
                        <div class="section-content">
                            <p>¿ <strong>{{ $ninio->nombres }},</strong> tienes inquietudes ?? <br>
                                Dejanos un mensaje, tu gestor te ayudará con gusto.</p>
                            <form id="envioDeMensajes" method="POST" action="{{ route('guardarMensajeNinio') }}">
                                @csrf
                                <input type="hidden" name="getIp" id="getIp" value="{{ $ninio->token }}">

                                <div class="mb-2">
                                    <label for="mensaje">Mensaje</label>
                                    <textarea class="form-control" name="mensaje" id="mensaje" required rows="3"></textarea>

                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-2 dosdu"><i
                                            class="fas fa-paper-plane mr-2"></i> Enviar</button>
                                </div>
                            </form>
                        </div>
                    </section>
                    <!-- End of chat Subpage -->

                    <!-- Portfolio Subpage -->
                    {{-- <section data-id="portfolio" class="animated-section">
                  <div class="page-title">
                    <h2>Portfolio</h2>
                  </div>

                  <div class="section-content">

                    <div class="row">
                      <div class="col-xs-12 col-sm-12">
                        <!-- Portfolio Content -->
                        <div class="portfolio-content">

                          <ul class="portfolio-filters">
                            <li class="active">
                              <a class="filter btn btn-sm btn-link" data-group="category_all">All</a>
                            </li>
                            <li>
                              <a class="filter btn btn-sm btn-link" data-group="category_detailed">Detailed</a>
                            </li>
                            <li>
                              <a class="filter btn btn-sm btn-link" data-group="category_mockups">Mockups</a>
                            </li>
                            <li>
                              <a class="filter btn btn-sm btn-link" data-group="category_soundcloud">SoundCloud</a>
                            </li>
                            <li>
                              <a class="filter btn btn-sm btn-link" data-group="category_vimeo-videos">Vimeo Videos</a>
                            </li>
                            <li>
                              <a class="filter btn btn-sm btn-link" data-group="category_youtube-videos">YouTube Videos</a>
                            </li>
                          </ul>

                          <!-- Portfolio Grid -->
                          <div class="portfolio-grid three-columns">
                            
                            <figure class="item lbaudio" data-groups='["category_all", "category_soundcloud"]'>
                              <div class="portfolio-item-img">
                                <img src="img/portfolio/1.jpg" alt="SoundCloud Audio" title="" />
                                <a href="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/221650664&#038;color=%23ff5500&#038;auto_play=false&#038;hide_related=false&#038;show_comments=true&#038;show_user=true&#038;show_reposts=false&#038;show_teaser=true&#038;visual=true" class="lightbox mfp-iframe" title="SoundCloud Audio"></a>
                              </div>

                              <i class="fa fa-volume-up"></i>
                              <h4 class="name">SoundCloud Audio</h4>
                              <span class="category">SoundCloud</span>
                            </figure>

                            <figure class="item standard" data-groups='["category_all", "category_detailed"]'>
                              <div class="portfolio-item-img">
                                <img src="img/portfolio/2.jpg" alt="Media Project 2" title="" />
                                <a href="portfolio-1.html" class="ajax-page-load"></a>
                              </div>

                              <i class="far fa-file-alt"></i>
                              <h4 class="name">Detailed Project 2</h4>
                              <span class="category">Detailed</span>
                            </figure>

                            <figure class="item lbvideo" data-groups='["category_all", "category_vimeo-videos"]'>
                              <div class="portfolio-item-img">
                                <img src="img/portfolio/3.jpg" alt="Vimeo Video 1" title="" />
                                <a href="https://player.vimeo.com/video/158284739" class="lightbox mfp-iframe" title="Vimeo Video 1"></a>
                              </div>

                              <i class="fas fa-video"></i>
                              <h4 class="name">Vimeo Video 1</h4>
                              <span class="category">Vimeo Videos</span>
                            </figure>

                            <figure class="item standard" data-groups='["category_all", "category_detailed"]'>
                              <div class="portfolio-item-img">
                                <img src="img/portfolio/4.jpg" alt="Media Project 1" title="" />
                                <a href="portfolio-1.html" class="ajax-page-load"></a>
                              </div>

                              <i class="far fa-file-alt"></i>
                              <h4 class="name">Detailed Project 1</h4>
                              <span class="category">Detailed</span>
                            </figure>

                            <figure class="item lbimage" data-groups='["category_all", "category_mockups"]'>
                              <div class="portfolio-item-img">
                                <img src="img/portfolio/5.jpg" alt="Mockup Design 1" title="" />
                                <a class="lightbox" title="Mockup Design 1" href="img/portfolio/full/5.jpg"></a>
                              </div>

                              <i class="far fa-image"></i>
                              <h4 class="name">Mockup Design 1</h4>
                              <span class="category">Mockups</span>
                            </figure>

                            <figure class="item lbvideo" data-groups='["category_all", "category_youtube-videos"]'>
                              <div class="portfolio-item-img">
                                <img src="img/portfolio/6.jpg" alt="YouTube Video 1" title="" />
                                <a href="https://www.youtube.com/embed/bg0gv2YpIok" class="lightbox mfp-iframe" title="YouTube Video 1"></a>
                              </div>

                              <i class="fas fa-video"></i>
                              <h4 class="name">YouTube Video 1</h4>
                              <span class="category">YouTube Videos</span>
                            </figure>
                          </div>
                        </div>
                        <!-- End of Portfolio Content -->
                      </div>
                    </div>
                  </div>
                </section> --}}
                    <!-- End of Portfolio Subpage -->

                    <!-- Blog Subpage -->
                    {{-- <section data-id="blog" class="animated-section">
                  <div class="page-title">
                    <h2>Blog</h2>
                  </div>

                  <div class="section-content">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12">
                        <div class="blog-masonry two-columns clearfix">
                          
                          <!-- Blog Post 1 -->
                          <div class="item post-1">
                            <div class="blog-card">
                              <div class="media-block">
                                <div class="category">
                                  <a href="#" title="View all posts in Design">Design</a>
                                </div>
                                <a href="blog-post-1.html">
                                  <img src="img/blog/blog_post_1.jpg" class="size-blog-masonry-image-two-c" alt="Why I Switched to Sketch For UI Design" title="" />
                                  <div class="mask"></div>
                                </a>
                              </div>
                              <div class="post-info">
                                <div class="post-date">05 Mar 2020</div>
                                <a href="blog-post-1.html">
                                  <h4 class="blog-item-title">Why I Switched to Sketch For UI Design</h4>
                                </a>
                              </div>
                            </div>
                          </div>
                          <!-- End of Blog Post 1 -->

                          <!-- Blog Post 2 -->
                          <div class="item post-2">
                            <div class="blog-card">
                              <div class="media-block">
                                <div class="category">
                                  <a href="#" title="View all posts in UI">UI</a>
                                </div>
                                <a href="blog-post-1.html">
                                  <img src="img/blog/blog_post_2.jpg" class="size-blog-masonry-image-two-c" alt="Best Practices for Animated Progress Indicators" title="" />
                                  <div class="mask"></div>
                                </a>
                              </div>
                              <div class="post-info">
                                <div class="post-date">23 Feb 2020</div>
                                <a href="blog-post-1.html">
                                  <h4 class="blog-item-title">Best Practices for Animated Progress Indicators</h4>
                                </a>
                              </div>
                            </div>
                          </div>
                          <!-- End of Blog Post 2 -->

                          <!-- Blog Post 3 -->
                          <div class="item post-1">
                            <div class="blog-card">
                              <div class="media-block">
                                <div class="category">
                                  <a href="#" title="View all posts in Design">Design</a>
                                </div>
                                <a href="blog-post-1.html">
                                  <img src="img/blog/blog_post_3.jpg" class="size-blog-masonry-image-two-c" alt="Designing the Perfect Feature Comparison Table" title="" />
                                  <div class="mask"></div>
                                </a>
                              </div>
                              <div class="post-info">
                                <div class="post-date">06 Feb 2020</div>
                                <a href="blog-post-1.html">
                                  <h4 class="blog-item-title">Designing the Perfect Feature Comparison Table</h4>
                                </a>
                              </div>
                            </div>
                          </div>
                          <!-- End of Blog Post 3 -->

                          <!-- Blog Post 4 -->
                          <div class="item post-2">
                            <div class="blog-card">
                              <div class="media-block">
                                <div class="category">
                                  <a href="#" title="View all posts in E-Commerce">UI</a>
                                </div>
                                <a href="blog-post-1.html">
                                  <img src="img/blog/blog_post_4.jpg" class="size-blog-masonry-image-two-c" alt="An Overview of E-Commerce Platforms" title="" />
                                  <div class="mask"></div>
                                </a>
                              </div>
                              <div class="post-info">
                                <div class="post-date">07 Jan 2020</div>
                                <a href="blog-post-1.html">
                                  <h4 class="blog-item-title">An Overview of E-Commerce Platforms</h4>
                                </a>
                              </div>
                            </div>
                          </div>
                          <!-- End of Blog Post 4 -->
                        </div>
                      </div>
                    </div>
                  </div>


                </section> --}}
                    <!-- End of Blog Subpage -->

                    <!-- acerca Subpage -->
                    <section data-id="acerca" class="animated-section">
                        <div class="page-title">
                            <h2>Acerca de <span>CACTU</span></h2>
                        </div>

                        <div class="section-content">

                            <div class="row">
                                <!-- Contact Form -->
                                <div class="col-xs-12 col-sm-8">
                                    <div>
                                        <img src="{{ asset('/img/logo_chil.png') }}" class="img-fluid" alt="">
                                        <p><strong>CHILDFUND</strong>, Trabajamos para que niñas, niños y adolescentes
                                            logren un desarrollo integral en espacios seguros y sin violencia.
                                            Impactamos positivamente su vida y su entorno.</p>
                                    </div>
                                    <div>
                                        <img src="{{ asset('img/cactu-logo.jpeg') }}" class="img-fluid" alt="">
                                        <p> <strong>CACTU</strong>, es una organización comunitaria que aporta por un
                                            futuro mejor , porque en ese lugar es donde vamos a vivir ...</p>
                                    </div>

                                    <small><i>Versión del sistema: (<strong>0.1</strong>)</i></small>
                                </div>
                                <!-- End of Contact Form -->
                                <!-- Contact Info -->
                                <div class="col-xs-12 col-sm-4">
                                    <div class="lm-info-block gray-default">
                                        <i class="lnr lnr-map-marker"></i>
                                        <h4>Ecuador,Cotopaxi,Latacunga</h4>
                                        <span class="lm-info-block-value"></span>
                                        <span class="lm-info-block-text"></span>
                                    </div>

                                    <div class="lm-info-block gray-default">
                                        <i class="lnr lnr-phone-handset"></i>
                                        <h4>(03) 241-2491</h4>
                                        <span class="lm-info-block-value"></span>
                                        <span class="lm-info-block-text"></span>
                                    </div>

                                    <div class="lm-info-block gray-default">
                                        <i class="lnr lnr-envelope"></i>
                                        <h4>info@cactu.org.ec</h4>
                                        <span class="lm-info-block-value"></span>
                                        <span class="lm-info-block-text"></span>
                                    </div>

                                </div>
                                <!-- End of Contact Info -->


                            </div>

                        </div>
                    </section>
                    <!-- End of acerca Subpage -->

                </div>
            </div>

        </div>
    </div>


    <script src="{{ asset('cartas/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('cartas/js/animating.js') }}"></script>
    <script src="{{ asset('cartas/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('cartas/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('cartas/js/jquery.shuffle.min.js') }}"></script>
    <script src="{{ asset('cartas/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('cartas/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('cartas/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('cartas/js/main.js') }}"></script>
    <script>
        function cargarPagina(arg) {
            $.blockUI({
                message: '  <i class="fas fa-circle-notch fa-spin fa-3x text-primary"></i>'
            });
            $("#ListadoMisCartas").hide();
            $('#paginaRespuestaCarta').load(arg, function(responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    console.log("success")
                } else {
                    console.log("Error: " + xhr.status + ": " + xhr.statusText)
                }
                $.unblockUI();
            });
        }

        function regresar() {
            $("#ListadoMisCartas").show();
            $('#paginaRespuestaCarta').html('');
        }

        $("#envioDeMensajes").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {
                    if (data.success) {
                        notificar('success', data.success);

                    } else {
                        notificar('info', data.info)
                    }
                    $('#mensaje').val('')
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    errorsHtml = '';
                    $.each(errors.errors, function(k, v) {
                        errorsHtml += v;
                    });
                    notificar('info', errorsHtml)
                },
                complete: function(jqXHR, status) {
                    $.unblockUI();
                }
            });
        });
    </script>
</body>

</html>
