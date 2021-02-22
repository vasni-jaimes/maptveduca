<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->

@section('css-content')
    <!-- Chosen -->
    {{-- <link href="/admini/css/bootstrap.min.css" rel="stylesheet"> --}}
@stop




@section('contenido')

    
    @if (session()->has("error"))

        <div class="shadow-favorito" id="shadow-eventok" style="display: block;">
            <div class="f-shadow">
                <div class="s-favorito">
                    <div class="close-shadow"></div> <!-- /close-shadow -->
                    <p>{{ session()->get("error") }}</p>
                    <ul>
                        <li><a href="#" class="ok_evento">OK</a></li>
                    </ul>
                </div> <!-- /s-favorito -->
            </div> <!-- /f-favorito -->
        </div> <!-- /shadow-favorito -->

    @elseif (session()->has("gracias"))

        <div class="shadow-favorito" id="shadow-eventok" style="display: block;">
            <div class="f-shadow">
                <div class="s-favorito">
                    <div class="close-shadow"></div> <!-- /close-shadow -->
                    <p>{{ session()->get("gracias") }}</p>
                    <ul>
                        <li><a href="#" class="ok_evento">OK</a></li>
                    </ul>
                </div> <!-- /s-favorito -->
            </div> <!-- /f-favorito -->
        </div> <!-- /shadow-favorito -->

    @endif


    <section class="single-curso">

        <div class="hoja-1000">
            
            <ul class="flex breadcrumb-curso">
                <li><a href="#">Evento</a></li>
                <li><a href="#"> {{ ($evento->tipo_evento_id == 1) ? "Clínica" : "Concierto - Masterclass básico" }} </a></li>
                <li><span>{{ $evento->nombre }}</span></li>
            </ul> <!-- /breadcrumb-curso -->
            
            <div class="wrapper-curso">
                <div class="flex">

                    <div class="sidebar-single">
                        
                        <div class="perfil-profesor">
                        
                            <div class="img-profesor" style="background-image: url({{ Storage::url($evento->instructor[0]->img) }});"></div>
                            
                            <div class="bio-profesor">
                                <p>{{ $evento->instructor[0]->nombres. " ".$evento->instructor[0]->apellidos }}</p>
                                <p>{{ $evento->instructor[0]->especialidad }}</p>
                                <p>{!! $evento->instructor[0]->bibliografia !!}</p>
                            </div> <!-- /bio-profesor -->
                            
                        </div> <!-- /row-perfil -->
                        
                    </div> <!-- /sidebar-single -->
                    
                    <div class="single-contenido">
                        
                        <div class="flex between flex-ponente">
                            
                            <div class="col-5">
                                <div class="row-ponente">
                                    <h3>{{ $evento->nombre }}</h3>
                                    @if ($evento->tipo_evento_id == 1)
                                        <p>Clínica</p>
                                    @else
                                        <p>Concierto - Masterclass básico</p>
                                    @endif
                                </div> <!-- /row-ponente -->
                            </div> <!-- /col-5 -->
                        
                            <div class="col-7">
                                <div class="row-video">
                                    <iframe src="{{ $evento->video_bienvenida }}" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                </div> <!-- /row-video -->
                            </div> <!-- /col-7 -->
                            
                        </div> <!-- /flex -->
                        
                        <div class="txt-single">
                            <div class="descripcion-single">
                                <p>{!! $evento->descripcion !!}</p>
                            </div> <!-- /descripcion-single -->
                        </div> <!-- /txt-single -->
                    
                        <div class="row-evento">
                            
                            @if ($evento->especial == 0)

                                <h3>Mira el evento aquí:</h3>

                                @if ( !$evento->isArchivado() )
                                    <p><span class="txt-yellow"> {{ $evento->FormatoLetras($evento->fecha_lanzamiento, 3) }} </span></p>
                                @endif

                                {{-- @if ( auth()->user()->tieneSuscripcion() && $evento->especial == 0 && $evento->isArchivado() == true) --}} 

                                @if ($estaEnMiTablero == true)
                                    <div class="row-video">
                                        <iframe src="{{ $evento->video_evento }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div> <!-- /row-video -->
                                @endif

                            @else

                                <h3>Mira el evento aquí:</h3>

                                @if ( !$evento->isArchivado() )
                                    <p><span class="txt-yellow"> {{ $evento->FormatoLetras($evento->fecha_lanzamiento, 3) }} </span></p>
                                @endif


                                {{-- @if ( auth()->user()->tieneSuscripcion() && $evento->especial == 1 && $evento->isArchivado() == true && $eventoPagado == true ) --}}
                                @if ( $eventoPagado == true )
                                    <div class="row-video">
                                        <iframe src="{{ $evento->video_evento }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div> <!-- /row-video -->
                                @endif

                            @endif


                            @if ($evento->isArchivado())

                                @if ($eventosRelacionados->count() >= 1)
                                    <h3>Explora más eventos:</h3>
                                
                                    <div class="item-evento">

                                        <p class="titulo"><span> {{ $evento->tipo_evento_id == 1 ? "Clínicas" : "Conciertos/Masterclass" }} </span></p>
                                        <ul>

                                            @foreach($eventosRelacionados as $eventoArch)
                                                <li class="col-3">
                                                    <img src="{{ Storage::url($eventoArch->img_evento) }}">
                                                    <div class="txt-clase">
                                                        <h4>{{ $eventoArch->nombre }}</h4>
                                                        <p>{{ $eventoArch->instructor[0]->nombres.' '.$eventoArch->instructor[0]->apellidos }}</p>
                                                        <span>{{ $eventoArch->FormatoLetras($eventoArch->fecha_lanzamiento, 0) }}</span>
                                                        {{-- <span>CLÍNICA BÁSICA</span> --}}
                                                    </div> <!-- /txt-clase -->
                                                </li>
                                            @endforeach
                                            
                                        </ul>
                                    </div> <!-- /item-slide -->
                                @endif
                            @endif

                        </div> <!-- /row-evento -->

                    </div> <!-- /single-contenido -->
                    
                    <div class="sidebar-registro">
                        {{-- @if ( $estaEnMiTablero == false && $evento->especial == 0 )
                            <div class="txt-sidebar">
                                <span><a href="#" class="registrarte_evento" data-crs="{{ $evento->slug }}">Regístrate</a></span>
                                <div>
                                    <p>Obtén tu membresía para registrarte a los cursos</p>
                                    <hr class="b-bottom">
                                    <p>Membresía básica $500.00 MXN mensuales*</p>
                                    <p><small>* Pruébala por 30 días</small></p>
                                    <a href="#">Obtener</a>
                                    <hr class="b-bottom">
                                    <p>Membresía académica</p>
                                    <p><small>$2,000.00 MXN mensuales*</small></p>
                                    <a href="{{ route('checkout', 'membresia-academica') }}">Obtener</a>
                                    <p><small>* Recuerda que esta membresía también te da  acceso a todos los cursos que no pertenecen a tu plan de estudios.</small></p>
                                </div>
                            </div>
                            @if (!$favorito)
                                <div class="flex flex-center favorito favevento" data-crs="{{ $evento->slug }}" data-seccion="evento">
                                    <img src="/site/img/estrella.png">
                                    <p>Marca este evento como favorito</p>
                                </div>
                            @endif --}}
                        
                  

                        @if ( $evento->especial == 1 && $eventoPagado == false )
                        
                            <div class="txt-sidebar">
                                {{-- <span><a href="#">Regístrate</a></span> --}}
                                <div>
                                    <p>Este es un evento especial, por lo que tiene un costo adicional a las membresías</p>
                                    <hr class="b-bottom">
                                    <p>${{ $evento->FormatPrecio($evento->precio) }} MXN (único pago)</p>
                                    <a href="{{ route('paago-evento', $evento->slug) }}">Pagar</a>
                                </div>
                            </div>
                            @if (!$favorito)
                                <div class="flex flex-center favorito favevento" data-crs="{{ $evento->slug }}" data-seccion="evento">
                                    <img src="/site/img/estrella.png">
                                    <p>Marca este evento como favorito</p>
                                </div>
                            @endif
                        
                            <br>

                        @else
                            <div class="txt-sidebar">
                                @if (!$estaEnMiTablero && $evento->especial == 0 )
                                    <span><a href="#" class="registrarte_evento" data-crs="{{ $evento->slug }}">Regístrate</a></span>
                                @else
                                    <div>
                                        <p>¡Estás listo para comenzar!</p>
                                        <p>Ahora podrás encontrar este evento en tu tablero personal para acceder rápidamente a él.</p>
                                        <p>¿Qué sigue?</p>
                                        <p>Vuelve a esta página en la fecha y hora indicada para ver en vivo.</p>
                                    </div>
                                @endif
                            </div>
                            @if (!$favorito)
                                <div class="flex flex-center favorito favevento" data-crs="{{ $evento->slug }}" data-seccion="evento">
                                    <img src="/site/img/estrella.png">
                                    <p>Marca este evento como favorito</p>
                                </div>
                            @endif

                        @endif
                        
                    </div> <!-- /sidebar-registro -->

                </div> <!-- /flex -->
            </div> <!-- /wrapper-curso -->
            
        </div> <!-- /hoja-1000 -->
        
    </section> <!-- /single-curso -->
    

    <!-- LOADING -->
    <div class="shadow-favorito" id="loading" style="z-index: 9999">
        <div class="f-shadow">
            <img src="/site/img/musica.gif" alt="loading" />
        </div> <!-- /f-favorito -->
    </div> <!-- /shadow-favorito -->

    <!-- exito -->
    <div class="shadow-favorito" id="shadow-exito">
        <div class="f-shadow">
            <div class="s-favorito">
                <div class="close-shadow"></div> <!-- /close-shadow -->
                <p>Se agrego a favoritos correctamente</p>
                <ul>
                    <li><a href="#" class="ok_favoritos-micuenta">OK</a></li>
                </ul>
            </div> <!-- /s-favorito -->
        </div> <!-- /f-favorito -->
    </div> <!-- /shadow-favorito -->

@stop

@section('js-content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="/site/js/app.js"></script>
@stop
