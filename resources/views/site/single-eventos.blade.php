<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="single-curso">

        <div class="hoja-1400">
            
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
                                    <iframe src="https://www.youtube.com/embed/CBZyA-Pj52U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div> <!-- /row-video -->
                            </div> <!-- /col-7 -->
                            
                        </div> <!-- /flex -->
                        
                        <div class="txt-single">
                            <div class="descripcion-single">
                                <p>{{ $evento->descripcion }}</p>
                            </div> <!-- /descripcion-single -->
                        </div> <!-- /txt-single -->
                    
                        <div class="row-evento">
            
                            <h3>Mira el evento aquí:</h3>
                            
                            <p><span class="txt-yellow">LUNES · A PARTIR DEL 00 DE JUNIO AL 00 DE JULIO, 2020 · 18:00 HRS (Hora Cd. de México) | 4 sesiones de 90 minutos</span></p>
                            
                            <div class="row-video">
                                <iframe src="{{ $evento->video_bienvenida }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div> <!-- /row-video -->

                        </div> <!-- /row-evento -->

                    </div> <!-- /single-contenido -->
                    
                    <div class="sidebar-registro">
                        <span><a href="#">Regístrate</a></span>
                        <div class="favorito">
                            <p>Marca este curso como favorito</p>
                        </div> <!-- /favorito -->
                    </div> <!-- /sidebar-registro -->

                </div> <!-- /flex -->
            </div> <!-- /wrapper-curso -->
            
        </div> <!-- /hoja-1400 -->
    </section> <!-- /single-curso -->

@stop