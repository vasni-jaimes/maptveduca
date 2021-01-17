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
                                <iframe src="https://www.youtube.com/embed/p6ZZOIs7pI4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                
                <h3>Primer grupo de cursos</h3>

                <div class="row-slide">

                    <ul class="slide-cursos">
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
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                    </ul> <!-- /slide-cursos -->

                    <div class="row-extra flex between">
                        <span>Cursos <br> extra ></span>

                        <ul class="slide-extra">
                            <li>
                                <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                            </li>
                            <li>
                                <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                            </li>
                        </ul> <!-- /slide-extra -->

                    </div> <!-- /row-extra -->

                </div> <!-- /row-slide -->
                
                <h3>Segundo grupo de cursos</h3>

                <div class="row-slide">

                    <ul class="slide-cursos">
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
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                    </ul> <!-- /slide-cursos -->

                    <div class="row-extra flex between">
                        <span>Cursos <br> extra ></span>

                        <ul class="slide-extra">
                            <li>
                                <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                            </li>
                            <li>
                                <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                            </li>
                        </ul> <!-- /slide-extra -->

                    </div> <!-- /row-extra -->

                </div> <!-- /row-slide -->
                
                <h3>Tercer grupo de cursos</h3>

                <div class="row-slide">

                    <ul class="slide-cursos">
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
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                    </ul> <!-- /slide-cursos -->

                    <div class="row-extra flex between">
                        <span>Cursos <br> extra ></span>

                        <ul class="slide-extra">
                            <li>
                                <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                            </li>
                            <li>
                                <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                            </li>
                        </ul> <!-- /slide-extra -->

                    </div> <!-- /row-extra -->

                </div> <!-- /row-slide -->
                
                <h3>Cuarto grupo de cursos</h3>

                <div class="row-slide">

                    <ul class="slide-cursos">
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
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                        <li>
                            <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                        </li>
                    </ul> <!-- /slide-cursos -->

                    <div class="row-extra flex between">
                        <span>Cursos <br> extra ></span>

                        <ul class="slide-extra">
                            <li>
                                <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                            </li>
                            <li>
                                <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                            </li>
                        </ul> <!-- /slide-extra -->

                    </div> <!-- /row-extra -->

                </div> <!-- /row-slide -->

            </div> <!-- /bg-yellow -->

        </div> <!-- /hoja-1000 -->
        
    </section> <!-- /membresia -->

@stop