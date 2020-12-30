<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="membresia">

        <div class="banner-clases"></div> <!-- /banner-cursos -->
        
        <div class="titulo-banner">
            <h1>Clases en línea</h1>
        </div> <!-- /titulo-banner -->
        
        <div class="hoja-1000">

            <div class="wrapper-columnas">
            
                <div class="row-columnas">

                    <div class="flex between">

                        <div class="col-6">
                            <p>¡Queremos verte! Aprende e interactúa en vivo con tus profesores favoritos en las clases en línea de MAPtv Educa.</p>
                            <p>Las clases en línea son de corta duración y, debido a que estarás teniendo una sesión en vivo con tu profesor(a), se establecen de acuerdo a un calendario.</p>
                            <p>Estas clases son un servicio adicional de MAPtv Educa, por lo que tienen un costo adicional no importando la membresía.</p>
                            <p>¡Mira la oferta de clases en línea y regístrate!</p>
                        </div> <!-- /col-6 -->

                        <div class="col-6">
                            <div class="row-video">
                                <iframe src="https://www.youtube.com/embed/CBZyA-Pj52U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div> <!-- /row-video -->
                        </div> <!-- /col-6 -->

                    </div> <!-- /flex -->

                </div> <!-- /row-columnas -->
                
            </div> <!-- /wrapper-columnas -->
            
            @if ( $clases->where("category_id", 1)->count() )
                <div class="wrapper-clases">
                
                    <h3>Producción musical</h3>
                    
                    <ul class="flex between wrap">

                        @foreach($clases as $clase)
                            @if ($clase->category_id == 1)
                                <li class="col-3">
                                    <a href="{{ route("clases-single.show", $clase->slug) }}">
                                        <img src="{{Storage::url($clase->img) }}">
                                        <div class="txt-clase">
                                            <h4>{{ $clase->nombre_clase }}</h4>
                                            <p>
                                                @foreach($clase->instructor as $instructor)
                                                    {{ $instructor->nombres." ".$instructor->apellidos }} <br>
                                                @endforeach 
                                            </p>
                                            <span> 
                                                {{ $clase->FormatoLetras( $clase->sesiones[0]->fecha_inicio, 1 ) . " AL ". 
                                                    $clase->FormatoLetras( $clase->sesiones[ $clase->sesiones->count() - 1 ]->fecha_inicio, 2 ). " ".
                                                    $clase->FormatoTiempo( $clase->sesiones[0]->fecha_inicio ). "HRS" }} 
                                            </span>
                                            {{-- <span>LUNES · 00 JUNIO AL 00 JULIO · 18:00 HRS</span> --}}
                                        </div> <!-- /txt-clase -->
                                    </a>
                                </li>
                            @endif
                        @endforeach

                    </ul> <!-- /flex -->
                    
                </div> <!-- /wrapper-clases -->
            @endif


            @if ( $clases->where("category_id", 2)->count() )
            
                <div class="wrapper-clases">
                
                    <h3>Música</h3>
                    
                    <ul class="flex between wrap">
                        
                        @foreach($clases as $clase)
                            @if ($clase->category_id == 2)
                                <li class="col-3">
                                    <a href="{{ route("clases-single.show", $clase->slug) }}">
                                        <img src="{{Storage::url($clase->img) }}">
                                        <div class="txt-clase">
                                            <h4>{{ $clase->nombre_clase }}</h4>
                                            <p>
                                                @foreach($clase->instructor as $instructor)
                                                    {{ $instructor->nombres." ".$instructor->apellidos }} <br>
                                                @endforeach 
                                            </p>
                                            <span> 
                                                {{ $clase->FormatoLetras( $clase->sesiones[0]->fecha_inicio, 1 ) . " AL ". 
                                                    $clase->FormatoLetras( $clase->sesiones[ $clase->sesiones->count() - 1 ]->fecha_inicio, 2 ). " ".
                                                    $clase->FormatoTiempo( $clase->sesiones[0]->fecha_inicio ). "HRS" }} 
                                            </span>
                                            {{-- <span>LUNES · 00 JUNIO AL 00 JULIO · 18:00 HRS</span> --}}
                                        </div> <!-- /txt-clase -->
                                    </a>
                                </li>
                            @endif
                        @endforeach                        

                    </ul> <!-- /flex -->
                    
                </div> <!-- /wrapper-clases -->

            @endif
            
            <div class="row-clases">
                
                <div class="hoja-700">
            
                    <h3>¿Cómo se imparten las clases en línea?</h3>

                    <p>Las clases en línea se imparten a través de la plataforma Zoom.</p>
                    <p>Una vez que te registres a una clase recibirás en tu correo la información para accesar en la fecha y hora indicadas.</p>
                    <a class="btn-zoom" href="#">Haz tu cuenta en Zoom y descarga la aplicación </a>
                    <p><small>Siempre verifica que tus descargas y cuentas se realicen desde sitios oficiales de Zoom.</small></p>
                    
                </div>
                
            </div> <!-- /row-clases -->

        </div> <!-- /hoja-1200 -->
    </section> <!-- /membresia -->

@stop