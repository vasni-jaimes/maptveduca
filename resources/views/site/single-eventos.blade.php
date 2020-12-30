<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

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
                                <p>{{ $evento->instructor[0]->bibliografia }}</p>
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
                                <p>{{ $evento->descripcion }}</p>
                            </div> <!-- /descripcion-single -->
                        </div> <!-- /txt-single -->
                    
                        <div class="row-evento">
                            
                            @if ( auth()->user()->tieneSuscripcion() && $evento->especial == 0 && $evento->isArchivado() == true)
                                <h3>Mira el evento aquí:</h3>
                            @endif

                            @if ( !$evento->isArchivado() )
                                <p><span class="txt-yellow"> {{ $evento->FormatoLetras($evento->fecha_lanzamiento, 3) }} </span></p>
                            @endif


                            @if ( auth()->user()->tieneSuscripcion() && $evento->especial == 0 && $evento->isArchivado() == true)
                                <div class="row-video">
                                    <iframe src="{{ $evento->video_evento }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div> <!-- /row-video -->
                            @endif


                            @if ( auth()->user()->tieneSuscripcion() && $evento->especial == 1 && $evento->isArchivado() == true && $eventoPagado == true )
                                <h3>Mira el evento aquí:</h3>
                            @endif

                            @if ( auth()->user()->tieneSuscripcion() && $evento->especial == 1 && $evento->isArchivado() == true && $eventoPagado == true )
                                <div class="row-video">
                                    <iframe src="{{ $evento->video_evento }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div> <!-- /row-video -->
                            @endif

                        </div> <!-- /row-evento -->

                    </div> <!-- /single-contenido -->
                    
                    <div class="sidebar-registro">
                        @if ( !auth()->user()->tieneSuscripcion() )
                            <div class="txt-sidebar">
                                {{-- <span><a href="#">Regístrate</a></span> --}}
                                <div>
                                    <p>Obtén tu membresía para registrarte a esta clase</p>
                                    <hr class="b-bottom">
                                    <p>Membresía básica $500.00 MXN mensuales*</p>
                                    <p><small>* Pruébala por 30 días</small></p>
                                    <a href="#">Obtener</a>
                                    <hr class="b-bottom">
                                    <p>Membresía académica</p>
                                    <p><small>$2,000.00 MXN mensuales*</small></p>
                                    <p><small>Este curso pertenece al plan de estudios del programa: Técnico en Producción Musical</small></p>
                                    <a href="#">Obtener</a>
                                    <p><small>* Recuerda que esta membresía también te da  acceso a todos los cursos que no pertenecen a tu plan de estudios.</small></p>
                                </div>
                            </div>
                            @if (!$favorito)
                                <div class="flex flex-center favorito favevento" data-crs="{{ $evento->slug }}" data-seccion="evento">
                                    <img src="/site/img/estrella.png">
                                    <p>Marca este evento como favorito</p>
                                </div>
                            @endif
                        
                        <br>

                        @elseif ( auth()->user()->tieneSuscripcion() && $evento->especial == 1 )
                        
                            <div class="txt-sidebar">
                                <span><a href="#">Regístrate</a></span>
                                <div>
                                    <p>Este es un evento especial, por lo que tiene un costo adicional a las membresías</p>
                                    <hr class="b-bottom">
                                    <p>$50.00 MXN (único pago)</p>
                                    <a href="#">Pagar</a>
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
                                @if (!$estaEnMiTablero)
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

@stop

@section('js-content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="/site/js/app.js"></script>
@stop
