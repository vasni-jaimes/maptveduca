<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="guia">

        <div class="banner-guia"></div> <!-- /banner-cursos -->
        
        <div class="titulo-banner">
            <h1>Guía de estudio</h1>
        </div> <!-- /titulo-banner -->
        
        <div class="hoja-1000">
        
            <div class="wrapper-columnas">
                
                <div class="row-columnas">
                    
                    <div class="flex between">

                        <div class="col-6">
                            <p>¿Primera vez estudiando en línea? ¡No hay problema!
                            <p>En esta guía te recomendamos la forma de aprovechar mejor todo nuestro contenido a través de una guía cronológica de cursos y consejos para aprovechar al máximo tu experiencia virtual.</p>
                            <p>¡Puedes marcar los cursos como favoritos para acceder a ellos desde tu tablero personal!</p>
                            <p><strong>Aquí encontrarás todas las materias que cursarás a lo largo de la carrera técnica en Producción Musical ordenadas por niveles.</strong></p>
                            <p><strong>También incluiremos algunos cursos adicionales para complementar tus estudios; te notificaremos cada que se lance contenido nuevo.</strong></p>
                        </div> <!-- /col-6 -->

                        <div class="col-6">
                            <div class="row-video">
                                <iframe src="https://player.vimeo.com/video/501573822" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div> <!-- /row-video -->
                        </div> <!-- /col-6 -->

                    </div> <!-- /flex -->
                    
                    <p><strong>Te recomendamos estar al pendiente de tu Tablero Personal, pues será el medio a través del cual nos mantendremos en contacto contigo, además de que ahí podrás encontrar tus cursos favoritos, tus calificaciones e información personal.</strong></p>
                    
                </div> <!-- /row-columnas -->
                
            </div> <!-- /wrapper-columnas -->
            
            <ul class="flex flex-lista">
                <li>
                    <img src="/site/img/consejo1.png">
                    <h3>Consejo 1</h3>
                    <div>
                        <p>Establece un horario diario o semanal para dedicar a ver los videos de cada curso y para hacer tareas.</p>
                        <p>Cada semestre, revisa los horarios de sesiones virtuales para cada materia y tenlos a la mano. ¡No lo olvides!</p>
                    </div>
                </li>
                <li>
                    <img src="/site/img/consejo2.png">
                    <h3>Consejo 2</h3>
                    <div>
                        <p>Dedica una libreta o carpeta a tu trimestre de materias. Después será mucho más fácil consultar tus apuntes.</p>
                        <p>Reserva un espacio especial para tomar tus clases y trabajar. ¡Mantenlo agradable y motivador!</p>
                    </div>
                </li>
                <li>
                    <img src="/site/img/consejo3.png">
                    <h3>Consejo 3</h3>
                    <div>
                        <p>Las sesiones en vivo con tus profesores son uno de los valores agregados que tiene nuestra plataforma.</p>
                        <p>¡Llega puntual a cada sesión y aprovecha a preguntar todas tus dudas!</p>
                    </div>
                </li>
            </ul>
            
            <ul class="flex flex-guia">
                <li class="item-guia item-equipo">
                    <h3>¿Qué equipo necesitas para estudiar producción musical?</h3>
                    <ul>
                        <li>Computadora personal o de escritorio</li>
                        <li>Conexión estable a Internet</li>
                        <li>Set de audífonos de mezcla</li>
                        <li>Interfaz de audio simple</li>
                        <li>Software de edición y manipulación de audio (DAW)</li>
                    </ul>
                </li>
                <li class="item-guia item-kit">
                    <p><strong>Si no cuentas con el equipo necesario...</strong></p>
                    <h3>Solicita tu kit de producción musical</h3>
                    <p>Personalízalo y págalo con cargo a tu colegiatura mensual</p>
                    <ul>
                        <li>Set de audífonos de mezcla</li>
                        <li>Interfaz de audio simple</li>
                        <li>Micrófono dinámico</li>
                        <li>Controlador MIDI</li>
                    </ul>
                    <ul class="btn-guia">
                        <li><p>*Envíos sólo a la República Mexicana.</p></li>
                        <li><a href="mailto:maptveduca.info@gmail.com">¡Me interesa!</a></li>
                    </ul>
                </li>
            </ul> <!-- /flex-guia -->
            
            <div class="row-yellow row-guia">

                <div class="titulo-cursos">
                    <h2>Producción musical</h2>
                </div> <!-- /titulo-cursos -->


                @if ($recomendaciones->where('trimestre', 1)->count() > 0)
                
                    <h3>Primer grupo de cursos</h3>

                    <div class="row-slide">

                        <ul class="slide-cursos">
                            @foreach($recomendaciones->where('trimestre', 1) as $recomendacion)
                                <li>
                                    <a href="{{ route('single-cursos.show', $recomendacion->cursos->slug) }}">
                                        <div class="img-slide" style="background-image: url({{ Storage::url($recomendacion->cursos->url_img) }});"></div>
                                    </a> <!-- /img-slide -->
                                </li>
                            @endforeach
                        </ul> <!-- /slide-cursos -->

                         @if ($recomendacionesextra->where('trimestre', 1)->count() > 0)

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>

                                <ul class="slide-extra">
                                    @foreach($recomendacionesextra->where('trimestre', 1) as $recomendacionextra)
                                        <li>
                                            <a href="{{ route('single-cursos.show', $recomendacionextra->cursos->slug) }}">
                                                <div class="img-slide" style="background-image: url({{ Storage::url($recomendacionextra->cursos->url_img) }});"></div> <!-- /img-slide -->
                                            </a>
                                        </li>
                                    @endforeach
                                </ul> <!-- /slide-extra -->

                            </div> <!-- /row-extra -->

                        @endif

                    </div> <!-- /row-slide -->

                @endif




                @if ($recomendaciones->where('trimestre', 2)->count() > 0)
                
                    <h3>Segundo grupo de cursos</h3>

                    <div class="row-slide">

                        <ul class="slide-cursos">
                            @foreach($recomendaciones->where('trimestre', 2) as $recomendacion)
                                <li>
                                    <a href="{{ route('single-cursos.show', $recomendacion->cursos->slug) }}">
                                        <div class="img-slide" style="background-image: url({{ Storage::url($recomendacion->cursos->url_img) }});"></div> <!-- /img-slide -->
                                    </a>
                                </li>
                            @endforeach
                        </ul> <!-- /slide-cursos -->

                         @if ($recomendacionesextra->where('trimestre', 2)->count() > 0)

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>

                                <ul class="slide-extra">
                                    @foreach($recomendacionesextra->where('trimestre', 2) as $recomendacionextra)
                                        <li>
                                            <a href="{{ route('single-cursos.show', $recomendacionextra->cursos->slug) }}">
                                                <div class="img-slide" style="background-image: url({{ Storage::url($recomendacionextra->cursos->url_img) }});"></div> <!-- /img-slide -->
                                            </a>
                                        </li>
                                    @endforeach
                                </ul> <!-- /slide-extra -->

                            </div> <!-- /row-extra -->

                        @endif

                    </div> <!-- /row-slide -->

                @endif



                @if ($recomendaciones->where('trimestre', 3)->count() > 0)
                
                    <h3>Tercer grupo de cursos</h3>

                    <div class="row-slide">

                        <ul class="slide-cursos">
                            @foreach($recomendaciones->where('trimestre', 3) as $recomendacion)
                                <li>
                                    <a href="{{ route('single-cursos.show', $recomendacion->cursos->slug) }}">
                                        <div class="img-slide" style="background-image: url({{ Storage::url($recomendacion->cursos->url_img) }});"></div> <!-- /img-slide -->
                                    </a>
                                </li>
                            @endforeach
                        </ul> <!-- /slide-cursos -->

                         @if ($recomendacionesextra->where('trimestre', 3)->count() > 0)

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>

                                <ul class="slide-extra">
                                    @foreach($recomendacionesextra->where('trimestre', 3) as $recomendacionextra)
                                        <a href="{{ route('single-cursos.show', $recomendacionextra->cursos->slug) }}">
                                            <div class="img-slide" style="background-image: url({{ Storage::url($recomendacionextra->cursos->url_img) }});"></div> <!-- /img-slide -->
                                        </a>
                                    @endforeach
                                </ul> <!-- /slide-extra -->

                            </div> <!-- /row-extra -->

                        @endif

                    </div> <!-- /row-slide -->

                @endif




                @if ($recomendaciones->where('trimestre', 4)->count() > 0)
                
                    <h3>Cuarto grupo de cursos</h3>

                    <div class="row-slide">

                        <ul class="slide-cursos">
                            @foreach($recomendaciones->where('trimestre', 4) as $recomendacion)
                                <li>
                                    <a href="{{ route('single-cursos.show', $recomendacion->cursos->slug) }}">
                                        <div class="img-slide" style="background-image: url({{ Storage::url($recomendacion->cursos->url_img) }});"></div> <!-- /img-slide -->
                                    </a>
                                </li>
                            @endforeach
                        </ul> <!-- /slide-cursos -->

                         @if ($recomendacionesextra->where('trimestre', 4)->count() > 0)

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>

                                <ul class="slide-extra">
                                    @foreach($recomendacionesextra->where('trimestre', 4) as $recomendacionextra)
                                        <li>
                                            <a href="{{ route('single-cursos.show', $recomendacionextra->cursos->slug) }}">
                                                <div class="img-slide" style="background-image: url({{ Storage::url($recomendacionextra->cursos->url_img) }});"></div> <!-- /img-slide -->
                                            </a>
                                        </li>
                                    @endforeach
                                </ul> <!-- /slide-extra -->

                            </div> <!-- /row-extra -->

                        @endif

                    </div> <!-- /row-slide -->

                @endif




                @if ($recomendaciones->where('trimestre', 5)->count() > 0)
                
                    <h3>Quinto grupo de cursos</h3>

                    <div class="row-slide">

                        <ul class="slide-cursos">
                            @foreach($recomendaciones->where('trimestre', 5) as $recomendacion)
                                <li>
                                    <a href="{{ route('single-cursos.show', $recomendacion->cursos->slug) }}">
                                        <div class="img-slide" style="background-image: url({{ Storage::url($recomendacion->cursos->url_img) }});"></div> <!-- /img-slide -->
                                    </a>
                                </li>
                            @endforeach
                        </ul> <!-- /slide-cursos -->

                         @if ($recomendacionesextra->where('trimestre', 5)->count() > 0)

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>

                                <ul class="slide-extra">
                                    @foreach($recomendacionesextra->where('trimestre', 5) as $recomendacionextra)
                                        <li>
                                            <a href="{{ route('single-cursos.show', $recomendacionextra->cursos->slug) }}">
                                                <div class="img-slide" style="background-image: url({{ Storage::url($recomendacionextra->cursos->url_img) }});"></div> <!-- /img-slide -->
                                            </a>
                                        </li>
                                    @endforeach
                                </ul> <!-- /slide-extra -->

                            </div> <!-- /row-extra -->

                        @endif

                    </div> <!-- /row-slide -->

                @endif




                @if ($recomendaciones->where('trimestre', 6)->count() > 0)
                
                    <h3>Sexto grupo de cursos</h3>

                    <div class="row-slide">

                        <ul class="slide-cursos">
                            @foreach($recomendaciones->where('trimestre', 6) as $recomendacion)
                                <li>
                                    <a href="{{ route('single-cursos.show', $recomendacion->cursos->slug) }}">
                                        <div class="img-slide" style="background-image: url({{ Storage::url($recomendacion->cursos->url_img) }});"></div> <!-- /img-slide -->
                                    </a>
                                </li>
                            @endforeach
                        </ul> <!-- /slide-cursos -->

                         @if ($recomendacionesextra->where('trimestre', 6)->count() > 0)

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>

                                <ul class="slide-extra">
                                    @foreach($recomendacionesextra->where('trimestre', 6) as $recomendacionextra)
                                        <li>
                                            <a href="{{ route('single-cursos.show', $recomendacionextra->cursos->slug) }}">
                                                <div class="img-slide" style="background-image: url({{ Storage::url($recomendacionextra->cursos->url_img) }});"></div> <!-- /img-slide -->
                                            </a>
                                        </li>
                                    @endforeach
                                </ul> <!-- /slide-extra -->

                            </div> <!-- /row-extra -->

                        @endif

                    </div> <!-- /row-slide -->

                @endif




                @if ($recomendaciones->where('trimestre', 7)->count() > 0)
                
                    <h3>Septimo grupo de cursos</h3>

                    <div class="row-slide">

                        <ul class="slide-cursos">
                            @foreach($recomendaciones->where('trimestre', 7) as $recomendacion)
                                <li>
                                    <a href="{{ route('single-cursos.show', $recomendacion->cursos->slug) }}">
                                        <div class="img-slide" style="background-image: url({{ Storage::url($recomendacion->cursos->url_img) }});"></div> <!-- /img-slide -->
                                    </a>
                                </li>
                            @endforeach
                        </ul> <!-- /slide-cursos -->

                         @if ($recomendacionesextra->where('trimestre', 7)->count() > 0)

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>

                                <ul class="slide-extra">
                                    @foreach($recomendacionesextra->where('trimestre', 7) as $recomendacionextra)
                                        <li>
                                            <a href="{{ route('single-cursos.show', $recomendacionextra->cursos->slug) }}">
                                                <div class="img-slide" style="background-image: url({{ Storage::url($recomendacionextra->cursos->url_img) }});"></div> <!-- /img-slide -->
                                            </a>
                                        </li>
                                    @endforeach
                                </ul> <!-- /slide-extra -->

                            </div> <!-- /row-extra -->

                        @endif

                    </div> <!-- /row-slide -->

                @endif




                @if ($recomendaciones->where('trimestre', 8)->count() > 0)
                
                    <h3>Octavo grupo de cursos</h3>

                    <div class="row-slide">

                        <ul class="slide-cursos">
                            @foreach($recomendaciones->where('trimestre', 8) as $recomendacion)
                                <li>
                                    <a href="{{ route('single-cursos.show', $recomendacion->cursos->slug) }}">
                                        <div class="img-slide" style="background-image: url({{ Storage::url($recomendacion->cursos->url_img) }});"></div> <!-- /img-slide -->
                                    </a>
                                </li>
                            @endforeach
                        </ul> <!-- /slide-cursos -->

                         @if ($recomendacionesextra->where('trimestre', 8)->count() > 0)

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>

                                <ul class="slide-extra">
                                    @foreach($recomendacionesextra->where('trimestre', 8) as $recomendacionextra)
                                        <li>
                                            <a href="{{ route('single-cursos.show', $recomendacionextra->cursos->slug) }}">
                                                <div class="img-slide" style="background-image: url({{ Storage::url($recomendacionextra->cursos->url_img) }});"></div> <!-- /img-slide -->
                                            </a>
                                        </li>
                                    @endforeach
                                </ul> <!-- /slide-extra -->

                            </div> <!-- /row-extra -->

                        @endif

                    </div> <!-- /row-slide -->

                @endif



            </div> <!-- /bg-yellow -->

        </div> <!-- /hoja-1000 -->
        
    </section> <!-- /membresia -->

@stop