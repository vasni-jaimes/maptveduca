<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->


@section('contenido')

    <section class="membresia">

        <div class="banner-membresia"></div> <!-- /banner-cursos -->
        
        <div class="titulo-banner">
            <h1>Membresia académica</h1>
        </div> <!-- /titulo-banner -->
        
        <div class="hoja-1000">
        
            <div class="wrapper-columnas">
                
                <div class="row-columnas">
                    
                    <div class="flex between">

                        <div class="col-6">
                            <p>A través de MAPtv Educa, te damos la posibilidad de certificarte en:</p>
                            <ul>
                                <li>Carrera Técnica en Producción Musical</li>
                                <!--<li>Carrera Técnica en Música</li>-->
                            </ul>
                            <p>Este programa es parte de la oferta académica presencial en M.A.P. Colegio de Música, Audio y Producción (Puebla, México). Hemos trasladado a esta plataforma el contenido de este programa para que puedas cursarlo de manera virtual, teniendo además la posibilidad de obtener <strong>retroalimentación semanal directamente con el profesor titular de cada curso</strong> y medir tu progreso con evaluaciones periódicas.</p>
                        </div> <!-- /col-6 -->

                        <div class="col-6">
                            <div class="row-video">
                                <iframe src="https://www.youtube.com/embed/CBZyA-Pj52U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div> <!-- /row-video -->
                        </div> <!-- /col-6 -->

                    </div> <!-- /flex -->

                    <div class="txt-columna text-center">
                        <p>Al finalizar tu carrera técnica recibirás un certificado de parte de M.A.P. Colegio de Música, Audio y Producción <br>(Incorporado a SEP)</p>
                        <p>Mira cómo funciona la carrera técnica:</p>
                    </div> <!-- /text-center -->
                    
                </div> <!-- /row-columnas -->
                
                <div class="flex center row-programas">
                
                    <div class="col-6 item-programa">
                        <img src="/site/img/ico-academica.png">
                        <h3>Técnico en producción musical</h3>
                        <span>En línea</span>
                        <div class="txt-programa">
                            <p><strong>DURACIÓN: </strong>8 trimestres</p>
                            <p><strong>PERIODOS DE INICIO: </strong>Enero, Abril, Julio, Octubre</p>
                            <p><strong>DIVISIÓN DE TRIMESTRES: </strong></p>
                            <ul>
                                <li>Enero - Marzo</li>
                                <li>Abril - Junio</li>
                                <li>Julio - Septiembre</li>
                                <li>Octubre - Diciembre</li>
                            </ul>
                            <p><strong>COSTO: </strong>$2,000.00 MXN mensuales</p>
                            <p><strong>CERTIFICACIÓN: </strong></p>
                            <p>Certificado con validez oficial expedido por M.A.P. Colegio de Música, Audio y Producción <br>(Incorporado a SEP)</p>
                        </div> <!-- /txt-programa -->
                        <a class="btn-amarillo" href="javascript:void(0)">Plan de estudios</a>
                        <div class="row-planes">
                            <div class="flex wrap">
                                <div class="item-plan">
                                    <h4>1er Trimestre</h4>
                                    <p>Teoría Musical I</p>
                                    <p>Entrenamiento Auditivo I</p>
                                    <p>Fundamentos del Audio I (A)</p>
                                    <p>Grabación I (A)</p>
                                    <p>Intro. a la Producción Musical</p>
                                    <p>DAW</p>
                                </div> <!-- /item-plan -->
                                <div class="item-plan">
                                    <h4>2do Trimestre</h4>
                                    <p>Teoría Musical II</p>
                                    <p>Entrenamiento Auditivo II</p>
                                    <p>Fundamentos del Audio I (B)</p>
                                    <p>Grabación I (B)</p>
                                    <p>Intro. al Estudio de Grabación</p>
                                </div> <!-- /item-plan -->
                                
                                <div class="item-plan">
                                    <h4>3er Trimestre</h4>
                                    <p>Teoría Musical III</p>
                                    <p>Entrenamiento Auditivo para Mezcla</p>
                                    <p>Industria Musical (A)</p>
                                    <p>Teoría del Sonido II (A)</p>
                                    <p>Grabación II (A)</p>
                                </div> <!-- /item-plan -->
                                <div class="item-plan">
                                    <h4>4to Trimestre</h4>
                                    <p>Songwriting (A)</p>
                                    <p>Piano para Productores</p>
                                    <p>Industria Musical (B)</p>
                                    <p>Teoría del Sonido II (B)</p>
                                    <p>Grabación II (B)</p>
                                </div> <!-- /item-plan -->
                                
                                <div class="item-plan">
                                    <h4>5to Trimestre</h4>
                                    <p>Songwriting (B)</p>
                                    <p>Intro. a la Cultura y Movimientos Musicales (A)</p>
                                    <p>Acústica (A)</p>
                                    <p>Instrumentos Virtuales - MIDI</p>
                                    <p>Técnicas de Mezcla (A)</p>
                                </div> <!-- /item-plan -->
                                <div class="item-plan">
                                    <h4>6to Trimestre</h4>
                                    <p>Intro. a la Cultura y Movimientos Musicales (B)</p>
                                    <p>Análisis de canciones y escucha crítica (A)</p>
                                    <p>Acústica (B)</p>
                                    <p>Técnicas de Mezcla I (B)</p>
                                    <p>Negocios de la Música (A)</p>
                                </div> <!-- /item-plan -->
                                
                                <div class="item-plan">
                                    <h4>7mo Trimestre</h4>
                                    <p>Análisis de canciones y escucha crítica (B)</p>
                                    <p>Producción Musical I</p>
                                    <p>Técnicas de Mezcla II (A)</p>
                                    <p>Negocios de la Música (B)</p>
                                    <p>Técnicas de Mástering (A)</p>
                                </div> <!-- /item-plan -->
                                <div class="item-plan">
                                    <h4>8vo Trimestre</h4>
                                    <p>Audio en Vivo</p>
                                    <p>Producción Musical II</p>
                                    <p>Técnicas de Mezcla II (B)</p>
                                    <p>Técnicas de Mástering (B)</p>
                                    <p>Producción de Música Electrónica</p>
                                </div> <!-- /item-plan -->
                            </div> <!-- /flex -->
                        </div> <!-- /row-planes -->
                        <a class="btn-amarillo btn-border" href="{{ route("checkout", "membresia-academica") }}">Obtén tu membresía e inscríbete</a>
                    </div> <!-- /item-programa -->
                    
                    <!--<div class="col-6 item-programa">
                        <img src="/site/img/ico-academica.png">
                        <h3>Técnico profesional en música</h3>
                        <span>En línea</span>
                        <div class="txt-programa">
                            <p><strong>DURACIÓN: </strong>12 trimestres</p>
                            <p><strong>PERIODOS DE INICIO: </strong>Octubre y Abril</p>
                            <p><strong>DIVISIÓN DE TRIMESTRES: </strong></p>
                            <ul>
                                <li>Octubre - Diciembre</li>
                                <li>Enero - Marzo</li>
                                <li>Abril - Junio</li>
                                <li>Julio - Septiembre</li>
                            </ul>
                            <p><strong>COSTO: </strong>$1234.00 MXN mensuales</p>
                            <p><strong>CERTIFICACIÓN: </strong></p>
                            <p>Certificado con validez oficial expedido por la SEP (Secretaría de Educación Pública de México) y M.A.P. Colegio de Música, Audio y Producción</p>
                        </div> <!-- /txt-programa
                        <a class="btn-amarillo" href="#">Plan de estudios</a>
                        <div class="row-planes">
                            <div class="flex wrap">
                                <div class="item-plan">
                                    <h4>1er Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                <div class="item-plan">
                                    <h4>2do Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                
                                <div class="item-plan">
                                    <h4>3er Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                <div class="item-plan">
                                    <h4>4to Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                
                                <div class="item-plan">
                                    <h4>5to Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                <div class="item-plan">
                                    <h4>6to Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                
                                <div class="item-plan">
                                    <h4>7mo Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                <div class="item-plan">
                                    <h4>8vo Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                
                                <div class="item-plan">
                                    <h4>9no Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                <div class="item-plan">
                                    <h4>10mo Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                
                                <div class="item-plan">
                                    <h4>11vo Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                                <div class="item-plan">
                                    <h4>12vo Trimestre</h4>
                                    <p>Grabación I</p>
                                    <p>Producción Musical I</p>
                                    <p>ProTools I</p>
                                    <p>Logic I</p>
                                </div> <!-- /item-plan
                            </div> <!-- /flex 
                        </div> <!-- /row-planes
                        <a class="btn-amarillo btn-border" href="#">Obtén tu membresía e inscríbete</a>
                    </div> <!-- /item-programa -->
                    
                </div> <!-- /row-programas -->
                
                <div class="wrapper-academica">

                    <h2>¿Qué obtengo con la membresía académica?</h2>
                    
                    <div class="hoja-700">

                        <table style="width: 100%; border-spacing: 10px; border-collapse: separate; table-layout: fixed;">
                            <tr>
                                <th>&nbsp</th>
                                <!--<th>Membresía básica</th>-->
                                <th>Membresía académica <span>Carrera técnica en producción musical</span></th>
                            </tr>
                            <tr>
                                <td>Acceso a cursos base</td>
                                <!--<td><span class="circle"></span></td>-->
                                <td><span class="circle"></span></td>
                            </tr>
                            <tr>
                                <td>Acceso a cursos y material extra</td>
                                <!--<td><span class="circle"></span></td>-->
                                <td><span class="circle"></span></td>
                            </tr>
                            <tr>
                                <td>Acceso a clínicas y conciertos/masterclass básicas</td>
                                <!--<td><span class="circle"></span></td>-->
                                <td><span class="circle"></span></td>
                            </tr>
                            <tr>
                                <td>Acceso a carrera técnica con reconocimiento oficial SEP</td>
                                <!--<td>&nbsp</td>-->
                                <td><span class="circle"></span></td>
                            </tr>
                            <tr>
                                <td>Acceso a aulas virtuales</td>
                                <!--<td>&nbsp</td>-->
                                <td><span class="circle"></span></td>
                            </tr>
                            <tr>
                                <td>Retroalimentación y sesiones en vivo de profesores titulares</td>
                                <!--<td>&nbsp</td>-->
                                <td><span class="circle"></span></td>
                            </tr>
                            <tr>
                                <td>Certificado con validez oficial</td>
                                <!--<td>&nbsp</td>-->
                                <td><span class="circle"></span></td>
                            </tr>
                            <tr class="last-tr">
                                <td class="last-td">&nbsp</td>
                                <!--<td class="last-td"><span>$123 MXN mensuales</span><a href="{{ route("checkout", "membresia-basica") }}" class="bg-amarillo">Prueba gratuita por 30 días</a></td>-->
                                <td class="last-td"><span>$2,000 MXN mensuales<br>en modalidad trimestral</span><a href="{{ route("checkout", "membresia-academica") }}" class="bg-amarillo">OBTÉN TU MEMBRESÍA E INSCRÍBETE</a></td>
                            </tr>
                        </table>
                        
                    </div> <!-- /hoja-800 -->
                    
                </div> <!-- /wrapper-academica -->
                
                <div class="wrapper-herramienta">
                    
                    <h2>¿Qué herramientas tengo para estudiar en línea?</h2>
                
                    <div class="row-herramienta flex between">
                        <div class="col-5 item-titulo">
                            <img src="/site/img/ico-aulas.png">
                            <h3>AULAS VIRTUALES</h3>
                        </div> <!-- /item-titulo -->
                        <div class="col-7 item-texto">
                            <p>Al ser miembro académico, tienes acceso a las Aulas Virtuales por curso. Podrás ingresar a través de tu área personal de miembro, o área de control académico.</p>
                            <p>Este espacio te permite tener <strong>interacción escrita directamente con tu profesor</strong>, quien asignará actividades semanalmente y te compartirá material especial.</p>
                            <p>Aquí mismo <strong>podrás subir archivos correspondientes a tus entregas semanales e interactuar con estudiantes que también están cursando el programa.</strong></p>
                        </div> <!-- /item-texto -->
                    </div> <!-- /row-herramienta -->
                    
                    <div class="row-herramienta flex between">
                        <div class="col-5 item-titulo">
                            <img src="/site/img/ico-sesiones.png">
                            <h3>Sesiones en vivo con profesores</h3>
                        </div> <!-- /item-titulo -->
                        <div class="col-7 item-texto">
                            <p>Cada curso se complementa con una sesión en vivo (vía Zoom) al mes para que puedas hacer preguntas, obtener información de la experiencia directa del profesor.</p>
                        </div> <!-- /item-texto -->
                    </div> <!-- /row-herramienta -->
                    
                    <div class="row-herramienta flex between">
                        <div class="col-5 item-titulo">
                            <img src="/site/img/ico-control.png">
                            <h3>Área de control académico</h3>
                        </div> <!-- /item-titulo -->
                        <div class="col-7 item-texto">
                            <p>Al adquirir tu membresía académica, automáticamente se añadirá la sección "Control Académico" a tu tablero personal.</p>
                            <p>Ahí <strong>podrás accesar en cualquier momento a las aulas virtuales por curso y a tu información de alumno (calificaciones y status académico)</strong>, además de conjuntar en un sólo lugar todos cursos del semestre en progreso.</p>
                        </div> <!-- /item-texto -->
                    </div> <!-- /row-herramienta -->
                    
                    <div class="row-herramienta flex between">
                        <div class="col-5 item-titulo">
                            <img src="/site/img/ico-musica.png">
                            <h3>Cursos base y extras</h3>
                        </div> <!-- /item-titulo -->
                        <div class="col-7 item-texto">
                            <p>Con tu membresía académica <strong>tienes acceso a todos los cursos de MAPtv Educa, sin importar que no pertenezcan a tu plan de estudios.</strong> Si quieres complementar tus conocimientos o aprender algo nuevo, sólo basta añadir el curso de tu interés a tu tablero personal.</p>
                        </div> <!-- /item-texto -->
                    </div> <!-- /row-herramienta -->
                    
                </div> <!-- /wrapper-herramienta -->
                
            </div> <!-- /wrapper-columnas -->
            
        </div> <!-- /hoja-1000 -->
        
    </section> <!-- /membresia -->

@stop