<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="eventos">

        <div class="banner-eventos"></div> <!-- /banner-cursos -->
        
        <div class="titulo-banner">
            <h1>Eventos</h1>
        </div> <!-- /titulo-banner -->
        
        <div class="hoja-1000">

            <div class="wrapper-columnas">
            
                <div class="row-columnas">

                    <div class="flex between">

                        <div class="col-6">
                            <p>No te pierdas a los artistas y profesionales de la industria musical latinoamericana compartiendo lo que mejor saben hacer.</p>
                            <p>Aprende en las clínicas o disfruta un concierto mientras obtienes valioso conocimiento.</p>
                            <p>¡Estas sesiones sólo suceden una vez! Regístrate si quieres verlas en vivo o vuelve a vivirlas buscando en la biblioteca.</p>
                            <p>Recuerda que los eventos en vivo especiales tienen un costo extra. Los eventos básicos están incluidos en la membresía básica y académica.</p>
                        </div> <!-- /col-6 -->

                        <div class="col-6">
                            <div class="row-video">
                                <iframe src="https://www.youtube.com/embed/CBZyA-Pj52U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div> <!-- /row-video -->
                        </div> <!-- /col-6 -->

                    </div> <!-- /flex -->

                </div> <!-- /row-columnas -->
                
            </div> <!-- /wrapper-columnas -->
            
            <div class="row-clases">
            
                <h3>¿Cómo puedo ser parte de un evento?</h3>
                
                <p>Da click en un evento próximo y regístrate. El evento se agregará a tu tablero personal.</p>
                <p>En el día y la hora indicados, ingresa de nuevo al evento y ¡disfrútalo!</p>
                
            </div> <!-- /row-clases -->
            
            @if ($eventos->where("tipo_evento_id", 1)->count() > 0)
                <div class="wrapper-clases">
                
                    <h3>Clínicas</h3>
                    
                    <ul class="flex between wrap">

                        @foreach($eventos as $evento)
                            @if ($evento->tipo_evento_id == 1)
                                <li class="col-3">
                                    <a href="{{ route("evento.show", $evento->slug) }}">
                                        <img src="{{ Storage::url($evento->img_evento) }}">
                                        <div class="txt-clase">
                                            <h4>{{ $evento->nombre }}</h4>
                                            <p>PONENTE</p>
                                            <span> {{ $evento->FormatoLetras($evento->fecha_lanzamiento, 1) }} </span>
                                            <span>CLÍNICA BÁSICA</span>
                                        </div> <!-- /txt-clase -->
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        {{-- <li class="col-3">
                            <img src="/site/img/fulano.jpg">
                            <div class="txt-clase">
                                <h4>CLÍNICA 1</h4>
                                <p>PONENTE</p>
                                <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                <span>CLÍNICA BÁSICA</span>
                            </div> <!-- /txt-clase -->
                        </li>
                        <li class="col-3">
                            <img src="/site/img/fulano.jpg">
                            <div class="txt-clase">
                                <h4>CLÍNICA 1</h4>
                                <p>PONENTE</p>
                                <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                <span>CLÍNICA BÁSICA</span>
                            </div> <!-- /txt-clase -->
                        </li>
                        <li class="col-3">
                            <img src="/site/img/fulano.jpg">
                            <div class="txt-clase">
                                <h4>CLÍNICA 1</h4>
                                <p>PONENTE</p>
                                <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                <span>CLÍNICA BÁSICA</span>
                            </div> <!-- /txt-clase -->
                        </li>
                        <li class="col-3">
                            <img src="/site/img/fulano.jpg">
                            <div class="txt-clase">
                                <h4>CLÍNICA 1</h4>
                                <p>PONENTE</p>
                                <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                <span>CLÍNICA BÁSICA</span>
                            </div> <!-- /txt-clase -->
                        </li> --}}
                    </ul> <!-- /flex -->
                </div> <!-- /wrapper-clases -->
            @endif
            
            @if ($eventos->where("tipo_evento_id", 2)->count() > 0)
                <div class="wrapper-clases">
                
                    <h3>Conciertos/Masterclass</h3>
                    
                    <ul class="flex between wrap">

                        @foreach($eventos as $evento)
                            @if ($evento->tipo_evento_id == 2)
                                <li class="col-3">
                                    <a href="{{ route("evento.show", $evento->slug) }}">
                                        <img src="{{ Storage::url($evento->img_evento) }}">
                                        <div class="txt-clase">
                                            <h4>{{ $evento->nombre }}</h4>
                                            <p>PONENTE</p>
                                            <span> {{ $evento->FormatoLetras($evento->fecha_lanzamiento, 1) }} </span>
                                            <span>CLÍNICA BÁSICA</span>
                                        </div> <!-- /txt-clase -->
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        {{-- <li class="col-3">
                            <img src="/site/img/fulano.jpg">
                            <div class="txt-clase">
                                <h4>CONCIERTO / MASTERCLASS</h4>
                                <p>PONENTE</p>
                                <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                <span>CLÍNICA BÁSICA</span>
                            </div> <!-- /txt-clase -->
                        </li>
                        <li class="col-3">
                            <img src="/site/img/fulano.jpg">
                            <div class="txt-clase">
                                <h4>CONCIERTO / MASTERCLASS</h4>
                                <p>PONENTE</p>
                                <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                <span>CLÍNICA BÁSICA</span>
                            </div> <!-- /txt-clase -->
                        </li>
                        <li class="col-3">
                            <img src="/site/img/fulano.jpg">
                            <div class="txt-clase">
                                <h4>CONCIERTO / MASTERCLASS</h4>
                                <p>PONENTE</p>
                                <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                <span>CLÍNICA BÁSICA</span>
                            </div> <!-- /txt-clase -->
                        </li>
                        <li class="col-3">
                            <img src="/site/img/fulano.jpg">
                            <div class="txt-clase">
                                <h4>CONCIERTO / MASTERCLASS</h4>
                                <p>PONENTE</p>
                                <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                <span>CLÍNICA BÁSICA</span>
                            </div> <!-- /txt-clase -->
                        </li> --}}
                    </ul> <!-- /flex -->
                </div> <!-- /wrapper-clases -->
            @endif
            

            @if ($archivados->count() > 0)
                <div class="wrapper-biblioteca">
                    
                    <h3>Biblioteca</h3>
                    
                    @if ($archivados->where("tipo_evento_id", 1)->count() > 0)
                        <div class="bloque-slide">
                            <div class="item-slide">
                                <p class="titulo"><span>CLÍNICAS</span></p>
                                <ul>
                                    @foreach($archivados->where("tipo_evento_id", 1) as $archivado)
                                        <li class="col-3">
                                            <img src="{{ Storage::url($archivado->img_evento) }}">
                                            <div class="txt-clase">
                                                <h4>{{ $archivado->nombre }}</h4>
                                                <p>PONENTE</p>
                                                <span> {{ $archivado->FormatoLetras($archivado->fecha_lanzamiento, 1) }} </span>
                                                <span>CLÍNICA BÁSICA</span>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                    @endforeach
                                </ul>
                            </div> <!-- /item-slide -->
                        </div> <!-- /bloque-slide -->
                    @endif
                    
                    @if ($archivados->where("tipo_evento_id", 2)->count() > 0)
                        <div class="bloque-slide">
                            <div class="item-slide">
                                <p class="titulo"><span>CONCIERTOS/M.CLASS</span></p>
                                <ul>
                                    @foreach($archivados->where("tipo_evento_id", 2) as $archivado)
                                        <li class="col-3">
                                            <img src="{{ Storage::url($archivado->img_evento) }}">
                                            <div class="txt-clase">
                                                <h4>{{ $archivado->nombre }}</h4>
                                                <p>PONENTE</p>
                                                <span> {{ $archivado->FormatoLetras($archivado->fecha_lanzamiento, 1) }} </span>
                                                <span>CLÍNICA BÁSICA</span>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                    @endforeach
                                    {{-- <li class="col-3">
                                        <img src="/site/img/fulano.jpg">
                                        <div class="txt-clase">
                                            <h4>CONCIERTO / MASTERCLASS</h4>
                                            <p>PONENTE</p>
                                            <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                            <span>CLÍNICA BÁSICA</span>
                                        </div> <!-- /txt-clase -->
                                    </li>
                                    <li class="col-3">
                                        <img src="/site/img/fulano.jpg">
                                        <div class="txt-clase">
                                            <h4>CONCIERTO / MASTERCLASS</h4>
                                            <p>PONENTE</p>
                                            <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                            <span>CLÍNICA BÁSICA</span>
                                        </div> <!-- /txt-clase -->
                                    </li>
                                    <li class="col-3">
                                        <img src="/site/img/fulano.jpg">
                                        <div class="txt-clase">
                                            <h4>CONCIERTO / MASTERCLASS</h4>
                                            <p>PONENTE</p>
                                            <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                            <span>CLÍNICA BÁSICA</span>
                                        </div> <!-- /txt-clase -->
                                    </li>
                                    <li class="col-3">
                                        <img src="/site/img/fulano.jpg">
                                        <div class="txt-clase">
                                            <h4>CONCIERTO / MASTERCLASS</h4>
                                            <p>PONENTE</p>
                                            <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                            <span>CLÍNICA BÁSICA</span>
                                        </div> <!-- /txt-clase -->
                                    </li>
                                    <li class="col-3">
                                        <img src="/site/img/fulano.jpg">
                                        <div class="txt-clase">
                                            <h4>CONCIERTO / MASTERCLASS</h4>
                                            <p>PONENTE</p>
                                            <span>LUNES · 00 JUNIO  · 18:00 HRS</span>
                                            <span>CLÍNICA BÁSICA</span>
                                        </div> <!-- /txt-clase -->
                                    </li> --}}
                                </ul>
                            </div> <!-- /item-slide -->
                        </div> <!-- /bloque-slide -->
                    @endif
                </div> <!-- /wrapper-biblioteca -->
            @endif

        </div> <!-- /hoja-1000 -->
        
    </section> <!-- /membresia -->

@stop