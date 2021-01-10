<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="single-curso sesiones">

        <div class="hoja-1000">
            
            <ul class="flex breadcrumb-curso">
                <li><a href="{{ route("clases-linea.index") }}">Clases en línea</a></li>
                <li><a href="#"> {{ $clase->nombre_clase }} </a></li>
                <li><span>Sesiones</span></li>
            </ul> <!-- /breadcrumb-curso -->
            
            <div class="wrapper-curso">
                <div class="flex">

                    <div class="sidebar-single">
                        
                        <div class="perfil-profesor">
                        
                            <div class="img-profesor" style="background-image: url({{Storage::url($clase->instructor[0]->img) }});"></div>
                            
                            <div class="bio-profesor">
                                <p> {{ $clase->instructor[0]->nombres. " ". $clase->instructor[0]->apellidos }} </p>
                                <p> {{ $clase->instructor[0]->especialidad }} </p>
                                <p> {{ $clase->instructor[0]->bibliografia }} </p>
                            </div> <!-- /bio-profesor -->
                            
                        </div> <!-- /row-perfil -->
                        
                    </div> <!-- /sidebar-single -->
                    
                    <div class="single-contenido">
                        
                        <div class="txt-single">
                            <h3> {{ $clase->nombre_clase }} </h3>
                            {{-- <p>Producción musical / Clase en línea / Profesor titular: José Antonio Cordero</p> --}}
                            <p> {{ $clase->category_id == 1 ? "Produccion musical" : "Música" }} / Clase en línea / Profesor titular: {{ $clase->instructor[0]->nombres. " ". $clase->instructor[0]->apellidos }}</p>
                        </div> <!-- /txt-single -->
                        
                        <div class="flex">
                        
                            <div class="row-sesiones">
                            
                                <p><span class="txt-yellow">Bienvenida</span></p>

                                <div class="row-video">
                                    {{-- <iframe src="https://www.youtube.com/embed/CBZyA-Pj52U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                                    <iframe src="{{ $clase->video_bienvenida."?modestbranding=1&rel=0&showinfo=0&iv_load_policy=3" }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div> <!-- /row-video -->

                                <div class="txt-single">
                                    @php $i = 1; @endphp
                                    @foreach($clase->sesiones as $sesiones)
                                        <p>
                                            <span class="txt-yellow">
                                                SESIÓN {{ $i }} · {{ $clase->FormatoLetras( $sesiones->fecha_inicio, 3 ). " · ". $clase->FormatoTiempo( $sesiones->fecha_inicio ). " HORAS" }} (Hora Cd. de México)
                                            </span>
                                        </p>
                                        @php $i++; @endphp
                                    @endforeach

                                    {{-- <p><span class="txt-yellow">SESIÓN 1 · LUNES 00 DE JUNIO, 2020 · 18:00 HORAS (Hora Cd. de México)</span></p>
                                    <p><span class="txt-yellow">SESIÓN 2 · LUNES 00 DE JUNIO, 2020 · 18:00 HORAS (Hora Cd. de México)</span></p>
                                    <p><span class="txt-yellow">SESIÓN 3 · LUNES 00 DE JUNIO, 2020 · 18:00 HORAS (Hora Cd. de México)</span></p>
                                    <p><span class="txt-yellow">SESIÓN 4 · LUNES 00 DE JULIO, 2020 · 18:00 HORAS (Hora Cd. de México)</span></p> --}}
                                </div> <!-- /txt-single -->

                                <div class="row-clases">

                                    <h3>¿Cómo se imparten las clases en línea?</h3>

                                    <p>Las clases en línea se imparten a través de la plataforma Zoom.</p>
                                    <p>Una vez que te registres a una clase recibirás en tu correo la información para accesar en la fecha y hora indicadas.</p>
                                    <a class="btn-zoom" href="#">Haz tu cuenta en Zoom y descarga la aplicación </a>
                                    <p><small>Siempre verifica que tus descargas y cuentas se realicen desde sitios oficiales de Zoom.</small></p>

                                </div> <!-- /row-clases -->

                            </div> <!-- /row-sesiones -->

                            <div class="sidebar-registro">
                                <div class="txt-sidebar">
                                    <span><a href="#">En curso</a></span>
                                    <div>
                                        <p><strong>¡Estás listo para comenzar!</strong></p>
                                        <p>Ahora podrás encontrar esta clase en tu tablero personal para acceder rápidamente a ella.</p>
                                        <p><strong>¿Qué sigue?</strong></p>
                                        <p>Revisa tu correo electrónico y guarda los datos de acceso a las sesiones.</p>
                                    </div>
                                </div>
                                
                            </div> <!-- /sidebar-registro -->
                            
                        </div> <!-- /flex -->
                        
                    </div> <!-- /single-contenido -->

                </div> <!-- /flex -->
            </div> <!-- /wrapper-curso -->
            
        </div> <!-- /hoja-1400 -->
    </section> <!-- /clases-sesiones -->

@stop


@section('js-content')
    <script type="text/javascript" src="/site/js/app.js"></script>
@stop