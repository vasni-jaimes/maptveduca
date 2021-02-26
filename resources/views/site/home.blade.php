<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->


@section('contenido')

    <section class="inicio">
        <div class="hoja-1000">
            
            <div class="banner-inicio">
                <h2>¡BIENVENID@!</h2>
                <p>¿No sabes por dónde empezar? <a href="{{ route("guia-estudio") }}">Mira aquí</a></p>
            </div> <!-- /banner-inicio -->
            
            @if ($cursos->count() > 0)
                <div class="banner-slide slide-yellow">
                    <div class="bg-yellow">
                        <h2>Lo más nuevo</h2>
                        <p><a href="{{ route("cursos") }}">Mira más cursos aquí</a></p>
                    </div> <!-- /bg-yellow -->
                    <ul class="slide-inicio">
                        @forelse($cursos as $curso)
                            <li>
                                <a href="{{ route("single-cursos.show", $curso->slug) }}">
                                    <div class="img-slide" style="background-image: url({{Storage::url($curso->url_img) }});"></div> <!-- /img-slide -->
                                </a>
                            </li>
                        @empty
                            <li>
                                <p>No se encontraron resultados</p>
                            </li>
                        @endforelse
                    </ul>
                </div> <!-- /banner-slide -->
            @else
                <div class="banner-slide slide-yellow">
                    <div class="bg-yellow">
                        <h2>Lo más nuevo</h2>
                        <p>PRÓXIMAMENTE</p>
                    </div> <!-- /bg-yellow -->
                </div> <!-- /banner-slide -->
            @endif
            
            @if ( $clases->count() > 0 )
                <div class="banner-slide slide-black">
                    <div class="bg-black">
                        <h2>Clases en línea</h2>
                        <p><a href="{{ route("clases-linea.index") }}">Mira más clases aquí</a></p>
                    </div> <!-- /bg-black -->
                    <ul class="slide-inicio">
                        @forelse($clases as $clase)
                            <li>
                                <div class="img-slide" style="background-image: url({{Storage::url($clase->img) }});"></div> <!-- /img-slide -->
                            </li>
                        @empty
                            <li>
                                <p>No se encontraron resultados</p>
                            </li>
                        @endforelse
                    </ul>
                </div> <!-- /banner-slide -->
            @else 
                <div class="banner-slide slide-black">
                    <div class="bg-black">
                        <h2>Clases en línea</h2>
                        <p>PRÓXIMAMENTE</p>
                    </div> <!-- /bg-black -->
                </div> <!-- /banner-slide -->
            @endif
            

            @if ( $eventos->count() > 0 )
                <div class="banner-slide slide-yellow">
                    <div class="bg-yellow">
                        <h2>Eventos</h2>
                        <p><a href="{{ route("eventos.index") }}">Mira más eventos aquí</a></p>
                    </div> <!-- /bg-yellow -->
                    <ul class="slide-inicio">
                        @forelse($eventos as $evento)
                            <li>
                                <a href="{{ route("evento.show", $evento->slug) }}">
                                    <div class="img-slide" style="background-image: url({{Storage::url($evento->img_evento) }});"></div> <!-- /img-slide -->
                                </a>
                            </li>
                        @empty
                            <li>
                                <p>No se encontraron resultados</p>
                            </li>
                        @endforelse
                    </ul>
                </div> <!-- /banner-slide -->
            @else 
                <div class="banner-slide slide-yellow">
                    <div class="bg-yellow">
                        <h2>Eventos</h2>
                        <p>PRÓXIMAMENTE</p>
                    </div> <!-- /bg-yellow -->
                </div> <!-- /banner-slide -->
            @endif
            
            
            <div class="banner-title bg-black">
                <h2>¿Cómo funciona maptv educa?</h2>
            </div> <!-- /bg-black -->
            
            <div class="wrapper-maptv">
                
                <div class="row-maptv">
                    <div class="banner-maptv">
                        <div class="img-maptv">
                            <img src="/site/img/ico-curso.png">
                        </div> <!-- /img-maptv -->
                        <div class="txt-maptv">
                            <!--<h2>CARRERAS TÉCNICAS EN LÍNEA</h2>-->
                            <!--<ul>
                                <li>Estudia una de las dos carreras técnicas que MAPtv Educa tiene para ti: </li>
                                <li>Técnico Profesional en Producción Musical</li>
                                <li>Técnico Profesional en Música</li>
                            </ul>-->
                            <h2>ESTUDIA PRODUCCIÓN MUSICAL EN LÍNEA</h2>
                            <p>Estudia la carrera técnica en Producción Musical, y próximamente, la carrera técnica profesional en Música.</p>
                            <p>Aprende, desarrolla tus habilidades y obtén un certificado con validez oficial expedido por M.A.P Colegio de Música, Audio y Producción (México). (Incorporado a SEP)</p>
                        </div> <!-- /txt-maptv -->
                    </div> <!-- /row-maptv -->

                    <ul class="flex flex-lista">
                        <li class="i-lista">
                            <img src="/site/img/ico-play.png">
                            <h3>Cursos</h3>
                            <div>
                                <p>Los cursos se componen de varias sesiones de video que te guiarán a través de un tema o área específicos: producción musical, música teórica y teórico-práctica, y negocios de la música.</p>
                            </div>
                        </li>
                        <li class="i-lista">
                            <img src="/site/img/ico-compu.png">
                            <h3>Clases en línea</h3>
                            <div>
                                <p>Las clases en línea son sesiones en vivo directamente con tu profesor, adicionales a tu membresía, en horarios y fechas determinadas.</p>
                                <p>Las clases en línea tienen un costo adicional.</p>
                            </div>
                        </li>
                        <li class="i-lista">
                            <img src="/site/img/ico-eventos.png">
                            <h3>Eventos</h3>
                            <div>
                                <p>Los eventos son sesiones únicas de clínicas o conciertos/masterclass con diversos artistas o profesionales de la industria musical. Los eventos básicos son gratuitos para miembros: los especiales tienen un costo adicional.</p>
                            </div>
                        </li>
                    </ul> <!-- /flex -->
                    
                    <div class="row-contenido">
                        <h2>PUEDES ACCEDER AL CONTENIDO DE DOS FORMAS:</h2>
                        <ul class="flex reverse">
                            <li>
                                <img src="/site/img/ico-academica.png">
                                <h3>Membresía Académica</h3>
                                <div>
                                    <p>Si lo que quieres es certificarte como técnico en producción musical, esta opción es para ti.</p>
                                    <ul>
                                        <li>Plan de estudios</li>
                                        <li>Grupo trimestral de cursos</li>
                                        <li>Avance semanal</li> 
                                        <li>Interacción y retroalimentación directa con el profesor titular</li>
                                        <li>Acceso a aulas virtuales</li>
                                        <li>Certificación con validez oficial M.A.P. Colegio de Música, Audio y Producción (Incorporado a SEP)</li>
                                    </ul>
                                    <p>Esta membresía también te da acceso todos los cursos de MAPtv Educa, aunque no pertenezcan a tu plan de estudios, además de a los eventos básicos, que incluyen clínicas y conciertos/masterclass.</p>
                                    <p>Inicio de cursos: Enero 2021</p>
                                    <a class="btn-amarillo" href="{{ route("membresias.index") }}">¡Me interesa!</a>
                                </div>
                            </li>
                            <li>
                                <img src="/site/img/ico-clasica.png">
                                <h3>Membresía Básica</h3>
                                <div>
                                    <p><strong>¡PRÓXIMAMENTE!</strong></p>
                                    <p>Esta membresía te permite tomar los cursos que quieras, a tu ritmo.</p>
                                    <p>También te da acceso a los eventos básicos, que incluyen clínicas y conciertos/masterclass.</p>
                                    <p>Te da acceso a una guía de estudio para que sepas cómo aprovechar al máximo nuestro contenido.</p>
                                    <p>Los cursos que completes bajo esta modalidad no tienen validez académica.</p>
                                    <span class="precio">Esta membresía estará <br> disponible muy pronto</span>
                                    <!--<span class="gratis">Pruébala gratis por 30 días</span>-->
                                </div>
                            </li>
                        </ul>
                    </div> <!-- /row-contenido -->
                    
                </div> <!-- /row-maptv -->
                
            </div> <!-- /wrapper-maptv -->
            
            <div class="banner-title bg-yellow">
                <h2>Conoce a la familia</h2>
            </div> <!-- /bg-black -->
            
            <div class="wrapper-maptv wrapper-logos">
                
                <div class="row-maptv">
                    
                    <ul class="flex between flex-logos">
                        <li><a href="{{ route("nosotros.index") }}"><img src="/site/img/logo-map.png"></a></li>
                        <li><a href="{{ route("nosotros.index") }}"><img src="/site/img/logo-recording.png"></a></li>
                        <li><a href="{{ route("nosotros.index") }}"><img src="/site/img/logo-maptv.png"></a></li>
                    </ul> <!-- /flex -->
                    
                </div> <!-- /row-maptv -->
            
            </div> <!-- /wrapper-maptv -->
            
        </div> <!-- /hoja-1000 -->
    </section> <!-- /inicio -->

@stop