<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="inicio">
        <div class="hoja-1000">
            
            <div class="banner-inicio">
                <h2>¡BIENVENID@!</h2>
                <p>¿No sabes por dónde empezar? Mira aquí</p>
            </div> <!-- /banner-inicio -->
            
            <div class="banner-slide slide-yellow">
                <div class="bg-yellow">
                    <h2>Lo más nuevo</h2>
                    <p>Mira todos aquí</p>
                </div> <!-- /bg-yellow -->
                <ul class="slide-inicio">
                    @forelse($cursos as $curso)
                        <li>
                            <div class="img-slide" style="background-image: url({{Storage::url($curso->url_img) }});"></div> <!-- /img-slide -->
                        </li>
                    @empty
                        <li>
                            <div> No se encuentraron resultados </div>
                        </li>
                    @endforelse
                </ul>
            </div> <!-- /banner-slide -->
            
            <div class="banner-slide slide-black">
                <div class="bg-black">
                    <h2>Clases en línea</h2>
                    <p>Mira más clases aquí</p>
                </div> <!-- /bg-black -->
                <ul class="slide-inicio">
                    <li>
                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                    </li>
                    <li>
                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                    </li>
                    <li>
                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                    </li>
                    <li>
                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                    </li>
                </ul>
            </div> <!-- /banner-slide -->
            
            <div class="banner-slide slide-yellow">
                <div class="bg-yellow">
                    <h2>Eventos</h2>
                    <p>Mira todos aquí</p>
                </div> <!-- /bg-yellow -->
                <ul class="slide-inicio">
                    <li>
                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                    </li>
                    <li>
                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                    </li>
                    <li>
                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                    </li>
                    <li>
                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                    </li>
                </ul>
            </div> <!-- /banner-slide -->
            
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
                            <h2>CARRERAS TÉCNICAS EN LÍNEA</h2>
                            <ul>
                                <li>Estudia una de las dos carreras técnicas que MAPtv Educa tiene para ti: </li>
                                <li>Técnico Profesional en Producción Musical</li>
                                <li>Técnico Profesional en Música</li>
                            </ul>
                            <p>Aprende, desarrolla tus habilidades y obtén un certificado con validez oficial expedido por M.A.P Colegio de Música, Audio y Producción (México) y la SEP (Secretaría de Educación Pública de México)</p>
                        </div> <!-- /txt-maptv -->
                    </div> <!-- /row-maptv -->

                    <ul class="flex flex-lista">
                        <li>
                            <img src="/site/img/ico-play.png">
                            <h3>Cursos</h3>
                            <div>
                                <p>Los cursos se componen de varias sesiones de video que te guiarán a través de un tema o área específicos. </p>
                                <p>Contamos con cursos de producción musical, música y negocios de la música.</p>
                            </div>
                        </li>
                        <li>
                            <img src="/site/img/ico-compu.png">
                            <h3>Clases en línea</h3>
                            <div>
                                <p>Las clases en línea son sesiones en vivo directamente con tu profesor, en horarios y fechas determinadas.</p>
                                <p>Las clases en línea tienen un costo adicional.</p>
                            </div>
                        </li>
                        <li>
                            <img src="/site/img/ico-eventos.png">
                            <h3>Eventos</h3>
                            <div>
                                <p>Los eventos son sesiones únicas de clínicas o conciertos/masterclass con diversos artistas o profesionales de la industria musical. Los eventos básicos son gratuitos para miembros: los especiales tienen un costo adicional.</p>
                            </div>
                        </li>
                    </ul> <!-- /flex -->
                    
                    <div class="row-contenido">
                        <h2>PUEDES ACCEDER AL CONTENIDO DE DOS FORMAS:</h2>
                        <ul class="flex">
                            <li>
                                <img src="/site/img/ico-clasica.png">
                                <h3>Membresía Clásica</h3>
                                <div>
                                    <p>Esta membresía te permite tomar los cursos que quieras, a tu ritmo.</p>
                                    <p>También te da acceso a los eventos básicos, que incluyen clínicas y conciertos/masterclass.</p>
                                    <p>Te da acceso a una guía de estudio para que sepas cómo aprovechar al máximo nuestro contenido.</p>
                                    <p>Los cursos que completes bajo esta modalidad no tienen validez académica.</p>
                                    <span class="precio">$123 MXN mensuales</span>
                                    <span class="gratis">Pruébala gratis por 30 días</span>
                                </div>
                            </li>
                            <li>
                                <img src="/site/img/ico-academica.png">
                                <h3>Membresía Académica</h3>
                                <div>
                                    <p>Si lo que quieres es certificarte en alguna de nuestras carreras técnicas, esta opción es para ti.</p>
                                    <ul>
                                        <li>Plan de estudios</li>
                                        <li>Grupo trimestral de cursos</li>
                                        <li>Avance semanal Interacción y retroalimentación directa con el profesor titular</li>
                                        <li>Acceso a aulas virtuales</li>
                                        <li>Certificación con validez oficial SEP y M.A.P. Colegio de Música, Audio y Producción</li>
                                    </ul>
                                    <p>Esta membresía también te da acceso todos los cursos de MAPtv Educa, aunque no pertenezcan a tu plan de estudios, además de a los eventos básicos, que incluyen clínicas y conciertos/masterclass.</p>
                                    <p>Inicio de cursos: octubre y abril </p>
                                    <a class="btn-amarillo" href="#">Obten más información</a>
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
                        <li><img src="/site/img/logo-map.png"></li>
                        <li><img src="/site/img/logo-recording.png"></li>
                        <li><img src="/site/img/logo-maptv.png"></li>
                    </ul> <!-- /flex -->
                    
                </div> <!-- /row-maptv -->
            
            </div> <!-- /wrapper-maptv -->
            
        </div> <!-- /hoja-1000 -->
    </section> <!-- /inicio -->

@stop